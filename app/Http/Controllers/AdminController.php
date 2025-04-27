<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    // Dashboard untuk kelola user
    public function index()
    {
        $totalUsers = User::count();
        $verifiedUsers = User::where('verif', 'verified')->count();
        $unverifiedUsers = User::where('verif', 'unverified')->count();
        $adminUsers = User::where('role', 'admin')->count();
        $guruUsers = User::where('role', 'guru')->count();
        $siswaUsers = User::where('role', 'siswa')->count();
        return view('admin.dashboard', compact('totalUsers', 'verifiedUsers', 'unverifiedUsers', 'adminUsers', 'guruUsers', 'siswaUsers'));
    }

    // Verifikasi user
    public function verifyUser(User $user)
    {
        // Cek apakah user adalah admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Tidak dapat memverifikasi user admin.');
        }

        $user->update(['verif' => 'verified']);
        return redirect()->route('admin.dashboard')->with('success', 'User berhasil diverifikasi.');
    }

    // Batalkan verifikasi user
    public function unverifyUser(User $user)
    {
        // Cek apakah user adalah admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Tidak dapat membatalkan verifikasi user admin.');
        }

        $user->update(['verif' => 'unverified']);
        return redirect()->route('admin.dashboard')->with('success', 'Verifikasi user berhasil dibatalkan.');
    }

    // Update role user
    public function updateRole(Request $request, User $user)
    {
        // Cek apakah user adalah admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Tidak dapat mengubah role user admin.');
        }

        $request->validate([
            'role' => ['required', 'in:guru,siswa']
        ]);

        $user->update(['role' => $request->role]);
        return redirect()->route('admin.dashboard')->with('success', 'Role user berhasil diubah.');
    }

    // Halaman CRUD untuk berita dan ekstrakurikuler
    public function manageContent()
    {
        $news = Berita::with('ekstrakurikuler')->latest()->get();
        $extracurriculars = Ekstrakurikuler::all();
        return view('admin.content', compact('news', 'extracurriculars'));
    }

    // CRUD Berita
    public function storeNews(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'ekstrakurikuler_id' => ['required', 'exists:ekstrakurikuler,id'],
        ]);

        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'ekstrakurikuler_id' => $request->ekstrakurikuler_id,
        ]);

        return redirect()->route('admin.content')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function updateNews(Request $request, Berita $news)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'ekstrakurikuler_id' => ['required', 'exists:ekstrakurikuler,id'],
        ]);

        $news->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'ekstrakurikuler_id' => $request->ekstrakurikuler_id,
        ]);

        return redirect()->route('admin.content')->with('success', 'Berita berhasil diperbarui.');
    }

    public function deleteNews(Berita $news)
    {
        $news->delete();
        return redirect()->route('admin.content')->with('success', 'Berita berhasil dihapus.');
    }

    // CRUD Ekstrakurikuler
    public function storeExtracurricular(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'pembina' => ['required', 'string', 'max:255'],
        ]);

        Ekstrakurikuler::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'pembina' => $request->pembina,
        ]);

        return redirect()->route('admin.content')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function updateExtracurricular(Request $request, Ekstrakurikuler $extracurricular)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'pembina' => ['required', 'string', 'max:255'],
        ]);

        $extracurricular->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'pembina' => $request->pembina,
        ]);

        return redirect()->route('admin.content')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function deleteExtracurricular(Ekstrakurikuler $extracurricular)
    {
        $extracurricular->delete();
        return redirect()->route('admin.content')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}
