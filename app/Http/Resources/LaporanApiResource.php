<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaporanApiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'lokasi_pohon' => $this->lokasi_pohon,
            'waktu_ditemukan' => $this->waktu_ditemukan,
            'deskripsi_kerusakan' => $this->deskripsi_kerusakan,
            'foto_kerusakan' => $this->foto_kerusakan,
            'nama_pelapor' => $this->nama_pelapor,
            'telp' => $this->telp,
            'email' => $this->email,
            'status' => $this->status,
            'foto_perbaikan' => $this->foto_perbaikan,
            'deskripsi_perbaikan' => $this->deskripsi_perbaikan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
