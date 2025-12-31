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
}
