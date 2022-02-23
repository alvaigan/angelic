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

    public function detail_tag() {
        return $this->hasMany(DetailTag::class, 'id_produk', 'id');
    }

    public function tag() {
        return $this->belongsToMany(Tag::class, 't_detail_tag', 'id_produk', 'id_tag');
    }
}
