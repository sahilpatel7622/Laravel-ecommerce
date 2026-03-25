<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin_usermodel;
use App\Models\usermodel;
use App\Models\ordermodel;
use App\Models\Category;
use App\Models\productsmodel;
use Illuminate\Support\Facades\Auth;

class Admin extends Controller
{
    function login(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_id']);
        return view('Admin.login');
    }
    public function login_store(Request $request)
    {
        $admin = Admin_usermodel::where('email', $request->email)->first();

        if ($admin && $admin->password === $request->password) {
            $request->session()->put('admin_logged_in', true);
            $request->session()->put('admin_id', $admin->id);
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['email' => 'Invalid login details']);
    }
    function dashboard()
    {
        $recentOrders = ordermodel::with('items.product')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $totalOrders = ordermodel::count();
        $totalProducts = productsmodel::count();
        $totalUsers = usermodel::count();
        $totalCategories = Category::count();

        $totalPayments = 0;
        $allOrders = ordermodel::with('items.product')->get();
        foreach ($allOrders as $order) {
            if ($order->amount) {
                $totalPayments += (float) $order->amount;
            } elseif ($order->product) {
                $price = (float) str_replace(['₹', '$', '€', '£', ',', ' '], '', $order->product->price);
                $totalPayments += $price;
            }
        }

        return view('Admin.dashboard', compact(
            'recentOrders',
            'totalOrders',
            'totalProducts',
            'totalUsers',
            'totalPayments',
            'totalCategories'
        ));
    }

    public function users(Request $request)
    {
        $query = usermodel::query();

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('number', 'LIKE', "%{$search}%");
        }

        $users = $query->orderBy('created_at', 'desc')->get();
        return view('Admin.users', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = usermodel::find($id);
        if ($user) {
            $user->delete();
        }
        return redirect()->back();
    }

    public function products(Request $request)
    {
        $query = productsmodel::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('category', 'LIKE', "%{$search}%")
                ->orWhere('price', 'LIKE', "%{$search}%");
        }

        $products = $query->get();
        return view('Admin.products', compact('products'));
    }

    public function addProduct()
    {
        $categories = Category::all();
        return view('Admin.add-product', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'gallery' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $product = new productsmodel();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->description = $request->description;

        if ($request->hasFile('gallery')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->gallery->extension();
            $request->gallery->move(public_path('assets/products'), $imageName);
            $product->gallery = 'assets/products/' . $imageName;
        }

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }

    public function editProduct($id)
    {
        $product = productsmodel::findOrFail($id);
        $categories = Category::all();
        return view('Admin.edit-product', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = productsmodel::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'gallery' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->description = $request->description;

        if ($request->hasFile('gallery')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->gallery->extension();
            $request->gallery->move(public_path('assets/products'), $imageName);
            $product->gallery = 'assets/products/' . $imageName;
        }

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    public function deleteProduct($id)
    {
        $product = productsmodel::find($id);
        if ($product) {
            $product->delete();
        }
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }

    public function orders(Request $request)
    {
        $query = ordermodel::with(['user', 'items.product'])
            ->orderBy('created_at', 'desc');
        if ($request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $orders = $query->get();
        return view('Admin.orders', compact('orders'));
    }
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Pending,Processing,Shipped,Delivered,Cancelled,pending,processing,shipped,delivered,cancelled'
        ]);

        $order = ordermodel::findOrFail($id);
        $order->status = ucfirst(strtolower($request->status));
        $order->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Order status updated to ' . $order->status . '.'
            ]);
        }

        return redirect()->back()->with('success', 'Order status updated to ' . $order->status . '.');
    }

    public function payments()
    {
        $orders = ordermodel::with(['user', 'items.product'])->orderBy('created_at', 'desc')->get();
        return view('Admin.payments', compact('orders'));
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|string|in:Pending,Completed,Failed,Refunded,pending,completed,failed,refunded'
        ]);

        $order = ordermodel::findOrFail($id);
        $order->payment_status = strtolower($request->payment_status);
        $order->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Payment status updated to ' . ucfirst($order->payment_status) . '.'
            ]);
        }

        return redirect()->back()->with('success', 'Payment status updated to ' . ucfirst($order->payment_status) . '.');
    }

    // --- Category Management ---

    public function categories(Request $request)
    {
        $query = Category::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('status', 'LIKE', "%{$search}%");
        }

        $categories = $query->orderBy('created_at', 'desc')->get();
        return view('Admin.categories.index', compact('categories'));
    }

    public function addCategory()
    {
        return view('Admin.categories.add');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'status' => 'required|boolean'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category added successfully!');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('Admin.categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'status' => 'required|boolean'
        ]);

        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully!');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
        }
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_id']);
        return redirect()->route('admin.login');
    }

    public function view($id)
    {
        $order = ordermodel::with(['user', 'items.product'])->findOrFail($id);
        return view('Admin.view', compact('order'));
    }
}