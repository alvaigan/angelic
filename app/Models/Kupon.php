<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kupon extends Model
{
    use HasFactory;

    protected $table = 't_kupon';
    protected $primaryKey = 'id';

    public $timestamps = true;
}
