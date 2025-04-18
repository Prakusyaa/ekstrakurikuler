<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EkstrakurikulerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Halaman daftar semua ekstrakurikuler
Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])
    ->middleware(['auth'])->name('ekstrakurikuler');

// Halaman tambah ekstrakurikuler
Route::get('/ekstrakurikuler/tambah', [EkstrakurikulerController::class, 'create'])
    ->middleware(['guru'])->name('tambah');


// Halaman detail ekstrakurikuler berdasarkan ID
Route::get('/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'show'])
    ->middleware(['auth'])->name('ekstrakurikuler.detail');

// Aksi Gabung / Keluar / Kick Ekstrakurikuler
Route::post('/ekstrakurikuler/{id}/join', [AnggotaController::class, 'gabung'])
    ->middleware(['siswa'])->name('gabung.ekstrakurikuler');

Route::post('/ekstrakurikuler/{id}/leave', [AnggotaController::class, 'keluar'])
    ->middleware(['siswa'])->name('keluar.ekstrakurikuler');

Route::post('/ekstrakurikuler/{id}/kick/{uid}', [AnggotaController::class, 'keluarkan'])
    ->middleware(['guru'])->name('keluarkan.ekstrakurikuler');

// Ekstrakurikuler yang Diikuti Siswa
Route::get('/ekskul-saya', [AnggotaController::class, 'ekskulSaya'])
    ->middleware(['siswa'])->name('ekskul.saya');

// Aksi Tambah Ekstrakurikuler
Route::post('/ekstrakurikuler', [EkstrakurikulerController::class, 'store'])
    ->middleware(['guru'])->name('ekstrakurikuler.store');

// Aksi Hapus Ekstrakurikuler
Route::delete('/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'destroy'])
    ->middleware(['guru'])->name('ekstrakurikuler.destroy');

// Halaman edit ekstrakurikuler
Route::get('/ekstrakurikuler/{id}/edit', [EkstrakurikulerController::class, 'edit'])
    ->middleware(['guru'])->name('ekstrakurikuler.edit');

// Aksi Update Ekstrakurikuler
Route::put('/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'update'])
    ->middleware(['guru'])->name('ekstrakurikuler.update');

// Autentikasi
require __DIR__.'/auth.php';