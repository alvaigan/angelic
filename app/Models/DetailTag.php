<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTag extends Model
{
    use HasFactory;

    protected $table = 't_detail_tag';
    protected $primaryKey = 'id';

    public $timestamps = true;

    public function tag() {
        return $this->belongsTo(Tag::class, 'id_tag', 'id');
    }
}
