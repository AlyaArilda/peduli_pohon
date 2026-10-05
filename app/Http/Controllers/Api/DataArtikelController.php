<?php

namespace App\Http\Controllers\Api;

use App\Models\Artikel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DataArtikelController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Artikel::latest()->get()
        ]);
    }

    public function show($id)
    {
        $artikel = Artikel::find($id);

        if (!$artikel) {
            return response()->json(['success' => false, 'message' => 'Artikel tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $artikel]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_artikel' => 'required|string|max:255',
            'penganalisa' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'isi_artikel' => 'required|string',
            'waktu_update' => 'nullable',
            'tanggal' => 'nullable|date',
            'foto_penganalisa' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $data = $request->only([
            'judul_artikel',
            'penganalisa',
            'isi_artikel',
            'waktu_update',
            'tanggal',
            'foto_penganalisa'
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('artikel', 'public');
            $data['gambar'] = $path;
        }

        if ($request->hasFile('foto_penganalisa')) {
            $path = $request->file('foto_penganalisa')->store('penganalisa', 'public');
            $data['foto_penganalisa'] = $path;
        }

        $data['isi_artikel'] = strip_tags($request->isi_artikel);

        $artikel = Artikel::create($data);

        return response()->json(['success' => true, 'data' => $artikel]);
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::find($id);
        if (!$artikel) {
            return response()->json(['success' => false, 'message' => 'Artikel tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'judul_artikel' => 'sometimes|required|string|max:255',
            'penganalisa' => 'sometimes|required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'isi_artikel' => 'sometimes|required|string',
            'waktu_update' => 'nullable',
            'tanggal' => 'nullable|date',
            'foto_penganalisa' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $data = $request->only([
            'judul_artikel',
            'penganalisa',
            'isi_artikel',
            'waktu_update',
            'tanggal',
            'foto_penganalisa'
        ]);

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar && Storage::disk('public')->exists($artikel->gambar)) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $path = $request->file('gambar')->store('artikel', 'public');
            $data['gambar'] = $path;
        }

        if ($request->hasFile('foto_penganalisa')) {
            if ($artikel->foto_penganalisa && Storage::disk('public')->exists($artikel->foto_penganalisa)) {
                Storage::disk('public')->delete($artikel->foto_penganalisa);
            }
            $path = $request->file('foto_penganalisa')->store('penganalisa', 'public');
            $data['foto_penganalisa'] = $path;
        }

        if ($request->has('isi_artikel')) {
            $data['isi_artikel'] = strip_tags($request->isi_artikel);
        }

        $artikel->update($data);

        return response()->json(['success' => true, 'data' => $artikel]);
    }

    public function destroy($id)
    {
        $artikel = Artikel::find($id);
        if (!$artikel) {
            return response()->json(['success' => false, 'message' => 'Artikel tidak ditemukan'], 404);
        }
        if ($artikel->gambar && Storage::disk('public')->exists($artikel->gambar)) {
            Storage::disk('public')->delete($artikel->gambar);
        }
        if ($artikel->foto_penganalisa && Storage::disk('public')->exists($artikel->foto_penganalisa)) {
            Storage::disk('public')->delete($artikel->foto_penganalisa);
        }
        $artikel->delete();
        return response()->json(['success' => true, 'message' => 'Artikel berhasil dihapus']);
    }
}
