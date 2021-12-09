<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class MainStoreController extends Controller
{
    public function index()
    {
        $data['data'] = Produk::limit(8)->with('gambar')->get();
        $data['kategori'] = Kategori::all();
        $data['page'] = "home";

        return view('home.home')->with($data);
    }

    public function catalogue(Request $request)
    {   
        $kategori = $request->query('kategori'); 

        $data['kategori'] = Kategori::all();
        if (!empty($request->query('kategori'))) {
            $data['data'] = Produk::where('id_kategori', $kategori)->with('gambar')->get();
        } else {
            $data['data'] = Produk::with('gambar')->get();
        }

        $data['page'] = "catalogue";

        return view('catalogue.catalogue')->with($data);
    }

    public function detail($id)
    {   $data['data'] = Produk::with('gambar', 'kategori')->where('id', $id)->first();
        $data['related'] = Produk::limit(4)
            ->with('gambar', 'kategori')
            ->where([
                ['id_kategori', '=', $data['data']->id_kategori],
                ['id', '!=', $id]
            ])
            ->get();
        $data['page'] = "detail";
        // dd($data);
        return view('detail.detail')->with($data);
    }
}
