<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $fillable = [
        'nama_kategori',
        'description'
    ];

    public function pohon(){
        return $this->hasMany(Pohon::class,'kategori_id','id');
    }
}
