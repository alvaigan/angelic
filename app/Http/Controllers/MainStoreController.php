<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Ukuran;
use App\Models\Transaksi;
use App\Models\Banner;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;

class MainStoreController extends Controller
{
    public function index()
    {
        $data['data'] = Produk::limit(8)->with('gambar')->get();
        $data['kategori'] = Kategori::all();
        $data['banner'] = Banner::where('show', 1)->orderBy('urutan', 'asc')->get();
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
    {
        $data['data'] = Produk::with('stok', 'gambar', 'kategori', 'detail_tag', 'tag')->where('id', $id)->first();
        $data['size'] = Ukuran::all();
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

    public function cart(Request $request)
    {
        $payload_string = urldecode($request->data);
        $payload = json_decode($payload_string);
        $temp = [];

        //  dd($payload);
        if (!empty($payload)) {
            foreach ($payload as $key => $value) {
                $_data = Produk::with('gambar', 'kategori', 'detail_tag', 'tag')->where('id', $value->id)->first();
                $_data->size = $value->size;
                $_data->qty = $value->qty;
                $temp[] = $_data;
            }
        }

        $data['data'] = $temp;
        $data['page'] = "cart";

        return view('cart.cart', $data);
    }

    public function checkout(Request $request)
    {
        $data['page'] = "checkout";

        return view('checkout.checkout', $data);
    }

    public function checkout_process(Request $request)
    {
        $order_data = json_decode($request->order);
        $final_total = $order_data->final_total;
        $nama_lengkap = $request->input('nama_lengkap');
        $email = $request->input('email');
        $no_telp = $request->input('no_telp');
        $alamat = $request->input('alamat');
        $provinsi = $request->input('provinsi');
        $kota = $request->input('kota');
        $kecamatan = $request->input('kecamatan');
        $kelurahan = $request->input('kelurahan');
        $rtrw = $request->input('rtrw');
        $kode_pos = $request->input('kode_pos');

        try {
            $kode_pemesanan = $this->generateRandomNumber() . substr(strtoupper($request->nama_lengkap), 0, 3) . $request->kode_pos;
            // dd($kode_pemesanan);
            $transaksi = new Transaksi;
            $transaksi->kode_pemesanan = $kode_pemesanan;
            $transaksi->total_harga = $final_total;
            $transaksi->nama_lengkap = $nama_lengkap;
            $transaksi->email = $email;
            $transaksi->no_telp = $no_telp;
            $transaksi->alamat = $alamat;
            $transaksi->provinsi = $provinsi;
            $transaksi->kota = $kota;
            $transaksi->kecamatan = $kecamatan;
            $transaksi->kelurahan = $kelurahan;
            $transaksi->rtrw = $rtrw;
            $transaksi->kode_pos = $kode_pos;
            $transaksi->status = "baru";
            $transaksi->save();

            foreach ($order_data->detail_order as $key => $value) {
                $id_produk = $value->id;
                $size = $value->size;
                $qty = $value->qty;
                $sub_total = $value->sub_total;

                $id_ukuran = Ukuran::where('ukuran', $size)->first()->id;

                $detail_transaksi = new DetailTransaksi;
                $detail_transaksi->id_transaksi = $transaksi->id;
                $detail_transaksi->id_produk = $id_produk;
                $detail_transaksi->id_ukuran = $id_ukuran;
                $detail_transaksi->qty = $qty;
                $detail_transaksi->subtotal_harga = $sub_total;
                $detail_transaksi->save();
            }
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', "Order gagal!: " . $err->getMessage());
        }

        $data['page'] = 'checkouted_info';

        return redirect()->route('checkouted_info', $transaksi->id);


    }

    function checkouted_info(Request $request, $id) {
        $data['data'] = Transaksi::where('id', $id)->first();
        $data['page'] = 'checkouted_info';
        return view('checkout.checkouted_info')->with($data);
    }

    function direct_whatsapp(Request $request, $id) {

        $transaksi = Transaksi::with('detail_transaksi.produk', 'detail_transaksi.ukuran')->where('id', $id)->first();
        $detail_transaksi = $transaksi->detail_transaksi;

        // dd($detail_transaksi);
        $head = "Halo, Saya pesan barang melalui website dengan detail berikut :
            Atas Nama: $transaksi->nama_lengkap
            Kode Pemesanan: $transaksi->kode_pemesanan
            Total Pembayaran: Rp. $transaksi->total_harga
            ==========";
        foreach ($detail_transaksi as $index => $dat) {
            $produk = $dat->produk->nama_produk;
            $ukuran = $dat->ukuran->ukuran;
            $jumlah = $dat->qty;
            $subtotal = $dat->subtotal_harga;

            $head .= "
            Produk: $produk
            Ukuran: $ukuran
            Jumlah: $jumlah
            Subtotal: Rp $subtotal
            ==========";
        }

        $footer = "==========
Apakah barang2 tersebut ready?";
        $wording = $head .= $footer;
        $trim_tab = str_replace("\t", "", $wording);
        $final_wording = 'https://wa.me/6287828925046?text=' . urlencode($trim_tab);
        // dd($final_wording);
        return redirect($final_wording);
    }

    public function checkorder(Request $request){
        $data['page'] = 'checkorder';
        return view('checkout.checkorder')->with($data);
    }

    public function checkorder_process(Request $request) {
        $check_transaksi = Transaksi::with('detail_transaksi.produk', 'detail_transaksi.ukuran')->where('kode_pemesanan', $request->input('kode'))->first();
        if ($check_transaksi) {
            $data['data'] = $check_transaksi;
            $data['page'] = 'checkorder_process';
        } else {
            $data['page'] = 'checkorder';
            $data['error'] = 'Kode pemesanan tidak ditemukan';
        }

        return response()->json($data);
    }

    function generateRandomNumber()
    {
        $number = random_int(1, 1000000);
        $number = str_pad($number, 6, '0', STR_PAD_LEFT);
        return $number;
    }
}
