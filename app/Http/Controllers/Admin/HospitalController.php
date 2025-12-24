<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    //
    public function departments()
    {
        return view('admin.departments.index');    
    }

    // doctors
    public function doctors()
    {
        return view('admin.doctors.index');    
    }

    // hospitals
    public function hospitals()
    {
        return view('admin.hospitals.index');    
    }
}
