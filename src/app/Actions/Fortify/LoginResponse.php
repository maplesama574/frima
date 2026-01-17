<?php
// app/Actions/Fortify/LoginResponse.php
namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        if (!$user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        if ($user->is_first_login) {
            return redirect()->route('login.first');
        }

        return redirect()->route('mypage');
    }
}
