<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Tag;
use App\Models\DetailTag;
use App\Models\Gambar;
use App\Models\Ukuran;
use App\Models\Stok;
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
        $data['tag'] = Tag::all();

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

        //  dd($request->all());

        $ukuran = Ukuran::all();

        // dd($ukuran);

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

        $produk = new Produk;
        $produk->kode_produk = $request->input('kode_produk');
        $produk->nama_produk = $request->input('nama_produk');
        $produk->id_kategori = $request->input('kategori');
        $produk->harga_asli = $request->input('harga_asli');
        $produk->harga_coret = $request->input('harga_coret');
        $produk->short_desc = $request->input('short_desc');
        $produk->deskripsi = $request->input('deskripsi');

        try {
            $produk->save();

            foreach($urls as $img) {
                $t_gambar = new Gambar;
                $t_gambar->id_produk = $produk->id;
                $t_gambar->url = $img;

                $t_gambar->save();
            }

            foreach($request->input('tag') as $tag) {
                $detail_tag = new DetailTag;
                $detail_tag->id_produk = $produk->id;
                $detail_tag->id_tag = $tag;

                $detail_tag->save();
            }

            foreach($ukuran as $value) {
                $stok = new Stok();
                $stok->id_produk = $produk->id;
                $stok->size = $value->ukuran;
                $stok->stok = 0;
                $stok->save();
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
        $data['data'] = Produk::with(['kategori', 'gambar', 'detail_tag', 'stok'])->where('id', $id)->first();
        return view('produk.show')->with($data);
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

        $data['data'] = Produk::with(['gambar', 'detail_tag'])->where('id', $id)->first();
        $data['kategori'] = Kategori::all();
        $data['tag'] = Tag::all();

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

        // dd($request->file());

        $urls = [];
        if (!empty($request->file())) {


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

        $produk = Produk::where('id', $id)->first();
        $produk->kode_produk = $request->input('kode_produk');
        $produk->nama_produk = $request->input('nama_produk');
        $produk->id_kategori = $request->input('kategori');
        $produk->harga_asli = $request->input('harga_asli');
        $produk->harga_coret = $request->input('harga_coret');
        $produk->short_desc = $request->input('short_desc');
        $produk->deskripsi = $request->input('deskripsi');

        try {
            $produk->save();

            foreach($urls as $img) {
                $t_gambar = new Gambar;
                $t_gambar->id_produk = $produk->id;
                $t_gambar->url = $img;

                $t_gambar->save();
            }

            foreach($request->input('tag') as $key => $tag){
                $DetailTag = DetailTag::where(['id_produk' => $id, 'id_tag' => $tag])->first();
                if(!$DetailTag){
                    $DetailTag = new DetailTag;
                    $DetailTag->id_produk = $produk->id;
                    $DetailTag->id_tag = $tag;
                    $DetailTag->save();
                } else {
                  //$DetailTag->delete();
                  $NewDetailTag = new DetailTag;
                  $NewDetailTag->id_produk = $produk->id;
                  $NewDetailTag->id_tag = $tag;
                  $NewDetailTag->save();
                } 
            }

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
                $img_url = asset('') ."/". $item->gambar[0]->url;
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
                    <a href='" . route('produk.show', $item["id"]) . "' class='btn btn-info'><i class='fa fa-eye'></i></a>
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

    public function editStok(Request $request, $id) {
        if (empty(session('userdata'))) {
            return redirect()->route('login.page');
        }

        $input_stok = $request->input('stok');

        $stok = Stok::where('id', $id)->first();
        $stok->stok = $input_stok;
        $stok->save();
    }
}
