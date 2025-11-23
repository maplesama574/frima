<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\LoginResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
    }

    public function boot()
    {
        Fortify::loginView(function () {
            return view('site.login');
        });

        Fortify::authenticateUsing(function ($request) {
            return Auth::attempt($request->only('email', 'password')) ? Auth::user() : null;
        });
    }
}
