<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function gabung($id)
    {
        $user = auth()->user();

        // ngecek status user gabung/belum
        if (!$user->anggota()->where('ekskul_id', $id)->exists()) {
            Anggota::create([
                'user_id' => $user->id,
                'nama' => $user->name,
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

    public function ekskulSaya()
    {
        $user = auth()->user();
        
        // Ambil daftar ekstrakurikuler yang diikuti user
        $ekstrakurikuler = $user->anggota()->with('ekstrakurikuler')->get();

        return view('ekstrakurikuler.ekskul_saya', compact('ekstrakurikuler'));
    }
}
