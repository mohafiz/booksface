<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function orders()
    {
        return view('admin.orders');
    }

    public function books()
    {
        return view('admin.books');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function newusers()
    {
        return view('admin.newusers');
    }

    public function roles()
    {
        return view('admin.roles');
    }
}
