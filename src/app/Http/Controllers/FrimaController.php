<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrimaController extends Controller
{
    public function register(){
        return view('site.register');
    }
    public function email(){
        return view('site.email');
    }
    public function login(){
        return view('site.login');
    }
}
