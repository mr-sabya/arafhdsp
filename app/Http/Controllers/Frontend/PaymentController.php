<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function payment()
    {
        return view('frontend.payment.index');    
    }

    // payment status
    public function paymentStatus()
    {
        return view('frontend.payment.status');    
    }
}
