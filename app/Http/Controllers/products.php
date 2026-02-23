<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productsmodel;
use App\Models\cartmodel;
use App\Models\ordermodel;
use App\Models\trendingmodel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class products extends Controller
{
    public function dashboard()
    {
        $data = productsmodel::all();
        $trending = trendingmodel::inRandomOrder()->take(8)->get();
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
        $data = productsmodel::where('name', 'like', '%' . $query . '%')
            ->orWhere('category', 'like', '%' . $query . '%')
            ->get();
        return view('search', compact('data'));
    }

    function addToCart(Request $request)
    {
        if (Auth::check()) {
            $cart = new cartmodel;
            $cart->user_id = Auth::id();
            $cart->product_id = $request->product_id;
            $cart->save();
            return redirect('/dashboard');
        } else {
            return redirect('/login');
        }
    }

    function buyNow(Request $request)
    {
        if (Auth::check()) {
            return redirect('/order?buy_now=' . $request->product_id);
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
        $cartItems = DB::table('add cart')
            ->join('products', 'add cart.product_id', '=', 'products.id')
            ->where('add cart.user_id', $userId)
            ->select('products.*', 'add cart.id as cart_id')
            ->get();

        $products = collect();
        foreach ($cartItems as $item) {
            $existingKey = $products->search(function ($p) use ($item) {
                return $p->id === $item->id;
            });

            if ($existingKey !== false) {
                $products[$existingKey]->quantity += 1;
                $products[$existingKey]->all_cart_ids .= ',' . $item->cart_id;
            } else {
                $item->quantity = 1;
                $item->all_cart_ids = (string) $item->cart_id;
                $products->push($item);
            }
        }

        return view('cartlist', compact('products'));
    }

    function removeCart($id)
    {
        $ids = explode(',', $id);
        cartmodel::destroy($ids);
        return redirect('/cartlist');
    }

    function products()
    {
        $mobiles = productsmodel::where('category', 'mobiles')->get();
        $tvs = productsmodel::where('category', 'tv')->get();
        return view('products', compact('mobiles', 'tvs'));
    }

    function order(Request $request)
    {
        $userId = Auth::id();

        if ($request->has('buy_now')) {
            $orders = DB::table('products')->where('id', $request->query('buy_now'))->get();
        } else {
            $orders = DB::table('add cart')
                ->join('products', 'add cart.product_id', '=', 'products.id')
                ->where('add cart.user_id', $userId)
                ->select('products.*')
                ->get();
        }

        return view('order', compact('orders'));
    }

    function orderplace(Request $request)
    {
        $userId = Auth::id();

        if ($request->has('buy_now') && $request->input('buy_now')) {
            $order = new ordermodel;
            $order->user_id = $userId;
            $order->product_id = $request->input('buy_now');
            $order->address = $request->address . ', ' . $request->city . ', ' . $request->state . ' - ' . $request->zip;
            $order->payment_method = $request->payment;
            $order->status = 'Pending';
            if (strtolower($request->payment) == 'cash') {
                $order->payment_status = 'Pending';
            } else {
                $order->payment_status = 'Done';
            }
            $order->save();
        } else {
            $carts = cartmodel::where('user_id', $userId)->get();

            foreach ($carts as $cart) {
                $order = new ordermodel;
                $order->user_id = $userId;
                $order->product_id = $cart->product_id;
                $order->address = $request->address . ', ' . $request->city . ', ' . $request->state . ' - ' . $request->zip;
                $order->payment_method = $request->payment;
                $order->status = 'Pending';
                if (strtolower($request->payment) == 'cash') {
                    $order->payment_status = 'Pending';
                } else {
                    $order->payment_status = 'Done';
                }
                $order->save();
            }

            cartmodel::where('user_id', $userId)->delete();
        }

        return redirect('/dashboard')->with('order_placed', 'Your order was successfully placed!');
    }

    function myorders()
    {
        $userId = Auth::id();
        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.user_id', $userId)
            ->select('products.*', 'orders.id as order_id', 'orders.address', 'orders.status', 'orders.payment_method', 'orders.payment_status', 'orders.created_at')
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