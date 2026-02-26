<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\products;

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