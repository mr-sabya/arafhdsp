<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicalTestController extends Controller
{
    // category
    public function category()
    {
        return view('admin.medical-test.category');
    }

    // test
    public function test()
    {
        return view('admin.medical-test.test');
    }
}
