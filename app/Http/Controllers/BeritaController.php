<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function create($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        return view('ekstrakurikuler.tambah_berita', compact('ekstrakurikuler'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
        ]);

        Berita::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'ekskul_id' => $id,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('ekstrakurikuler.detail', $id)
            ->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit(Berita $berita)
    {
        return view('berita.edit_berita', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
        ]);

        $berita->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
        ]);

        return redirect()->route('ekstrakurikuler.detail', $berita->ekstrakurikuler->id)
            ->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();
        return redirect()->back()->with('success', 'Berita berhasil dihapus');
    }
} 