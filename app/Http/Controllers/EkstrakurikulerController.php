<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use Illuminate\Support\Facades\Auth;

class EkstrakurikulerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $ekstrakurikuler = $this->search($search);

        if (Auth::check()) {
            $anggota = Auth::user()->anggota()->pluck('ekskul_id')->toArray();
        } else {
            $anggota = [];
        }

        return view('ekstrakurikuler.daftar_ekstrakurikuler', compact('ekstrakurikuler', 'anggota'));
    }

    private function search($search)
    {
        return Ekstrakurikuler::when($search, function ($query) use ($search) {
            $query->where('nama', 'like', "%{$search}%");
        })->get();
    }

    public function show($id)
    {
        $ekskul = Ekstrakurikuler::with('berita.user')->findOrFail($id);
        $user = Auth::user();

        return view('ekstrakurikuler.detail', [
            'ekskul' => $ekskul,
            'sgabung' => $user && $ekskul->anggota()->where('user_id', $user->id)->exists(),
            'member' => $ekskul->anggota()->select('user_id', 'nama', 'created_at')->get()
        ]);
    }

    public function create()
    {
        return view('ekstrakurikuler.tambah');
    }
}