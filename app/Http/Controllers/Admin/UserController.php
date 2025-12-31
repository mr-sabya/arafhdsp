<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('admin.user.index');
    }

    // create new user
    public function create()
    {
        return view('admin.user.create');
    }

    // edit user
    public function edit($id)
    {
        $user = User::findOrFail(intval($id));
        return view('admin.user.edit', compact('user'));
    }


    public function role()
    {
        return view('admin.role.index');
    }
}
