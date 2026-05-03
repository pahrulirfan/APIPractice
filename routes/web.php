<?php

use App\Http\Controllers\DataViewController;
use App\Http\Controllers\DocsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Documentation Routes
Route::get('/docs', [DocsController::class, 'index']);
Route::get('/docs/auth', [DocsController::class, 'auth']);
Route::get('/docs/posts', [DocsController::class, 'posts']);
Route::get('/docs/comments', [DocsController::class, 'comments']);
Route::get('/docs/users', [DocsController::class, 'users']);
Route::get('/docs/pasien', [DocsController::class, 'pasien']);
Route::get('/docs/penyakit', [DocsController::class, 'penyakit']);
Route::get('/docs/diagnosa', [DocsController::class, 'diagnosa']);
Route::get('/docs/vehicles', [DocsController::class, 'vehicles']);
Route::get('/docs/medicines', [DocsController::class, 'medicines']);

// Data Viewer Routes
Route::get('/data', [DataViewController::class, 'index']);
Route::get('/data/posts', [DataViewController::class, 'posts']);
Route::get('/data/comments', [DataViewController::class, 'comments']);
Route::get('/data/users', [DataViewController::class, 'users']);
Route::get('/data/pasien', [DataViewController::class, 'pasien']);
Route::get('/data/penyakit', [DataViewController::class, 'penyakit']);
Route::get('/data/diagnosa', [DataViewController::class, 'diagnosa']);
Route::get('/data/vehicles', [DataViewController::class, 'vehicles']);
Route::get('/data/medicines', [DataViewController::class, 'medicines']);
