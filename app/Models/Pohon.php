<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pohon extends Model
{
    protected $table = 'pohons';
    protected $fillable = [
        'nama_pohon',
        'kategori_id',
        'gambar_pohon',
        'deskripsi',
        'manfaat',
        'nama_pj',
        'foto_pj',
        'alamat',
        'telp_pj',
        'user_id',
        'tinggi',     
        'tajuk',      
        'cocok_untuk',
    ];

    protected $casts = [
        'cocok_untuk' => 'array',
    ];

    public function kategori()
{
    return $this->belongsTo(Kategori::class);
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
