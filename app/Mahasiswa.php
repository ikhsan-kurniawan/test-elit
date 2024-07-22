<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'namaMahasiswa', 'nimMahasiswa', 'angkatanMahasiswa', 'pekerjaanMahasiswa', 'judulskripsiMahasiswa', 'pembimbing1', 'pembimbing2', 'fotoMahasiswa', 'ijazahMahasiswa',
    ];
}
