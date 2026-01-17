<?php

use App\Http\Controllers\FrimaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', [FrimaController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// 商品詳細
Route::get('/item/{item_id}', [FrimaController::class, 'show'])->name('item.detail');


// メール認証画面
Route::get('/email/verify', function () {
    return view('site.email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('login.first');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth','throttle:6,1'])->name('verification.send');

Route::get('/redirect-after-login', function () {
    $user = auth()->user();

    if (! $user->hasVerifiedEmail()) {
        return redirect()->route('verification.notice');
    }

    if ($user->is_first_login) {
        return redirect()->route('login.first');
    }

    return redirect()->route('mypage');
})->middleware('auth');


use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::post('/items/{item}/favorite', [FrimaController::class, 'toggleFavorite'])
->middleware('auth')
->name('item.favorite');

Route::get('/login/first/search', [FrimaController::class, 'search'])->name('first.search');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::post('/item/{item_id}/comment', [FrimaController::class, 'storeComment'])
        ->name('comment.store');

    Route::get('/login/first', [FrimaController::class, 'showFirstLogin'])
        ->name('login.first');

    Route::post('/login/first', [FrimaController::class, 'updateFirstLogin'])
        ->name('login.first.update');


    // コメント
    Route::post('/item/{item_id}/comment', [FrimaController::class, 'storeComment'])->name('comment.store');

    // 出品
    Route::get('/sell', [FrimaController::class, 'showSell'])->name('sell');
    Route::post('/sell', [FrimaController::class, 'sell'])->name('sell.store');

    // マイページ
    Route::get('/mypage', [FrimaController::class, 'showMypage'])->name('mypage');

    // プロフィール
    Route::get('/mypage/profile', [FrimaController::class, 'showProfileEdit'])->name('profile.edit');
    Route::post('/mypage/profile', [FrimaController::class, 'updateProfile'])->name('profile.update');

    Route::get('/purchase/{item_id}', [FrimaController::class, 'buy'])->name('item.buy');
    Route::post('/purchase/{item_id}', [FrimaController::class, 'processPurchase'])->name('process.purchase');

    Route::get('/purchase/address/{item_id}', [FrimaController::class, 'changeAddress'])->name('address');

    // Stripe
    Route::post('/stripe/{item_id}/checkout', [FrimaController::class, 'checkout'])->name('item.checkout');
    Route::get('/stripe/success', [FrimaController::class, 'success'])->name('stripe.success');
    Route::get('/stripe/cancel/{item_id}', [FrimaController::class, 'cancel'])->name('stripe.cancel');
});

