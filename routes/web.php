<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// マイページ
Route::get('/dashboard', function () {
    // 自分の出品商品
    $myProducts = \App\Models\Product::where('user_id', auth()->id())->orderBy('id', 'asc')->get();
    
    // 購入した商品、商品情報
    $myPurchases = \App\Models\Sale::with('product')->where('user_id', auth()->id())->orderBy('created_at', 'asc')->get();

   
    return view('dashboard', compact('myProducts', 'myPurchases'));
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// お気に入り機能
Route::post('/favorites/{productId}', [\App\Http\Controllers\FavoriteController::class, 'store'])->name('favorites.store');
Route::delete('/favorites/{productId}', [\App\Http\Controllers\FavoriteController::class, 'destroy'])->name('favorites.destroy');
// お問い合わせ機能
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'create'])->name('contacts.create');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contacts.store');
// カート・購入機能
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/remove/{id}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');
