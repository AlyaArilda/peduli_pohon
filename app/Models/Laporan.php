<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{

    protected $table = 'laporans';

    protected $fillable = [
        'user_id',
        'lokasi_pohon',
        'waktu_ditemukan',
        'deskripsi_kerusakan',
        'foto_kerusakan',
        'nama_pelapor',
        'telp',
        'email',
        'status',
        'foto_perbaikan',
        'deskripsi_perbaikan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
