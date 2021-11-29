<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kategori.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $kategori = new Kategori;
            $kategori->kategori = $request->input('kategori');
            $kategori->save();
            
            return redirect()->route('kategori.index');
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
        $data = Kategori::where('id', $id)->first();

        return view('kategori.form')->with(['data'=> $data]);
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
        try {
            $data = Kategori::where('id', $id)->first();
            $data->kategori = $request->input('kategori');
            $data->save();

            return redirect()->route('kategori.index')->with('success', "Update data berhasil");
        } catch (\Throwable $err) {
            return redirect()->route('kategori.index')->with('error', $err->getMessage());
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
        try {
            Kategori::destroy($id);
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }   

    public function getForTable()
    {
        $get_data = Kategori::all();
        $data = [];

        foreach ($get_data as $key => $item) {
            $this_data = [];
            $this_data[] = $key + 1;
            //    $this_data['id'] = $item['id'];
            $this_data[] = $item['kategori'];

            $this_data[] = "
                <div class='btn-group mr-2'>
                    <a href='" . route('kategori.edit', $item["id"]) . "' class='btn btn-warning'><i class='fa fa-pen'></i></a>
                    <a href='" . route('kategori.destroy', $item["id"]) . "' class='btn btn-danger'><i class='fa fa-trash'></i></a>
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
