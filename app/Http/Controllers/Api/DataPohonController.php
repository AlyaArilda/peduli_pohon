<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pohon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class DataPohonController extends Controller
{
    // Untuk LIST pohon (homepage)
    public function index(): JsonResponse
    {
        $data = Pohon::with(['kategori', 'user'])->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'nama_pohon' => $item->nama_pohon,
                'gambar_pohon' => $item->gambar_pohon ? asset('storage/' . $item->gambar_pohon) : null,
                'nama_pj' => $item->nama_pj,
                'foto_pj' => $item->foto_pj ? asset('storage/' . $item->foto_pj) : null,
                'kategori_id' => $item->kategori_id,
            ];
        });
        return response()->json($data);
    }

    // Store pohon baru
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama_pohon'    => 'required|string|max:255',
            'kategori_id'   => 'required|exists:kategoris,id',
            'gambar_pohon'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi'     => 'nullable|string',
            'manfaat'       => 'required|string',
            'nama_pj'       => 'required|string|max:255',
            'foto_pj'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'telp_pj'       => 'nullable|string|max:20', // tambahkan ini
            'alamat'        => 'required|string',
            'tinggi'        => 'nullable|string|max:255',
            'tajuk'         => 'nullable|string|max:255',
            'cocok_untuk'   => 'nullable|array',
        ]);

        // Bersihkan manfaat dari tag HTML dan spasi
        $manfaat = strip_tags($request->manfaat);

        // Hapus :&nbsp; dan :  (non-breaking space unicode)
        $manfaat = str_replace([':&nbsp;', ":\u{00A0}"], ':', $manfaat);

        // Atau hapus juga : diikuti spasi biasa
        $manfaat = preg_replace('/:\s+/', ':', $manfaat);

        $validated['manfaat'] = trim($manfaat);

        // Simpan gambar jika ada
        if ($request->hasFile('gambar_pohon')) {
            $validated['gambar_pohon'] = $request->file('gambar_pohon')->store('gambar_pohon', 'public');
        }

        if ($request->hasFile('foto_pj')) {
            $validated['foto_pj'] = $request->file('foto_pj')->store('foto_pj', 'public');
        }
        $validated['user_id'] = $request->user()->id; // gunakan ini jika pakai Sanctum atau Passport
        $pohon = Pohon::create($validated);
        return response()->json($pohon, 200);
    }

    // Untuk DETAIL pohon (plant detail)
    public function show($id): JsonResponse
    {
        $pohon = Pohon::with(['kategori', 'user'])->find($id);
        if (!$pohon) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json([
            'id' => $pohon->id,
            'nama_pohon' => $pohon->nama_pohon,
            'gambar_pohon' => $pohon->gambar_pohon ? asset('storage/' . $pohon->gambar_pohon) : null,
            'deskripsi' => $pohon->deskripsi,
            'manfaat' => $pohon->manfaat,
            'nama_pj' => $pohon->nama_pj,
            'foto_pj' => $pohon->foto_pj ? asset('storage/' . $pohon->foto_pj) : null, // tambahkan ini
            'tinggi' => $pohon->tinggi ?? '',
            'tajuk' => $pohon->tajuk ?? '',
            'cocok_untuk' => $pohon->cocok_untuk ?? [],
            'alamat' => $pohon->alamat,
            'telp_pj' => $pohon->telp_pj ?? '',
            'user' => [
                'nama' => $pohon->user->name ?? '',
                'foto' => optional($pohon->user)->foto ? asset('storage/' . $pohon->user->foto) : null,
                'alamat' => $pohon->alamat,
                'telp' => $pohon->telp_pj,
            ],
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $pohon = Pohon::find($id);
        if (!$pohon) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama_pohon'    => 'required|string|max:255',
            'kategori_id'   => 'required|exists:kategoris,id',
            'gambar_pohon'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi'     => 'nullable|string',
            'manfaat'       => 'required|string',
            'nama_pj'       => 'required|string|max:255',
            'foto_pj'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'telp_pj'       => 'nullable|string|max:20',
            'alamat'        => 'required|string',
            'tinggi'        => 'nullable|string|max:255',
            'tajuk'         => 'nullable|string|max:255',
            'cocok_untuk'   => 'nullable|array',
        ]);

        $validated['manfaat'] = trim(strip_tags($request->manfaat));

        if ($request->hasFile('gambar_pohon')) {
            if ($pohon->gambar_pohon && Storage::disk('public')->exists($pohon->gambar_pohon)) {
                Storage::disk('public')->delete($pohon->gambar_pohon);
            }
            $validated['gambar_pohon'] = $request->file('gambar_pohon')->store('gambar_pohon', 'public');
        }

        if ($request->hasFile('foto_pj')) {
            if ($pohon->foto_pj && Storage::disk('public')->exists($pohon->foto_pj)) {
                Storage::disk('public')->delete($pohon->foto_pj);
            }
            $validated['foto_pj'] = $request->file('foto_pj')->store('foto_pj', 'public');
        }

        $pohon->update($validated);
        return response()->json($pohon);
    }

    // Delete pohon
    public function destroy($id): JsonResponse
    {
        $pohon = Pohon::find($id);
        if (!$pohon) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Hapus file terkait
        if ($pohon->gambar_pohon && Storage::disk('public')->exists($pohon->gambar_pohon)) {
            Storage::disk('public')->delete($pohon->gambar_pohon);
        }
        if ($pohon->foto_pj && Storage::disk('public')->exists($pohon->foto_pj)) {
            Storage::disk('public')->delete($pohon->foto_pj);
        }

        $pohon->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
