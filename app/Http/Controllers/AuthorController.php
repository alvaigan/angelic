<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthorController extends Controller
{
    public function index() {
        return view('login.login');
    }

    public function loginProcess (Request $req) {
        $username = $req->input('username');
        $password = $req->input('password');

        try {
            $checkUser = DB::table('t_user')
            ->where('username', '=', $username)
            ->first();

            $hashed = $checkUser->password;
            if (Hash::check($password, $hashed) == true) {
                unset($checkUser->password);
                unset($checkUser->created_at);
                unset($checkUser->updated_at);
                $session['userdata'] = $checkUser;
                $req->session()->put($session);
                // dd($req->session()->get('userdata'));
                return redirect()->route('dashboard');
            }
        } catch (Throwable $err) {
            error_log($err->getMessage());
            return redirect()->back()->with('error', 'Username atau Password salah!');
        }
    }

    public function logout(Request $req) {
        $req->session()->flush();
        $req->session()->regenerate();

        if (!empty(session('userdata'))) {
            return redirect()->back()->with('error', 'Logout Gagal!');
        } else {
            return redirect()->route('login.page');
        }
    }
}
