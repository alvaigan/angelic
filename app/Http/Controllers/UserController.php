<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\User as User;
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
        if (empty(session('userdata'))) {
            return redirect()->route('login.page');
        }

        $data  = [
            'page' => 'tambah',
            'title' => 'Form Tambah'
        ];

        return view('user.form')->with(['data'=> $data]);
    }

    public function addProcess(Request $req)
    {
        if (empty(session('userdata'))) {
            return redirect()->route('login.page');
        }
        
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
        if (empty(session('userdata'))) {
            return redirect()->route('login.page');
        }

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
        if (empty(session('userdata'))) {
            return redirect()->route('login.page');
        }

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

    public function getForList()
    {
       $get_data = User::all();
       $data = [];

       foreach ($get_data as $key => $item) {
           $this_data = [];
           $this_data[] = $key+1;
        //    $this_data['id'] = $item['id'];
           $this_data[] = $item['username'];
            $this_data[] = $item['password'];
            $this_data[] = $item['role'];

            $this_data[] = "
                <div class='btn-group mr-2'>
                    <a href='". route('user.edit', $item["id"]). "' class='btn btn-warning'><i class='fa fa-pen'></i></a>
                    <a href='" . route('user.destroy', $item["id"]) . "' class='btn btn-danger'><i class='fa fa-trash'></i></a>
                </div>
            ";

            array_push($data, $this_data);
       }

       $result['data'] = $data;
       $result['src'] = $get_data;
       $result['recordsTotal'] = count($get_data);
       $result['recordsFiltered'] = count($get_data);

    //    dd($result);
       return response()->json($result);
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
