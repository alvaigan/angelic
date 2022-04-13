<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Ukuran;
use App\Models\Transaksi;
use App\Models\Banner;
use App\Models\Tag;

class DashboardController extends Controller
{
    public function index()
    {
        if(empty(session('userdata'))) {
            return redirect()->route('login.page');
        }

        $data['kategori'] = Kategori::all();
        $data['tag'] = Tag::all();
        $data['ukuran'] = Ukuran::all();
        $data['banner'] = Banner::all();
        $data['produk'] = Produk::with('kategori', 'stok')->get();
        
        return view('dashboard')->with($data);
    }
}
