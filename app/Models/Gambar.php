<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;

    protected $table = 't_gambar';
    protected $primaryKey = 'id';
    // protected $incrementing = true;
    public $timestamps = true;

    // public function gambar() {
    //     return $this->belongsTo(Produk::class);
    // }
}
