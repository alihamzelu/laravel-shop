<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Models\Order;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\TicketReplyController;



Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/deals', [ProductsController::class, 'deals'])->name('deals');
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::get('/products/{product}', [ProductsController::class, 'show'])->name('products.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
Route::get('/payment/failed', function () {
    return view('payment.failed');
})->name('payment.failed');










Route::middleware('auth')->group(function () {


    Route::get('/support', [SupportTicketController::class, 'index'])
        ->name('support.index');

    Route::get('/support/create', [SupportTicketController::class, 'create'])
        ->name('support.create');

    Route::post('/support', [SupportTicketController::class, 'store'])
        ->name('support.store');

    Route::get('/support/{ticket}', [SupportTicketController::class, 'show'])
        ->name('support.show');

    Route::patch('/support/{ticket}/close', [SupportTicketController::class, 'close'])
        ->name('support.close');

    Route::post('/support/{ticket}/reply', [TicketReplyController::class, 'store'])
        ->name('support.reply');


    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{product}', [WishlistController::class, 'toggle'])
        ->name('wishlist.toggle');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Payment Routes (Dynamic)
    Route::get('/payment/{order}', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/{order}/zarinpal', [PaymentController::class, 'zarinpal'])->name('payment.zarinpal');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    Route::get('/orders', [DashboardController::class, 'orders'])
        ->middleware('auth')
        ->name('orders');

    Route::get('/orders/{order}', [DashboardController::class, 'show'])->name('orders.show');


    Route::get('/accountsettings', [DashboardController::class, 'accountsettings'])
        ->middleware('auth')
        ->name('accountsettings');


    // Order Success
    Route::get('/order/success/{order}', function (Order $order) {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        return view('order.success', compact('order'));
    })->name('order.success');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Breeze/Jetstream)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
