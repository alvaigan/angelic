<?php

namespace App\Http\Controllers;

use App\Models\Kupon;
use Illuminate\Http\Request;

class KuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (empty(session('userdata'))) {
            return redirect()->route('login.page');
        }

        return view('kupon.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (empty(session('userdata'))) {
            return redirect()->route('login.page');
        }
        
        return view('kupon.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty(session('userdata'))) {
            return redirect()->route('login.page');
        }
        
        try {
            $Kupon = new Kupon;
            $Kupon->kode_kupon = $request->input('kode_kupon');
            $Kupon->potongan = $request->input('potongan');
            $Kupon->save();
            
            return redirect()->route('kupon.list');
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (empty(session('userdata'))) {
            return redirect()->route('login.page');
        }
        
        $data = Kupon::where('id', $id)->first();

        return view('kupon.form')->with(['data'=> $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (empty(session('userdata'))) {
            return redirect()->route('login.page');
        }
        
        try {
            $data = Kupon::where('id', $id)->first();
            $data->kode_kupon = $request->input('kode_kupon');
            $data->potongan = $request->input('potongan');
            $data->save();

            return redirect()->route('kupon.list')->with('success', "Update data berhasil");
        } catch (\Throwable $err) {
            return redirect()->route('kupon.list')->with('error', $err->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty(session('userdata'))) {
            return redirect()->route('login.page');
        }
        
        try {
            Kupon::destroy($id);
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    public function check_kupon($kode_kupon)
    {
        if (empty($kode_kupon)) {
            return response()->json(['status'=> false, 'message'=> 'Kode kupon tidak ditemukan']);
        }
        $data = Kupon::where('kode_kupon', $kode_kupon)->first();
        if (empty($data)) {
            return response()->json(['status'=> false, 'message'=> 'Kupon tidak ditemukan']);
        } else {
            return response()->json(['status'=> true, 'message'=> 'Kupon ditemukan', 'data'=> $data]);
        }
    }

    public function getForTable()
    {   
        $get_data = Kupon::all();
        $data = [];

        foreach ($get_data as $key => $item) {
            $this_data = [];
            $this_data[] = $key + 1;
            //    $this_data['id'] = $item['id'];
            $this_data[] = $item['kode_kupon'];
            $this_data[] = $item['potongan'];

            $this_data[] = "
                <div class='btn-group mr-2'>
                    <a href='" . route('kupon.edit', $item["id"]) . "' class='btn btn-warning'><i class='fa fa-pen'></i></a>
                    <a href='" . route('kupon.destroy', $item["id"]) . "' class='btn btn-danger'><i class='fa fa-trash'></i></a>
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
}
