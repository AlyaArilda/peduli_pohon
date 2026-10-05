<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Resources\LaporanApiResource;

class DataLaporanController extends Controller
{
    // GET /api/laporans
    public function index()
    {
        $laporans = Laporan::where('user_id', Auth::id())->get();
        // Untuk banyak data:
        return LaporanApiResource::collection($laporans);
    }

    // POST /api/laporans
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'lokasi_pohon' => 'required|string',
            'waktu_ditemukan' => 'required|string',
            'deskripsi_kerusakan' => 'required|string',
            'foto_kerusakan' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'nama_pelapor' => 'required|string',
            'telp' => 'required|string',
            'email' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Menyimpan foto jika ada
        if ($request->hasFile('foto_kerusakan')) {
            $file = $request->file('foto_kerusakan');
            $fotoPath = $file->store('laporan_foto', 'public');  // Menyimpan foto di storage/public
        }

        // Format waktu yang diterima bisa bermacam-macam, kita coba beberapa format
        // Bersihkan input dari karakter aneh (termasuk non-breaking space)
        $inputWaktu = preg_replace('/[^\d\/\-\:\s]/u', '', trim($request->waktu_ditemukan));
        $inputWaktu = str_replace("\xC2\xA0", ' ', $inputWaktu); // hapus non-breaking space jika ada

        $formats = ['d-m-Y H:i', 'd/m/Y H:i', 'Y-m-d H:i', 'Y-m-d\TH:i'];
        $waktu = null;
        foreach ($formats as $format) {
            try {
                $waktu = \Carbon\Carbon::createFromFormat($format, $inputWaktu);
                break;
            } catch (\Exception $e) {
                // lanjut ke format berikutnya
            }
        }
        if (!$waktu) {
            return response()->json(['message' => 'Format waktu tidak valid', 'input' => $inputWaktu], 422);
        }
        $waktu = $waktu->format('Y-m-d H:i');

        $wilayahJabodetabek = [
            // Kota/Kabupaten utama
            'jakarta', 'bogor', 'depok', 'tangerang', 'bekasi',
            // Jakarta
            'jakarta pusat', 'jakarta utara', 'jakarta barat', 'jakarta timur', 'jakarta selatan',
            'menteng', 'kemayoran', 'gambir', 'tanah abang', 'palmerah', 'kebayoran baru', 'kebayoran lama', 'cilandak', 'pasar minggu', 'tebet', 'matraman', 'kramat jati', 'ciputat', 'pondok gede',
            // Bogor
            'cibinong', 'ciomas', 'cileungsi', 'gunung putri', 'parung', 'dramaga', 'leuwiliang', 'ciseeng', 'sukajaya', 'cijeruk', 'babakan madang', 'bojong gede', 'caringin', 'caringin', 'cibungbulang', 'cigombong', 'ciseeng', 'gunung sindur', 'jonggol', 'kemang', 'leuwisadeng', 'megamendung', 'pamijahan', 'parung panjang', 'ranca bungur', 'rumpin', 'sukamakmur', 'sukaraja', 'tamansari', 'tenjo', 'tenjolaya',
            // Depok
            'beji', 'cilodong', 'cimanggis', 'cinere', 'limo', 'pancoran mas', 'sawangan', 'sukmajaya', 'tapos', 'bojongsari', 'depok jaya', 'kukusan', 'tanah baru', 'rangkapan jaya', 'rangkapan jaya baru',
            // Tangerang
            'cipondoh', 'ciledug', 'karawaci', 'bintaro', 'bsd', 'serpong', 'cisauk', 'curug', 'kelapa dua', 'pamulang', 'ciputat', 'pondok aren', 'cikupa', 'cisoka', 'kosambi', 'legok', 'panongan', 'pasar kemis', 'sepatan', 'teluk naga', 'tiger', 'tangerang selatan', 'tangerang kota', 'tangerang kabupaten',
            // Bekasi
            'rawalumbu', 'bekasi timur', 'bekasi barat', 'bekasi utara', 'bekasi selatan', 'medan satria', 'pondok gede', 'mustika jaya', 'bantar gebang', 'jatisampurna', 'cikarang', 'tambun', 'setu', 'babelan', 'tarumajaya', 'tambelang', 'tambun selatan', 'tambun utara', 'tarumajaya', 'muara gembong', 'sukatani', 'sukakarya', 'sukatani', 'sukawangi', 'tegal dani', 'tegal gede',
            // Area/dusun/desa
            'bintaro', 'bsd', 'ciputat', 'pondok cabe', 'pondok aren', 'serpong', 'alam sutera', 'gading serpong', 'summarecon', 'grand wisata', 'harapan indah', 'jatiwarna', 'jatiwaringin', 'mustikasari', 'mustikajaya', 'pejuang', 'perwira', 'telaga murni', 'telaga asih', 'wibawa mukti', 'jababeka', 'mekarsari', 'cibitung', 'cibubur', 'cileungsi', 'gunung putri', 'bojong gede', 'cilebut', 'cibinong', 'parung', 'leuwiliang', 'dramaga', 'ciomas', 'sukajaya', 'cijeruk', 'babakan madang', 'sentul', 'sentul city', 'cisauk', 'parung panjang', 'legok', 'curug', 'kelapa dua', 'panongan', 'sepatan', 'teluk naga', 'kosambi', 'cikupa', 'cisoka', 'tiger', 'tangerang selatan', 'tangerang kota', 'tangerang kabupaten',
        ];

        $lokasi = strtolower($request->lokasi_pohon);
        $status = 'ditolak';
        foreach ($wilayahJabodetabek as $wilayah) {
            if (strpos($lokasi, $wilayah) !== false) {
                $status = 'terkirim';
                break;
            }
        }
        $laporan = Laporan::create([
            'user_id' => Auth::id(),
            'lokasi_pohon' => $request->lokasi_pohon,
            'waktu_ditemukan' => $waktu,
            'deskripsi_kerusakan' => $request->deskripsi_kerusakan,
            'foto_kerusakan' => isset($fotoPath) ? $fotoPath : null,
            'nama_pelapor' => $request->nama_pelapor,
            'telp' => $request->telp,
            'email' => $request->email,
            'status' => $status,
        ]);

        return response()->json([
            'message' => $status === 'ditolak'
                ? 'Laporan berhasil dikirim, namun lokasi di luar Jabodetabek sehingga status otomatis ditolak.'
                : 'Laporan berhasil ditambahkan',
            'data' => new LaporanApiResource($laporan)
        ], 201);
    }
    public function show($id)
    {
        $laporan = Laporan::find($id);
        if (!$laporan) {
            return response()->json(['message' => 'Laporan tidak ditemukan'], 404);
        }
        return new LaporanApiResource($laporan);
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::find($id);
        if (!$laporan) {
            return response()->json(['message' => 'Laporan tidak ditemukan'], 404);
        }

        if ($request->has('status')) {
            $allowedStatus = ['terkirim', 'diproses', 'selesai', 'ditolak'];
            if (!in_array($request->status, $allowedStatus)) {
                return response()->json(['message' => 'Status tidak valid'], 422);
            }
        }

        $laporan->update([
            'status' => 'selesai'
        ]);

        return response()->json([
            'message' => 'Laporan berhasil diperbarui',
            'data' => $laporan
        ]);
    }
    public function destroy($id)
    {
        $laporan = Laporan::find($id);
        if (!$laporan) {
            return response()->json(['message' => 'Laporan tidak ditemukan'], 404);
        }

        $laporan->delete();

        return response()->json(['message' => 'Laporan berhasil dihapus']);
    }
}
