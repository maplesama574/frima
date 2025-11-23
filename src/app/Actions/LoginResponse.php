<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        if (!$user->first_login_completed) {
            return redirect()->route('first');
        }

        return redirect()->route('dashboard'); 
    }
}
