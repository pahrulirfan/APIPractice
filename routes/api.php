<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

// ─── Route Publik: Autentikasi ────────────────────────────────────────────────
Route::post('/login', [AuthController::class, 'login']);

// ─── Route Publik: Post (CRUD) ────────────────────────────────────────────────
Route::apiResource('/posts', PostController::class)->only([
    'index', 'show', 'store', 'update', 'destroy',
]);

// ─── Route Publik: Comment (CRUD) ─────────────────────────────────────────────
Route::apiResource('/comments', CommentController::class)->only([
    'index', 'show', 'store', 'update', 'destroy',
]);

// ─── Route Publik: Vehicle (CRUD) ─────────────────────────────────────────────
Route::apiResource('/vehicles', VehicleController::class)->only([
    'index', 'show', 'store', 'update', 'destroy',
]);

// ─── Route Publik: Medicine (CRUD) ────────────────────────────────────────────
Route::apiResource('/medicines', MedicineController::class)->only([
    'index', 'show', 'store', 'update', 'destroy',
]);

// ─── Route Nested: Comments milik Post tertentu ───────────────────────────────
Route::get('/posts/{id}/comments', [CommentController::class, 'byPost']);

// ─── Route Terproteksi (auth:sanctum) ─────────────────────────────────────────
Route::middleware('auth:sanctum')->group(function () {
    // Autentikasi
    Route::post('/logout', [AuthController::class, 'logout']);

    // CRUD User
    Route::apiResource('/users', UserController::class)->only([
        'index', 'show', 'store', 'update', 'destroy',
    ]);

    // CRUD Pasien
    Route::apiResource('/pasien', PasienController::class)->only([
        'index', 'show', 'store', 'update', 'destroy',
    ]);

    // CRUD Penyakit
    Route::apiResource('/penyakit', PenyakitController::class)->only([
        'index', 'show', 'store', 'update', 'destroy',
    ]);

    // Diagnosa (relasi Pasien–Penyakit)
    Route::post('/pasien/{pasien}/diagnosa', [DiagnosaController::class, 'store']);
    Route::delete('/pasien/{pasien}/diagnosa/{penyakit}', [DiagnosaController::class, 'destroy']);
});
