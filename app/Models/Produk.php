<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 't_produk';
    protected $primaryKey = 'id';
    // protected $incrementing = true;
    public $timestamps = true;

    public function gambar() {
        return $this->hasMany(Gambar::class, 'id_produk', 'id');
    }

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
}