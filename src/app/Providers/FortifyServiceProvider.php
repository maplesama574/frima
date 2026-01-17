<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Requests\LoginRequest;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            \Laravel\Fortify\Contracts\RegisterResponse::class,
            fn () => new class implements \Laravel\Fortify\Contracts\RegisterResponse {
                public function toResponse($request)
                {
                    return redirect()->route('verification.notice');
                }
            }
        );

        $this->app->singleton(
            \Laravel\Fortify\Contracts\LoginResponse::class,
            fn () => new class implements \Laravel\Fortify\Contracts\LoginResponse {
                public function toResponse($request)
                {
                    $user = Auth::user();

                    if (! $user->hasVerifiedEmail()) {
                        return redirect()->route('verification.notice');
                    }

                    if ($user->is_first_login) {
                        return redirect()->route('login.first');
                    }

                    return redirect()->route('mypage');
                }
            }
        );
    }

    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::registerView(fn () => view('site.register'));
        Fortify::loginView(fn () => view('site.login'));

        RateLimiter::for('login', fn () => Limit::none());
    }
}
