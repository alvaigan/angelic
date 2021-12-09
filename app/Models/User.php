<?php

namespace App\Models;
use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 't_user';
    protected $primaryKey = 'id';
    // protected $incrementing = true;
    public $timestamps = true;
}
