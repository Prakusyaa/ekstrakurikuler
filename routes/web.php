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

/* Route::middleware(['siswa'])->group(function () {
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
}); || contoh rute khusus role tertentu || */

Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])
    ->middleware(['auth'])->name('ekstrakurikuler');

// route ke detail ekstrakurikuler tertentu
Route::get('/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'show'])
    ->name('ekstrakurikuler.detail')
    ->middleware(['auth']);

// untuk gabung/keluar ekskul
Route::post('/ekstrakurikuler/{id}/join', [AnggotaController::class, 'gabung'])
    ->name('gabung.ekstrakurikuler')->middleware('auth');

Route::post('/ekstrakurikuler/{id}/leave', [AnggotaController::class, 'keluar'])
    ->name('keluar.ekstrakurikuler')->middleware('auth');

//
Route::get('/ekskul/{name}', function ($name) { 
    return view('ekstrakurikuler/ekskul_saya', ['name' => $name]);})
    ->middleware(['auth'])->name('ekskul'); // cara manggil = {{ route('ekskul', ['name' => Auth::user()->name]) }}

require __DIR__.'/auth.php';
