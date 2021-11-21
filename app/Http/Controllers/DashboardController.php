<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if(empty(session('userdata'))) {
            return redirect()->route('login.page');
        }
        
        return view('dashboard');
    }
}
