<?php

namespace App\Http\Controllers;

use App\Models\Ukuran;
use Illuminate\Http\Request;

class UkuranController extends Controller
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

        return view('ukuran.list');
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
        
        return view('ukuran.form');
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
            $Ukuran = new Ukuran;
            $Ukuran->ukuran = $request->input('ukuran');
            $Ukuran->save();
            
            return redirect()->route('ukuran.list');
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
        
        $data = Ukuran::where('id', $id)->first();

        return view('ukuran.form')->with(['data'=> $data]);
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
            $data = Ukuran::where('id', $id)->first();
            $data->ukuran = $request->input('ukuran');
            $data->save();

            return redirect()->route('ukuran.list')->with('success', "Update data berhasil");
        } catch (\Throwable $err) {
            return redirect()->route('ukuran.list')->with('error', $err->getMessage());
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
            Ukuran::destroy($id);
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    
    public function getForTable()
    {   
        $get_data = Ukuran::all();
        $data = [];

        foreach ($get_data as $key => $item) {
            $this_data = [];
            $this_data[] = $key + 1;
            //    $this_data['id'] = $item['id'];
            $this_data[] = $item['ukuran'];

            $this_data[] = "
                <div class='btn-group mr-2'>
                    <a href='" . route('ukuran.edit', $item["id"]) . "' class='btn btn-warning'><i class='fa fa-pen'></i></a>
                    <a href='" . route('ukuran.destroy', $item["id"]) . "' class='btn btn-danger disabled'><i class='fa fa-trash'></i></a>
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
