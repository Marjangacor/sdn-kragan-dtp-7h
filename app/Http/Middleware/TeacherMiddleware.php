<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman guru.');
        }

        if ($user->role !== 'guru') {
            abort(403, 'Akses guru diperlukan. Anda tidak memiliki otorisasi untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
