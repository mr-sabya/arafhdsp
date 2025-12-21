<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    //
    public function division()
    {
        return view('admin.locations.division');
    }

    // district view
    public function district()
    {
        return view('admin.locations.district');
    }

    // upazila view
    public function upazila()
    {
        return view('admin.locations.upazila');
    }

    // area view
    public function area()
    {
        return view('admin.locations.area');
    }
}
