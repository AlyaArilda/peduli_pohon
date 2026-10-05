<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    //login
    public function login(Request $request){
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response([
                'message' => ['Email not found'],
            ], 404);
        }
        if (!Hash::check($request->password, $user->password)) {
            return response([
               'message' => ['Password is wrong'],
            ], 404);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token
        ], 200);
    }
    public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Logout berhasil']);
}

    // Register

    public function register(Request $request){
        try {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|unique:users,email|max:255',
             'password' => 'required|string|min:4|confirmed',
         ]);

         $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password)
         ]);

         $token = $user->createToken('auth_token')->plainTextToken;

         return response([
             'status' => 'success',
             'message' => 'Registration seccessfully',
             'user' => $user,
             'token' => $token
         ], 201);
     } catch (\Exception $e) {
         return response([
             'status' => 'error',
             'message' => $e->getMessage()
         ], 500);
     }
   }

   public function updateProfile(Request $request)
   {
       try {
           $user = $request->user();

           $request->validate([
               'name' => 'sometimes|required|string|max:255|unique:users,name,' . $user->id,
               'email' => 'sometimes|required|email|max:255|unique:users,email,' . $user->id,
               'password' => 'nullable|string|min:4|confirmed',
               'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
           ]);

           if ($request->has('name')) {
               $user->name = $request->name;
           }

           if ($request->has('email')) {
               $user->email = $request->email;
           }

           if ($request->filled('password')) {
               $user->password = Hash::make($request->password);
           }

           if ($request->hasFile('gambar')) {
               if ($user->gambar) {
                   $oldPath = str_replace(asset('storage') . '/', '', $user->gambar);
                   if (Storage::disk('public')->exists($oldPath)) {
                       Storage::disk('public')->delete($oldPath);
                   }
               }
               $path = $request->file('gambar')->store('user-gambar', 'public');
               $user->gambar = 'storage/' . $path;
           }

           $user->save();

           return response()->json([
               'success' => true,
               'message' => 'Profile berhasil diperbarui.',
               'user' => [
                   'id' => $user->id,
                   'name' => $user->name,
                   'email' => $user->email,
                   'gambar' => $user->gambar ? asset($user->gambar) : null,
                   'role' => $user->role,
                   'email_verified_at' => $user->email_verified_at,
                   'created_at' => $user->created_at,
                   'updated_at' => $user->updated_at,
               ],
           ]);
       } catch (\Exception $e) {
           return response()->json([
               'success' => false,
               'message' => 'Error updating profile',
               'error' => $e->getMessage(),
           ], 500);
       }
   }

   public function deletePhoto(Request $request)
{
    $user = $request->user();

    if ($user->gambar) {
        $oldPath = str_replace('storage/', '', $user->gambar);
        if (Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }
        $user->gambar = null;
        $user->save();
        return response()->json(['success' => true, 'message' => 'Foto profil berhasil dihapus.']);
    }

    return response()->json(['success' => false, 'message' => 'Tidak ada foto profil untuk dihapus.'], 404);
}
}
