<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Pastikan pengguna sudah login dan memeriksa role mereka
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            // Jika tidak sesuai, redirect atau abort
            return redirect('/dashboard');
        }

        return $next($request);
    }
}