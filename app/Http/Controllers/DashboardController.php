<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $berita = Berita::with(['user', 'ekstrakurikuler'])
            ->latest()
            ->take(5)
            ->get();

        $ekskul = Ekstrakurikuler::count();

        if (auth()->user()->role === 'admin') {
            // Statistik User
            $totalUsers = User::count();
            $verifiedUsers = User::where('verif', 'verified')->count();
            $unverifiedUsers = User::where('verif', 'unverified')->count();
            
            // Statistik Role
            $adminUsers = User::where('role', 'admin')->count();
            $guruUsers = User::where('role', 'guru')->count();
            $siswaUsers = User::where('role', 'siswa')->count();
            
            // Statistik Ekstrakurikuler
            $totalEkstrakurikuler = $ekskul;

            return view('dashboard', compact(
                'berita',
                'ekskul',
                'totalUsers',
                'verifiedUsers',
                'unverifiedUsers',
                'adminUsers',
                'guruUsers',
                'siswaUsers',
                'totalEkstrakurikuler'
            ));
        }

        return view('dashboard', compact('berita', 'ekskul'));
    }
}
