<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Cari semua ekskul yang diikuti user
        $ekskul_ids = Anggota::where('user_id', Auth::id())->pluck('ekskul_id');

        // Cari berita dari ekskul-ekskul tersebut
        $berita = Berita::with('user')
            ->whereIn('ekskul_id', $ekskul_ids)
            ->latest()
            ->take(5)
            ->get();

        // Hitung jumlah ekstrakurikuler yang diikuti
        $ekskul = Anggota::where('user_id', Auth::id())->count();

        return view('dashboard', compact('ekskul', 'berita'));
    }
}
