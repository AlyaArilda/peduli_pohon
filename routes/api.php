<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DataArtikelController;
use App\Http\Controllers\Api\DataFavoriteController;
use App\Http\Controllers\Api\DataKategoriController;
use App\Http\Controllers\Api\DataLaporanController;
use App\Http\Controllers\Api\DataPohonController;
use App\Http\Controllers\Api\ForgotPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return response()->json(['user' => $request->user()]);
})->middleware('auth:sanctum');

//login
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::post('/register', [AuthController::class, 'register']);

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [ForgotPasswordController::class, 'reset']);
//logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
// data pohon
Route::apiResource('/api-pohons', DataPohonController::class)->middleware('auth:sanctum');
// data artikel
Route::apiResource('/api-artikels', DataArtikelController::class)->middleware('auth:sanctum');
//data laporan
Route::apiResource('/laporans', DataLaporanController::class)->middleware('auth:sanctum');
// data favorite
Route::apiResource('/api-favorites', DataFavoriteController::class)->middleware('auth:sanctum');
// data kategori
Route::get('/kategoris', [DataKategoriController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/profile/update', [AuthController::class, 'updateProfile']);
    Route::delete('/profile/photo', [AuthController::class, 'deletePhoto']);
});
