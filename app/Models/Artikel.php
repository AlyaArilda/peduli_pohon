<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikels';
    protected $fillable = [
        'judul_artikel',
        'penganalisa',
        'foto_penganalisa', // tambahkan ini
        'gambar',
        'isi_artikel',
        'waktu_update',
        'tanggal'
    ];

}
