<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 't_detail_transaksi';
    protected $primaryKey = 'id';

    public $timestamps = true;

    public function transaksi()
    {
        return $this->belongsTo('App\Models\Transaksi', 'id_transaksi', 'id');
    }

    public function produk()
    {
        return $this->belongsTo('App\Models\Produk', 'id_produk', 'id');
    }

    public function ukuran()
    {
        return $this->belongsTo('App\Models\Ukuran', 'id_ukuran', 'id');
    }
}
