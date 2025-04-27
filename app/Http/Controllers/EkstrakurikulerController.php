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

        return view('ekstrakurikuler.daftar_ekstrakurikuler', [
            'ekstrakurikuler' => $ekstrakurikuler,
            'anggota' => $anggota
        ]);
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

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'pembimbing' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $ekstrakurikuler = new Ekstrakurikuler();
        $ekstrakurikuler->nama = $request->nama;
        $ekstrakurikuler->guru_pembimbing = $request->pembimbing;
        $ekstrakurikuler->deskripsi = $request->deskripsi;
        $user = Auth::user();
        $ekstrakurikuler->created_by = $user->id;
        $ekstrakurikuler->save();

        return redirect()->route('ekstrakurikuler')->with('success', 'Ekstrakurikuler berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);
        
        // Hapus semua berita terkait
        $ekskul->berita()->delete();
        
        // Hapus semua anggota terkait
        $ekskul->anggota()->delete();
        
        // Hapus ekstrakurikuler
        $ekskul->delete();

        return redirect()->route('ekstrakurikuler')->with('success', 'Ekstrakurikuler dan semua data terkait berhasil dihapus');
    }

    public function edit($id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);
        return view('ekstrakurikuler.edit', compact('ekskul'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'pembimbing' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $ekskul = Ekstrakurikuler::findOrFail($id);
        $ekskul->nama = $request->nama;
        $ekskul->guru_pembimbing = $request->pembimbing;
        $ekskul->deskripsi = $request->deskripsi;
        $ekskul->save();

        return redirect()->route('ekstrakurikuler.detail', $ekskul->id)
            ->with('success', 'Ekstrakurikuler berhasil diubah');
    }
}