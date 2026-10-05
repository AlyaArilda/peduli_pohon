<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArtikelApiResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'judul_artikel' => $this->judul_artikel,
            'penganalisa' => $this->penganalisa,
            'gambar' => $this->gambar,
            'isi_artikel' => $this->isi_artikel,
            'waktu_update' => $this->waktu_update,
            'tanggal' => $this->tanggal,
            'created_at' => $this->created_at,
            'foto_penganalisa' => $this->foto_penganalisa,
        ];
    }
}
