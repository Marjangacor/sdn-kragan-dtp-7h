<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        if (! $request->user()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman admin.');
        }

        // Check if user has admin role
        if ($request->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses admin. Hubungi administrator sekolah untuk mendapatkan akses.');
        }

        return $next($request);
    }
}
