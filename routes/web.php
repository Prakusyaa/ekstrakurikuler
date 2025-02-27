<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;

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

// kodingan mulai dari sini

/* Route::middleware(['auth', 'siswa'])->group(function () {
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
}); || contoh rute khusus role tertentu || */

Route::get('/ekstrakulikuler', function () {
    return view('ekstrakulikuler/daftar_ekstrakulikuler');
})->middleware(['auth'])->name('ekstrakulikuler');

Route::get('/ekskul/{name}', function ($name) {
    return view('ekstrakulikuler/ekskul_saya', ['name' => $name]);
})->middleware(['auth'])->name('ekskul'); // cara manggil = {{ route('ekskul', ['name' => Auth::user()->name]) }}


require __DIR__.'/auth.php';
