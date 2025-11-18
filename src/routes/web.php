<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrimaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//ここから
Route::get('/register', [FrimaController::class, 'register'])->name('register');
Route::get('/email/verify', [FrimaController::class, 'email'])->name('email');
Route::get('/login', [FrimaController::class, 'login'])->name('login');

//認証ミドルウェア
Route::middleware('site')->group(function(){
    Route::get('/', [FrimaController::class, 'index']);
});

//初回プロフィール
Route::get('/login/first', [FrimaController::class, 'first'])->name('first');
Route::post('/login/first', [FirstLoginController::class, 'update'])->name('first');
Route::get('/login/first', [FrimaController::class, 'search'])->name('search');
