<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;

class EkstrakurikulerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $ekstrakurikuler = Ekstrakurikuler::when($search, function ($i) use ($search) {
            $i->where('nama', 'like', "%{$search}%");
        })->get();

        if (auth()->check()) {
            $anggota = auth()->user()->anggota()->pluck('ekskul_id')->toArray();
        } else {
            $anggota = [];
        }        

        return view('ekstrakurikuler.daftar_ekstrakurikuler', compact('ekstrakurikuler', 'anggota'));
    }

    public function show($id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);
        $user = auth()->user();

        return view('ekstrakurikuler.detail', [
            'ekskul' => $ekskul,
            'sgabung' => $user && $ekskul->anggota()->where('user_id', $user->id)->exists(),
            'member' => $ekskul->anggota,
            'nama' => optional($user->anggota()->where('user_id', $user->id)->first())->user->name ?? 'Tidak ditemukan'
        ]);
    }
}