<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;


Route::get('/', function () {
    return view('service');
});

Route::get('test', function(){
    return view('test');
});

Route::get('service', function(){
    return view('service');
});

Route::get('cart', function(){
    return view('cart');
});
Route::get('/service', [CartController::class, 'service'])->name('service');

Route::get('/dinein', function () {
    return redirect()->route('menu.index')->withCookie(cookie('order_type', 'Dine-In', 60));
})->name('dinein');

Route::get('/takeout', function () {
    return redirect()->route('menu.index')->withCookie(cookie('order_type', 'Take-Out', 60));
})->name('takeout');

Route::get('/menu-items', [MenuItemController::class, 'index'])->name('menu.index');
Route::get('/menu/item/{id}', [MenuItemController::class, 'show'])->name('menu.item');
Route::get('/menu-items/category/{category}', [MenuItemController::class, 'showByCategory'])->name('menu.category');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{productId}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/cart/select-product/{cartItemId}', [CartController::class, 'selectProduct'])->name('cart.selectProduct');
Route::patch('/cart/update-product/{cartItemId}/{newProductId}', [CartController::class, 'updateProduct'])->name('cart.updateProduct');


Route::get('/dinein', [OrderController::class, 'dineIn'])->name('dinein');
Route::get('/takeout', [OrderController::class, 'takeout'])->name('takeout');

Route::post('/order/create', [CartController::class, 'create'])->name('order.create');


// Route::resource('menu-items', MenuItemController::class);
Route::resource('orders', OrderController::class);
Route::resource('payments', PaymentController::class);