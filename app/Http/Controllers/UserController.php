<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{
    public function index()
    {
        if (empty(session('userdata'))) {
            return redirect()->route('login.page');
        }
        
        $get_user = DB::table('t_user')->orderBy('created_at', 'DESC')->get();
        
        return view('user.list', ["get_user" => $get_user]);
    }

    public function add() 
    {
        $data  = [
            'page' => 'tambah',
            'title' => 'Form Tambah'
        ];

        return view('user.form')->with(['data'=> $data]);
    }

    public function addProcess(Request $req)
    {
        $username = $req->username;
        $password = $req->password;
        $password = Hash::make($password, ['rounds'=>10]);
        $role = $req->role;

        try {
            $store = DB::table('t_user')->insert([
                'username' => $username,
                'password' => $password,
                'role' => $role,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);

            return redirect()->route('user.list')->with('success', 'Tambah user berhasil!');
        } catch (Throwable $err){
            error_log("Error: " . $err->getMessage());
            return redirect()->back()->with('error', "Tambah user error!");
        }
    }

    public function edit(Request $req)
    {
        $id_to_edit = $req->route('id');

        try {

            $findOne = DB::table('t_user')->where('id', $id_to_edit)->first();
            $data = [
                'page' => 'edit',
                'title' => 'Form Edit',
                'datas' => $findOne
            ];

            return view('user.form')->with(['data'=>$data]);
        } catch (Throwable $err) {
            error_log("Error: ". $err->getMessage());
            return redirect()->back();

        }

        return view('user.form');
    }

    public function editProcess(Request $req)
    {

        $body = $req->all();
        unset($body['_token']);
        
        $getUser = DB::table('t_user')->where('id', $body['id_user'])->first();

        if ($getUser->password == $body['password']) {
            unset($body['password']);
        }

        if(array_key_exists('password', $body)) {
            $body['password'] = Hash::make($body['password'], ['rounds' => 10]);
        }

        $data = $body;
        unset($data['id_user']);

        $data['updated_at'] = Carbon::now()->toDateTimeString();

        // return dd($data);

        try {
            $update = DB::table('t_user')
                ->where('id', $body['id_user'])
                ->update($data);

            return redirect()->route('user.list')->with('success', "Edit user berhasil!");
        } catch (Throwable $err) {
            error_log('Error: '. $err->getMessage());
            return redirect()->back()->with('error', "Edit user error!");
        }
    }

    public function destroy(Request $req) {
        $id = $req->route('id');

        try {
            $delete = DB::table('t_user')->where('id', $id)->delete();

            return redirect()->route('user.list')->with('success', "Hapus user berhasil!");
        } catch (Throwable $err) {
            error_log('Error: ' . $err->getMessage());
            return redirect()->back()->with('error', "Hapus user error!");
        }
    }
}
