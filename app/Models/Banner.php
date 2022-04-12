<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 't_banner';
    protected $primaryKey = 'id';
    // protected $incrementing = true;
    public $timestamps = true;
}
