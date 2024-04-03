<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getHome()
    {
        if(Auth::check()) {
            return view('admin.home');
        }
        else
        return redirect()->route('login');
    }
}
