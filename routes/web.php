<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\products;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\Admin\Admin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/login',[userController::class,'login'])->name('login');
Route::post('/login',[userController::class,'login_store'])->name('login_store');

Route::get('/register',[userController::class,'register'])->name('register');
Route::post('/register',[userController::class,'register_store'])->name('register_store');
Route::get('/logout',[userController::class,'logout'])->name('logout');
Route::get('/profile',[userController::class,'profile'])->name('profile')->middleware('App\Http\Middleware\users');
Route::post('/profile/update',[userController::class,'profile_update'])->name('profile_update')->middleware('App\Http\Middleware\users');
Route::get('/profile/security',[userController::class,'security'])->name('security')->middleware('App\Http\Middleware\users');
Route::post('/profile/security_update',[userController::class,'security_update'])->name('security_update')->middleware('App\Http\Middleware\users');

Route::get('/dashboard',[products::class,'dashboard'])->name('dashboard')->middleware('App\Http\Middleware\users');

Route::get('/about',[products::class,'about'])->name('about');

Route::get('/detail/{id}',[products::class,'detail'])->name('detail');

Route::get('/search',[products::class,'search'])->name('search');

Route::post('/add_to_cart',[products::class,'addToCart'])->name('addToCart');
Route::post('/buynow',[products::class,'buyNow'])->name('buyNow');

Route::get('/cartlist',[products::class,'cartlist'])->name('cartlist');

Route::get('/removecart/{id}',[products::class,'removeCart'])->name('removeCart');
Route::get('/updatecart/{id}/{quantity}',[products::class,'updateCart'])->name('updateCart');

route::get('/products',[products::class,'products'])->name('products');

route::get('/order',[products::class,'order'])->name('order');

route::get('/orderplace', function () {
    return redirect('/order');
});
route::post('/orderplace',[products::class,'orderplace'])->name('orderplace');

route::get('/myorders',[products::class,'myorders'])->name('myorders');

Route::get('/cancelorder/{id}',[products::class,'cancelOrder'])->name('cancelOrder');

// Route::get('/checkout', [PaymentController::class, 'checkout'])->middleware('App\Http\Middleware\users');
Route::get('/payment-success', [PaymentController::class, 'success'])->middleware('App\Http\Middleware\users');


// Admin routes
Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

Route::get('/admin/login',[Admin::class,'login'])->name('admin.login');
Route::post('/admin/login',[Admin::class,'login_store'])->name('admin.login_store');

Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin/dashboard',[Admin::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [Admin::class, 'users'])->name('admin.users');
    Route::get('/admin/users/delete/{id}', [Admin::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/products', [Admin::class, 'products'])->name('admin.products');
    Route::get('/admin/products/add', [Admin::class, 'addProduct'])->name('admin.products.add');
    Route::post('/admin/products/add', [Admin::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/admin/products/edit/{id}', [Admin::class, 'editProduct'])->name('admin.products.edit');
    Route::post('/admin/products/edit/{id}', [Admin::class, 'updateProduct'])->name('admin.products.update');
    Route::get('/admin/products/delete/{id}', [Admin::class, 'deleteProduct'])->name('admin.products.delete');
    
    // Orders
    Route::get('/admin/orders', [Admin::class, 'orders'])->name('admin.orders');
    Route::post('/admin/orders/update-status/{id}', [Admin::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');

    // Payments
    Route::get('/admin/payments', [Admin::class, 'payments'])->name('admin.payments');
    Route::post('/admin/payments/update-status/{id}', [Admin::class, 'updatePaymentStatus'])->name('admin.payments.updateStatus');

    // Categories
    Route::get('/admin/categories', [Admin::class, 'categories'])->name('admin.categories');
    Route::get('/admin/categories/add', [Admin::class, 'addCategory'])->name('admin.categories.add');
    Route::post('/admin/categories/add', [Admin::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/admin/categories/edit/{id}', [Admin::class, 'editCategory'])->name('admin.categories.edit');
    Route::post('/admin/categories/edit/{id}', [Admin::class, 'updateCategory'])->name('admin.categories.update');
    Route::get('/admin/categories/delete/{id}', [Admin::class, 'deleteCategory'])->name('admin.categories.delete');

    Route::get('/admin/logout',[Admin::class,'logout'])->name('admin.logout');

    Route::get('/admin/view{id}',[Admin::class,'view'])->name('admin.view');
});


// Password reset routes

Route::get('/Password/forget-pass', [ForgotController::class,'forgetForm'])->name('Password.forget-pass');
Route::post('/Password/send-otp', [ForgotController::class,'sendOtp'])->name('Password.send-otp');
Route::get('/Password/otp', [ForgotController::class,'otpForm'])->name('Password.otp-form');
Route::post('/Password/verify-otp', [ForgotController::class,'verifyOtp'])->name('Password.verify-otp');
Route::get('/Password/new-pass', [ForgotController::class,'newPasswordForm'])->name('Password.new-pass');
Route::post('/Password/update-password', [ForgotController::class,'updatePassword'])->name('Password.update-password');