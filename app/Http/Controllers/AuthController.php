<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view( 'auth.content-login' );
    }

    public function register()
    {
        return view( 'auth.content-register' );
    }
}
