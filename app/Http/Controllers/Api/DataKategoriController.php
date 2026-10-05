<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;

class DataKategoriController extends Controller
{

    public function index()
    {
        $kategoris = Kategori::all();
        return response()->json($kategoris);
    }
}
