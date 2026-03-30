<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productsmodel;
use App\Models\cartmodel;
use App\Models\ordermodel;
use App\Models\OrderItem;
use App\Models\trendingmodel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMail;

class products extends Controller
{
    public function dashboard()
    {
        $data = productsmodel::all();
        $trending = trendingmodel::get();
        return view('dashboard', compact('data', 'trending'));
    }

    function about()
    {
        return view('about');
    }

    function detail($id)
    {
        $data = productsmodel::find($id);
        return view('detail', compact('data'));
    }

    function search(Request $request)
    {
        $query = $request->input('query');

        $data = productsmodel::with('categories')
            ->where('name', 'like', '%' . $query . '%')
            ->orWhereHas('categories', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->get();

        return view('search', compact('data'));
    }

    function addToCart(Request $request)
    {
        if (Auth::check()) {
            $cartItem = cartmodel::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $request->input('quantity', 1);
                $cartItem->save();
            } else {
                $cart = new cartmodel;
                $cart->user_id = Auth::id();
                $cart->product_id = $request->product_id;
                $cart->quantity = $request->input('quantity', 1);
                $cart->save();
            }
            return redirect('/dashboard');
        } else {
            return redirect('/login');
        }
    }

    function buyNow(Request $request)
    {
        if (Auth::check()) {
            $qty = $request->input('quantity', 1);
            return redirect('/order?buy_now=' . $request->product_id . '&qty=' . $qty);
        } else {
            return redirect('/login');
        }
    }

    static function cartItem()
    {
        $userId = Auth::id();
        return cartmodel::where('user_id', $userId)->count();
    }

    function cartlist()
    {
        $userId = Auth::id();
        $products = DB::table('add cart')
            ->join('products', 'add cart.product_id', '=', 'products.id')
            ->where('add cart.user_id', $userId)
            ->select('products.*', 'add cart.id as cart_id', 'add cart.quantity')
            ->get();

        return view('cartlist', compact('products'));
    }

    function removeCart($id)
    {
        $ids = explode(',', $id);
        cartmodel::destroy($ids);
        return redirect('/cartlist');
    }

    function updateCart($id, $quantity)
    {
        if (Auth::check()) {
            $cartItem = cartmodel::where('user_id', Auth::id())
                ->where('id', $id)
                ->first();
            if ($cartItem && $quantity > 0) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
            return redirect('/cartlist');
        } else {
            return redirect('/login');
        }
    }

    function products()
    {
        $mobiles = productsmodel::where('category', '1')->get();
        $tvs = productsmodel::where('category', '2')->get();
        return view('products', compact('mobiles', 'tvs'));
    }

    function order(Request $request)
    {
        $userId = Auth::id();

        if ($request->has('buy_now')) {
            $orders = DB::table('products')->where('id', $request->query('buy_now'))->get();
            if ($orders->isNotEmpty()) {
                $orders->first()->quantity = $request->query('qty', 1);
            }
        } else {
            $orders = DB::table('add cart')
                ->join('products', 'add cart.product_id', '=', 'products.id')
                ->where('add cart.user_id', $userId)
                ->select('products.*', 'add cart.quantity')
                ->get();
        }

        return view('order', compact('orders'));
    }

    function orderplace(Request $request)
    {
        $userId = Auth::id();

        $order = new ordermodel;
        $order->user_id = $userId;
        $order->amount = round((float) str_replace(',', '', $request->input('total_amount')));
        $order->address = $request->address . ', ' . $request->city . ', ' . $request->state . ' - ' . $request->zip;
        $order->payment_method = $request->payment;
        $order->status = 'Pending';
        $order->payment_status = (strtolower($request->payment) == 'cash') ? 'Pending' : 'Completed';
        $order->save();

        if ($request->has('buy_now') && $request->input('buy_now')) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $request->input('buy_now'),
                'quantity' => $request->input('qty', 1),
            ]);
        } else {
            $carts = cartmodel::where('user_id', $userId)->get();
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                ]);
            }
            cartmodel::where('user_id', $userId)->delete();
        }

        Mail::to(Auth::user()->email)->send(new OrderPlacedMail($order));

        return redirect('/dashboard')->with('order_placed', 'Your order was successfully placed!');
    }

    function myorders()
    {
        $userId = Auth::id();
        $orders = ordermodel::with('items.product')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('myorders', compact('orders'));
    }

    function cancelOrder($id)
    {
        $order = ordermodel::find($id);
        if ($order && strtolower($order->status) == 'pending') {
            $order->status = 'Cancelled';
            $order->save();
        }
        return redirect('/myorders')->with('success', 'Order cancelled successfully!');
    }

}