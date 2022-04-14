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

        $data['kategori'] = Kategori::all()->count();
        $data['tag'] = Tag::all()->count();
        $data['ukuran'] = Ukuran::all()->count();
        $data['banner'] = Banner::all()->count();
        $data['produk'] = Produk::with('kategori', 'stok')->get();
        $baru = Transaksi::where('status', 'baru')->get();
        $dibayar = Transaksi::where('status', 'dibayar')->get('status');
        $dikemas = Transaksi::where('status', 'dikemas')->get('status');
        $dikirim = Transaksi::where('status', 'dikirim')->get('status');
        $selesai = Transaksi::where('status', 'selesai')->get('status');

        $json_baru = new \stdClass();
        $json_baru->status = 'baru';
        $json_baru->jumlah = $baru->count();

        $json_dibayar = new \stdClass();
        $json_dibayar->status = 'dibayar';
        $json_dibayar->jumlah = $dibayar->count();

        $json_dikemas = new \stdClass();
        $json_dikemas->status = 'dikemas';
        $json_dikemas->jumlah = $dikemas->count();

        $json_dikirim = new \stdClass();
        $json_dikirim->status = 'dikirim';
        $json_dikirim->jumlah = $dikirim->count();

        $json_selesai = new \stdClass();
        $json_selesai->status = 'selesai';
        $json_selesai->jumlah = $selesai->count();

        $transaksi = [
            $json_baru,
            $json_dibayar,
            $json_dikemas,
            $json_dikirim,
            $json_selesai,
        ];

        $data['transaksi'] = $transaksi;
        
        return view('dashboard')->with($data);
    }
}
