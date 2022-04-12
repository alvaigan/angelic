<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 't_transaksi';
    protected $primaryKey = 'id';

    public $timestamps = true;

    public function detail_transaksi()
    {
        return $this->hasMany('App\Models\DetailTransaksi', 'id_transaksi', 'id');
    }
}
