<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrimaController extends Controller
{
    public function register(){
        return view('site.register');
    }
}
