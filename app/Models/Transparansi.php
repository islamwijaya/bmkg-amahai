<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transparansi extends Model
{
    protected $fillable = ['title', 'category', 'file_path', 'year'];
}
