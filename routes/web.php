<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login.index');
    })->name('login');

    Route::post('/login', function (Request $request) {
        $credentials = $request->validate([
            'role' => ['required', 'in:admin,user'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $redirectTo = $credentials['role'] === 'admin'
            ? route('dashboard')
            : route('home');

        unset($credentials['role']);

        if (Auth::attempt($credentials + ['role' => $request->string('role')->toString()], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended($redirectTo);
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    })->name('login.store');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');

Route::get('/dashboard', function () {
    return view('home.index');
})->middleware('auth')->name('dashboard');

Route::get('/guru', function () {
    return view('guru.index');
});

Route::get('/ekstra', function () {
    return view('ekstra.index');
});

Route::get('/spmb', function () {
    return view('spmb.index');
});

Route::get('/kritik-saran', function () {
    return view('kritik saran.index');
});

Route::get('/prestasi', function () {
    return view('prestasi.index');
});

Route::get('/kontak', function () {
    return view('kontak.index');
});
