<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrimaController;
use App\Http\Controllers\FirstLoginController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::get('/', function () {
    return view('welcome');
});

//会員登録
Route::get('/register', [FrimaController::class, 'register'])->name('register');
Route::post('/register', [FrimaController::class, 'store'])->name('register.store');
// メール認証ページ（認証案内）
Route::get('/email/verify', function () {
    return view('site.email'); 
})->middleware('auth')->name('verification.notice');

// メールリンクをクリックしたときのルート
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/login/first');
})->middleware(['auth', 'signed'])->name('verification.verify');

// 認証メールの再送
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', '認証メールを送信しました');})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//ログイン
Route::get('/login', [FrimaController::class, 'login'])->name('login');

//初回プロフィール
Route::get('/login/first', [FrimaController::class, 'first'])->name('first');
Route::post('/login/first', [FrimaController::class, 'update'])->name('first.update');

//検索機能
Route::post('/login/first/search', [FrimaController::class, 'search'])->name('first.search');

//ホームページ
Route::get('/', [FrimaController::class, 'dashboard'])->name('dashboard');











//認証ミドルウェア
Route::middleware('auth')->group(function () {
    Route::get('/', [FrimaController::class, 'index']);
});

