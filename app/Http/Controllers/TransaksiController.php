<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function neworder()
    {
        $data['page'] = 'neworder';
        return view('transaksi.list')->with($data);
    }

    public function neworder_data()
    {
        $call_transaksi = Transaksi::where('status', 'baru')->get();
        $data = [];
        foreach ($call_transaksi as $key => $item) {
            $tanggal = date('d-m-Y H:i:s', strtotime($item->created_at));

            $this_data = [];
            $this_data[] = $key + 1;
            $this_data[] = $tanggal;
            $this_data[] = $item->kode_pemesanan;
            $this_data[] = $item->nama_lengkap;
            $this_data[] = $item->kota . ", " . $item->provinsi . " " . $item->kode_pos;
            $this_data[] = "<h5><span class='badge badge-primary'>" . $item->status . "</span></h5>";
            $this_data[] = "
                <div class='btn-group mr-2'>
                    <a href='".route('transaksi.getone_data', $item->id)."' class='btn btn-success'><small class='font-weight-bold'>Update Status</small></a>
                    <a href='#' data-url='".route('transaksi.getone_data', $item->id)."' class='btn btn-info'><i class='fa fa-eye'></i></a>
                    <a href='".route('transaksi.destroy', $item->id)."' class='btn btn-danger'><i class='fa fa-trash'></i></a>
                </div>
            ";

            array_push($data, $this_data);
        }

        $result['data'] = $data;
        $result['src'] = $call_transaksi;
        $result['recordsTotal'] = count($call_transaksi);
        $result['recordsFiltered'] = count($call_transaksi);
        return response()->json($result);
    }

    public function dibayar()
    {
        $data['page'] = 'dibayar';
        return view('transaksi.list')->with($data);
    }

    public function dibayar_data()
    {
        $call_transaksi = Transaksi::where('status', 'dibayar')->get();
        $data = [];
        foreach ($call_transaksi as $key => $item) {
            $tanggal = date('d-m-Y H:i:s', strtotime($item->created_at));

            $this_data = [];
            $this_data[] = $key + 1;
            $this_data[] = $tanggal;
            $this_data[] = $item->kode_pemesanan;
            $this_data[] = $item->nama_lengkap;
            $this_data[] = $item->kota . ", " . $item->provinsi . " " . $item->kode_pos;
            $this_data[] = "<h5><span class='badge badge-info'>" . $item->status . "</span></h5>";
            $this_data[] = "
                <div class='btn-group mr-2'>
                    <a href='".route('transaksi.getone_data', $item->id)."' class='btn btn-success'><small class='font-weight-bold'>Update Status</small></a>
                    <a href='#' data-url='".route('transaksi.getone_data', $item->id)."' class='btn btn-info'><i class='fa fa-eye'></i></a>
                    <a href='".route('transaksi.destroy', $item->id)."' class='btn btn-danger'><i class='fa fa-trash'></i></a>
                </div>
            ";

            array_push($data, $this_data);
        }

        $result['data'] = $data;
        $result['src'] = $call_transaksi;
        $result['recordsTotal'] = count($call_transaksi);
        $result['recordsFiltered'] = count($call_transaksi);
        return response()->json($result);
    }

    public function dikemas()
    {
        $data['page'] = 'dikemas';
        return view('transaksi.list')->with($data);
    }

    public function dikemas_data()
    {
        $call_transaksi = Transaksi::where('status', 'dikemas')->get();
        $data = [];
        foreach ($call_transaksi as $key => $item) {
            $tanggal = date('d-m-Y H:i:s', strtotime($item->created_at));

            $this_data = [];
            $this_data[] = $key + 1;
            $this_data[] = $tanggal;
            $this_data[] = $item->kode_pemesanan;
            $this_data[] = $item->nama_lengkap;
            $this_data[] = $item->kota . ", " . $item->provinsi . " " . $item->kode_pos;
            $this_data[] = "<h5><span class='badge badge-secondary'>" . $item->status . "</span></h5>";
            $this_data[] = "
                <div class='btn-group mr-2'>
                    <a href='".route('transaksi.getone_data', $item->id)."' class='btn btn-success'><small class='font-weight-bold'>Update Status</small></a>
                    <a href='#' data-url='".route('transaksi.getone_data', $item->id)."' class='btn btn-info'><i class='fa fa-eye'></i></a>
                    <a href='".route('transaksi.destroy', $item->id)."' class='btn btn-danger'><i class='fa fa-trash'></i></a>
                </div>
            ";

            array_push($data, $this_data);
        }

        $result['data'] = $data;
        $result['src'] = $call_transaksi;
        $result['recordsTotal'] = count($call_transaksi);
        $result['recordsFiltered'] = count($call_transaksi);
        return response()->json($result);
    }

    public function dikirim()
    {
        $data['page'] = 'dikirim';
        return view('transaksi.list')->with($data);
    }

    public function dikirim_data()
    {
        $call_transaksi = Transaksi::where('status', 'dikirim')->get();
        $data = [];
        foreach ($call_transaksi as $key => $item) {
            $tanggal = date('d-m-Y H:i:s', strtotime($item->created_at));

            $this_data = [];
            $this_data[] = $key + 1;
            $this_data[] = $tanggal;
            $this_data[] = $item->kode_pemesanan;
            $this_data[] = $item->nama_lengkap;
            $this_data[] = $item->kota . ", " . $item->provinsi . " " . $item->kode_pos;
            $this_data[] = "<h5><span class='badge badge-warning'>" . $item->status . "</span></h5>";
            $this_data[] = "
                <div class='btn-group mr-2'>
                    <a href='".route('transaksi.getone_data', $item->id)."' class='btn btn-success'><small class='font-weight-bold'>Update Status</small></a>
                    <a href='#' data-url='".route('transaksi.getone_data', $item->id)."' class='btn btn-info'><i class='fa fa-eye'></i></a>
                    <a href='".route('transaksi.destroy', $item->id)."' class='btn btn-danger'><i class='fa fa-trash'></i></a>
                </div>
            ";

            array_push($data, $this_data);
        }

        $result['data'] = $data;
        $result['src'] = $call_transaksi;
        $result['recordsTotal'] = count($call_transaksi);
        $result['recordsFiltered'] = count($call_transaksi);
        return response()->json($result);
    }

    public function selesai()
    {
        $data['page'] = 'selesai';
        return view('transaksi.list')->with($data);
    }

    public function selesai_data()
    {
        $call_transaksi = Transaksi::where('status', 'selesai')->get();
        $data = [];
        foreach ($call_transaksi as $key => $item) {
            $tanggal = date('d-m-Y H:i:s', strtotime($item->created_at));

            $this_data = [];
            $this_data[] = $key + 1;
            $this_data[] = $tanggal;
            $this_data[] = $item->kode_pemesanan;
            $this_data[] = $item->nama_lengkap;
            $this_data[] = $item->kota . ", " . $item->provinsi . " " . $item->kode_pos;
            $this_data[] = "<h5><span class='badge badge-success'>" . $item->status . "</span></h5>";
            $this_data[] = "
                <div class='btn-group mr-2'>
                    <a href='".route('transaksi.getone_data', $item->id)."' class='btn btn-success'><small class='font-weight-bold'>Update Status</small></a>
                    <a href='#' data-url='".route('transaksi.getone_data', $item->id)."' class='btn btn-info'><i class='fa fa-eye'></i></a>
                    <a href='".route('transaksi.destroy', $item->id)."' class='btn btn-danger'><i class='fa fa-trash'></i></a>
                </div>
            ";

            array_push($data, $this_data);
        }

        $result['data'] = $data;
        $result['src'] = $call_transaksi;
        $result['recordsTotal'] = count($call_transaksi);
        $result['recordsFiltered'] = count($call_transaksi);
        return response()->json($result);
    }

    public function getone_data(Request $request, $id)
    {
        $data['data'] = Transaksi::with('detail_transaksi.produk', 'detail_transaksi.ukuran')->where('id', $id)->first();
        return response()->json($data);
    }

    public function update_status(Request $request, $id)
    {
        $status = $request->input('status');
        
        $call_transaksi = Transaksi::where('id', $id)->first();
        $call_transaksi->status = $status;
        $call_transaksi->save();
    }

    public function destroy($id)
    {
        try {
            Transaksi::destroy($id);
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }    
}
