<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Show the Login Form
     */
    public function login()
    {
        return view('frontend.auth.login'); // adjust path based on your folder structure
    }

    /**
     * Show the Registration Form
     */
    public function register()
    {
        return view('frontend.auth.register'); // adjust path based on your folder structure
    }
}
