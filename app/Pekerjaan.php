<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $fillable = [
        'namaPekerjaan',
        'alamatPekerjaan',
        'nomorHP',
    ];
}
