<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\front\auth\TwoFactorController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\OrdersController;
use App\Http\Controllers\front\ProductController as FrontProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [FrontProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [FrontProductController::class, 'show'])->name('products.show');


Route::resource('cart', CartController::class);

Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
Route::post('checkout', [CheckoutController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Route::get('auth/user/2fa' , [TwoFactorController::class,'index'])->name('auth.2fa');
Route::view('auth/user/2fa', 'front.auth.two-factor-auth')->name('auth.2fa');


Route::get('auth/{provider}/redirect' , [SocialiteController::class , 'redirect'])->name('auth.socialite.redirect');
Route::get('auth/{provider}/callback',[SocialiteController::class , 'callback'])->name('auth.socialite.callback');


Route::get('orders/{order}/pay',[PaymentController::class , 'create'])
->name('order.pay');

Route::get('orders/{order}/pay/stripe',[PaymentController::class , 'confirm'])
->name('stripe.return');

Route::get('/orders/{order}', [OrdersController::class,'delivery'])->name('orders/show');

Route::post('orders/{order}/stripe' ,[PaymentController::class , 'createPayment'])
->name('createPaymentStripe');


// Route::get('auth/{provider}/callback', function () {
//     $user = Socialite::driver('google')->user();
//     dd($user);
 
//     // $user->token
// });

// Fortify::loginView(function () {
//     return view('auth.login');
// });

// Fortify::registerView(function () {
//     return view('auth.register');
// });

// require __DIR__.'/auth.php';
require __DIR__ . '/dashboard.php';
