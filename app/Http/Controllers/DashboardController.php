<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\News;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $latestNews = Berita::with(['user', 'ekstrakurikuler'])
            ->latest()
            ->take(5)
            ->get();

        $totalEkstrakurikuler = Ekstrakurikuler::count();

        if ($user->role === 'admin') {
            $totalUsers = User::count();
            $verifiedUsers = User::where('is_verified', true)->count();
            $unverifiedUsers = User::where('is_verified', false)->count();
            $adminUsers = User::where('role', 'admin')->count();
            $guruUsers = User::where('role', 'guru')->count();
            $siswaUsers = User::where('role', 'siswa')->count();

            return view('dashboard', compact(
                'totalUsers',
                'verifiedUsers',
                'unverifiedUsers',
                'adminUsers',
                'guruUsers',
                'siswaUsers',
                'totalEkstrakurikuler',
                'latestNews'
            ));
        } elseif ($user->role === 'guru') {
            $totalNews = Berita::where('user_id', $user->id)->count();
            $userNews = Berita::where('user_id', $user->id)->count();

            return view('dashboard', compact(
                'totalEkstrakurikuler',
                'totalNews',
                'userNews',
                'latestNews'
            ));
        } else {
            // Untuk siswa, ambil ekstrakurikuler yang diikuti
            $userEkstrakurikuler = $user->ekstrakurikuler()->count();
            
            // Ambil berita dari ekstrakurikuler yang diikuti
            $userNews = Berita::whereHas('ekstrakurikuler', function($query) use ($user) {
                $query->whereHas('users', function($q) use ($user) {
                    $q->where('users.id', $user->id);
                });
            })->with(['user', 'ekstrakurikuler'])
              ->latest()
              ->take(5)
              ->get();

            return view('dashboard', compact(
                'userEkstrakurikuler',
                'userNews'
            ));
        }
    }
}
