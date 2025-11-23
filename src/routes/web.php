<?php

use App\Http\Controllers\FrimaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// ログイン前に見れるページ
Route::get('/register', [FrimaController::class, 'register'])->name('register');
Route::post('/register', [FrimaController::class, 'store'])->name('register.store');
Route::get('/login', [FrimaController::class, 'login'])->name('login');

// メール認証関連
Route::get('/email/verify', function () { return view('site.email'); })->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('first');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', '認証メールを送信しました');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// ログイン後のみ
Route::middleware('auth')->group(function () {
    // 初回ログインページ
    Route::get('/login/first', [FrimaController::class, 'first'])->name('first');
    Route::post('/login/first', [FrimaController::class, 'update'])->name('first.update');
    Route::post('/login/first/search', [FrimaController::class, 'search'])->name('first.search');

    // ホームページ
    Route::get('/', [FrimaController::class, 'index'])->name('dashboard');
});

    //商品詳細ページ
    Route::get('/item/{item_id}', [FrimaController::class, 'show'])->name('item.detail');
    Route::post('/item/{item_id}/comment', [FrimaController::class, 'storeComment'])->name('comment.store');

    //商品出品ページ
    Route::get('/sell', [FrimaController::class, 'sell'])->name('sell');