<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataFavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with(['user', 'pohon'])->get();
        return response()->json($favorites);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'pohon_id' => 'required|exists:pohons,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }
        $favorite = Favorite::firstOrCreate([
            'user_id' => $request->user_id,
            'pohon_id' => $request->pohon_id,
        ]);

        return response()->json([
            'message' => 'Favorite berhasil ditambahkan',
            'data' => $favorite
        ], 201);
    }

    public function show($id)
    {
        $favorite = Favorite::with(['user', 'pohon'])->find($id);

        if (!$favorite) {
            return response()->json(['message' => 'Favorite tidak ditemukan'], 404);
        }

        return response()->json($favorite);
    }

    public function destroy($id)
    {
        $favorite = Favorite::find($id);

        if (!$favorite) {
            return response()->json(['message' => 'Favorite tidak ditemukan'], 404);
        }

        $favorite->delete();

        return response()->json(['message' => 'Favorite berhasil dihapus']);
    }
}

