<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Ukuran;
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
    {   $data['data'] = Produk::with('stok', 'gambar', 'kategori', 'detail_tag', 'tag')->where('id', $id)->first();
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

    public function cart(Request $request) {
        $payload_string = urldecode($request->data);
        $payload = json_decode($payload_string);
        $temp = [];

        //  dd($payload);
        if(!empty($payload)) {
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

    public function checkout(Request $request) {
        $data['page'] = "checkout";

        return view('checkout.checkout', $data);
    }

    public function checkout_process(Request $request) {
        $order_data = json_decode($request->order);

        // foreach ($order_data as $key => $value) {
        //     $id_produk = $value->id;
        //     $price = $value->price;
        //     $qty = $value->qty;
        //     $subtotal = $value->subtotal;
        // }

        dd($order_data);

        $head = "Halo, Saya pesan barang melalui website dengan detail berikut :
            Atas Nama: Acakadut
            Kode Transaksi: AG23FKS13
            ==========";
        $body = "";
        $footer = "==========
        Apakah barang2 tersebut ready?";

        $wording_text = "Halo, Saya pesan barang melalui website dengan detail berikut :
            Atas Nama: Acakadut
            Kode Transaksi: AG23FKS13
            ==========

            1. Angelic Kaos
            ukuran : L
            qty: 2
            sub total: 200000
            2. Angelic Kaos
            ukuran : M
            qty : 2
            sub total : 300000

            Total Harga : Rp 500000

            ==========
            Apakah barang2 tersebut sudah ready?";
        $wording = $head . $body . $footer;
    }
}

