<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // service-section page
    public function serviceSection()
    {
        return view('admin.service-section.index');
    }

    // index
    public function index()
    {
        return view('admin.service.index');
    }
}
