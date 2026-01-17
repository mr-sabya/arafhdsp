<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PricingPlanController extends Controller
{
    //
    public function index()
    {
        return view('admin.pricing-plan.index');    
    }

    // service
    public function service()
    {
        return view('admin.service.index');    
    }
}
