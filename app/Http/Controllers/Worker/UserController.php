<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('worker.user.index');
    }

    // create member
    public function create()
    {
        return view('worker.user.create');
    }

    // verify otp
    public function verifyOtp($user_id)
    {
        return view('worker.user.verify-otp', compact('user_id'));
    }

    // process payment
    public function processPayment($user_id)
    {
        return view('worker.user.process-payment', compact('user_id'));
    }
}
