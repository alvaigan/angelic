<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Gambar;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
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
        
        return view('produk.list');
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
        
        $data['kategori'] = Kategori::all();

        // dd($data['kategori'][1]);
        return view('produk.form')->with($data);
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

        $urls = [];

        foreach ($request->file() as $key => $file) {

            $target_path = 'uploads/'.$request->input('kode_produk');
        try {
            $file->move($target_path, $file->getClientOriginalName());
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }

        $this_url = $target_path."/".$file->getClientOriginalName();

        array_push($urls, $this_url);

        }
    
        $tags = explode(',', $request->input('tags'));

        $produk = new Produk;
        $produk->kode_produk = $request->input('kode_produk');
        $produk->nama_produk = $request->input('nama_produk');
        $produk->id_kategori = $request->input('kategori');
        $produk->harga = 0;
        $produk->stok = 0;
        $produk->tags = json_encode($tags);
        $produk->short_desc = $request->input('short_desc');
        $produk->deskripsi = $request->input('deskripsi');
        $produk->url_shopee = $request->input('url_shopee');
        $produk->url_tokped = $request->input('url_tokped');

        try {
            $produk->save();

            foreach($urls as $img) {
                $t_gambar = new Gambar;
                $t_gambar->id_produk = $produk->id;
                $t_gambar->url = $img;

                $t_gambar->save();
            }
         
            return redirect()->route('produk.index')->with('success', 'Tambah barang berhasil!');
        } catch (\Throwable $err) {
            
            return redirect()->back()->with('error', 'Tambah barang gagal! : '. $err->getMessage());
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
        
        $data['data'] = Produk::with('gambar')->where('id', $id)->first();
        $data['kategori'] = Kategori::all();
        
        return view('produk.form')->with($data);
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
        
        if (!empty($request->file())) {

            $urls = [];

        foreach ($request->file() as $key => $file) {

            $target_path = 'public/uploads/'.$request->input('kode_produk');
        try {
            $file->move($target_path, $file->getClientOriginalName());
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }

        $this_url = $target_path."/".$file->getClientOriginalName();

        array_push($urls, $this_url);

        }
        }

        $tags = explode(',', $request->input('tags'));

        $produk = Produk::where('id', $id)->first();
        $produk->kode_produk = $request->input('kode_produk');
        $produk->nama_produk = $request->input('nama_produk');
        $produk->id_kategori = $request->input('kategori');
        $produk->harga = 0;
        $produk->stok = 0;
        $produk->tags = json_encode($tags);
        $produk->short_desc = $request->input('short_desc');
        $produk->deskripsi = $request->input('deskripsi');
        $produk->url_shopee = $request->input('url_shopee');
        $produk->url_shopee = $request->input('url_tokped');

        // return dd($produk);
        try {
            $produk->save();
            
            return redirect()->route('produk.index')->with('success', "Edit barang berhasil!");
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', "Edit barang gagal!: ".$err->getMessage());
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
            Produk::destroy($id);
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    public function getForTable()
    {
        $get_data = Produk::with('gambar')->get();
        $data = [];

        // dd($get_data[2]);  

        foreach ($get_data as $key => $item) {

            // dd($item->gambar);
            if (!empty($item->gambar[0])) {
                $img_url = asset('public') . $item->gambar[0]->url;
            } else {
                $img_url = '';
            }

            // dd($img_url);

            $kategori = Kategori::where('id', $item['id_kategori'])->first();

            $this_data = [];
            $this_data[] = $key + 1;
            //    $this_data['id'] = $item['id'];
            $this_data[] = "<img style='width: 160px' src=".$img_url." />";
            $this_data[] = $item['kode_produk'];
            $this_data[] = $item['nama_produk'];
            $this_data[] = $kategori['kategori'];

            $this_data[] = "
                <div class='btn-group mr-2'>
                    <a href='" . route('produk.edit', $item["id"]) . "' class='btn btn-warning'><i class='fa fa-pen'></i></a>
                    <a href='" . route('produk.destroy', $item["id"]) . "' class='btn btn-danger'><i class='fa fa-trash'></i></a>
                </div>
            ";

            array_push($data, $this_data);
        }

        $result['data'] = $data;
        $result['src'] = $get_data;
        $result['recordsTotal'] = count($get_data);
        $result['recordsFiltered'] = count($get_data);

        // dd($result['data'][2]);

        return response()->json($result);
    }
}
