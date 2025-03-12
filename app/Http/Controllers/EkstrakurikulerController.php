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

        return view('ekstrakurikuler.daftar_ekstrakurikuler', compact('ekstrakurikuler'));
    }
}