<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('banner.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banner.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('url_banner');
        $urutan = $request->input('urutan');
        $show = $request->input('show');

        if ($show == 'true') {
            $show = 1;
        } else if ($show == 'false') {
            $show = 0;
        } else {
            return redirect()->back()->with('error', "Unknown 'show' data value!");
        }

        $target_path = "public/uploads/banners/";
        try {
            $file->move($target_path, $file->getClientOriginalName());
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }

        $url_banner = $target_path . $file->getClientOriginalName(); 

        $banner = new Banner;
        $banner->url_banner = $url_banner;
        $banner->urutan = $urutan;
        $banner->show = $show;
        try {
            $banner->save();
            return redirect()->route("banner.list")->with('success', 'Tambah Banner berhasil!');
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
        $banner = Banner::find($id);
        $data['data'] = $banner;

        return view('banner.form')->with($data);
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
        $file = $request->file('url_banner');
        $urutan = $request->input('urutan');
        $show = $request->input('show');

        if ($show == 'true') {
            $show = 1;
        } else if ($show == 'false') {
            $show = 0;
        } else {
            return redirect()->back()->with('error', "Unknown 'show' data value!");
        }

        if ($file) {
            $target_path = "public/uploads/banners/";
        try {
            $file->move($target_path, $file->getClientOriginalName());
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }

        $url_banner = $target_path . $file->getClientOriginalName(); 

        $banner = Banner::find($id);
        $banner->url_banner = $url_banner;
        $banner->urutan = $urutan;
        $banner->show = $show;
        } else {
            $banner = Banner::find($id);
            $banner->urutan = $urutan;
            $banner->show = $show;
        }
        
        try {
            $banner->save();
            return redirect()->route("banner.list")->with('success', 'Edit Banner berhasil!');
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', $err->getMessage());
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
        $banner = Banner::find($id);
        try {
            $banner->delete();
            return redirect()->route("banner.list")->with('success', 'Hapus Banner berhasil!');
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    public function getForTable()
    {
        $get_data = Banner::all();
        $data = [];

        foreach ($get_data as $key => $item) {
            $this_data = [];
            $this_data[] = $key + 1;
            //    $this_data['id'] = $item['id'];
            $img_url = asset('') . "/" . $item->url_banner;
            $this_data[] = "<img style='width: 160px' src='$img_url' />";
            $this_data[] = $item['urutan'];
            if ($item['show'] == 1) {
                $tampilkan = 'Ya';
            } else {
                $tampilkan = 'Tidak';
            }
            $this_data[] = $tampilkan;

            $this_data[] = "
                <div class='btn-group mr-2'>
                    <a href='" . route('banner.edit', $item["id"]) . "' class='btn btn-warning'><i class='fa fa-pen'></i></a>
                    <a href='" . route('banner.destroy', $item["id"]) . "' class='btn btn-danger'><i class='fa fa-trash'></i></a>
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
