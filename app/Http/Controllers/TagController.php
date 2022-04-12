<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
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

        return view('tag.list');
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
        
        return view('tag.form');
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
            $Tag = new Tag;
            $Tag->tag = $request->input('tag');
            $Tag->save();
            
            return redirect()->route('tag.list');
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
        
        $data = Tag::where('id', $id)->first();

        return view('tag.form')->with(['data'=> $data]);
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
            $data = Tag::where('id', $id)->first();
            $data->tag = $request->input('tag');
            $data->save();

            return redirect()->route('tag.list')->with('success', "Update data berhasil");
        } catch (\Throwable $err) {
            return redirect()->route('tag.list')->with('error', $err->getMessage());
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
            Tag::destroy($id);
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }   

    public function getForTable()
    {   
        $get_data = Tag::all();
        $data = [];

        foreach ($get_data as $key => $item) {
            $this_data = [];
            $this_data[] = $key + 1;
            //    $this_data['id'] = $item['id'];
            $this_data[] = $item['tag'];

            $this_data[] = "
                <div class='btn-group mr-2'>
                    <a href='" . route('tag.edit', $item["id"]) . "' class='btn btn-warning'><i class='fa fa-pen'></i></a>
                    <a href='" . route('tag.destroy', $item["id"]) . "' class='btn btn-danger disabled'><i class='fa fa-trash'></i></a>
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
