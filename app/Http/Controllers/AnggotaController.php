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
