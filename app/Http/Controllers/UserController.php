<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $get_user = User::all();

        return view('user.list', ["get_user" => $get_user]);
    }
}
