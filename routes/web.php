<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\ShoeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\StatisticsController;


/*
|--------------------------------------------------------------------------
| CUSTOMER ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [ShoeController::class, 'home'])->name('house');

Route::get('/shoes', [ShoeController::class, 'index'])->name('shoes.index');
Route::get('/shoes/{shoe}', [ShoeController::class, 'show'])->name('shoes.show');

Route::get('/men', [ShoeController::class, 'men'])->name('shoes.men');
Route::get('/women', [ShoeController::class, 'women'])->name('shoes.women');

Route::get('/about', [ShoeController::class, 'about'])->name('shoes.about');
Route::get('/contactUs', [ShoeController::class, 'contactUs'])->name('shoes.contactUs');

Route::get('/search', [ShoeController::class, 'search'])->name('search');



/*
|--------------------------------------------------------------------------
| CART ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::get('/cart/count', [CartController::class, 'getCartItemCount'])->name('cart.count');

Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{shoe}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{id}', [CartController::class, 'removeCartItem'])->name('cart.remove');

    Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment');
    Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('processPayment');
    Route::get('/order-confirmation', [PaymentController::class, 'showOrderConfirmation'])->name('orderConfirmation');

    Route::post('/contact', [ContactFormController::class, 'store'])->name('contact.store');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
| Temporary lang ni. Later, C# na ang admin.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'is_admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

    Route::get('/commands', [CommandController::class, 'index'])->name('admin.commands.index');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/shoes/create', [ShoeController::class, 'create'])->name('shoes.create');
    Route::post('/shoes', [ShoeController::class, 'store'])->name('shoes.store');
    Route::get('/shoes/{shoe}/edit', [ShoeController::class, 'edit'])->name('shoes.edit');
    Route::put('/shoes/{shoe}', [ShoeController::class, 'update'])->name('shoes.update');
    Route::delete('/shoes/{shoe}', [ShoeController::class, 'destroy'])->name('shoes.destroy');

    Route::get('/admin/men', [ShoeController::class, 'men'])->name('admin.men');
    Route::get('/admin/women', [ShoeController::class, 'women'])->name('admin.women');
    Route::get('/admin/house', [ShoeController::class, 'home'])->name('admin.house');

    Route::get('/admin/comments', [ContactFormController::class, 'showComments'])->name('admin.comments');

    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
});



Route::middleware('auth')->group(function () {
    Route::get('/my-orders', [PaymentController::class, 'myOrders'])->name('orders.my');
});


