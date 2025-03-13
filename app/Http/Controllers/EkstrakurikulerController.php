<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
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

        $anggota = auth()->check() 
        ? auth()->user()->anggota()->pluck('ekskul_id')->toArray()
        : [];

        return view('ekstrakurikuler.daftar_ekstrakurikuler', compact('ekstrakurikuler', 'anggota'));
    }

    public function show($id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);

        $sgabung = auth()->check() && $ekskul->anggota()->where('user_id', auth()->id())->exists();

        return view('ekstrakurikuler.detail', compact('ekskul', 'sgabung'));
    }

    public function gabung($id)
    {
        $user = auth()->user();

        // ngecek status user gabung/belum
        if (!$user->anggota()->where('ekskul_id', $id)->exists()) {
            Anggota::create([
                'user_id' => $user->id,
                'ekskul_id' => $id
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil bergabung');
    }

    public function keluar($id)
    {
        $user = auth()->user();

        $user->anggota()->where('ekskul_id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil keluar');
    }
}