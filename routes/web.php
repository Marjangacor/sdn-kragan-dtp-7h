<?php

use App\Http\Controllers\AdminAchievementController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminExtracurricularController;
use App\Http\Controllers\AdminFeedbackController;
use App\Http\Controllers\AdminSPMBRegistrationController;
use App\Http\Controllers\AdminTeacherController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\EkstraController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\SPMBRegistrationController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $redirectTo = Auth::user()->role === 'admin'
                ? route('dashboard')
                : route('home');

            return redirect()->intended($redirectTo);
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    })->name('login.store');

    Route::get('/register', function () {
        return view('register.index');
    })->name('register');

    Route::post('/register', function (Request $request) {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    })->name('register.store');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');

Route::get('/dashboard', [AdminDashboardController::class, 'index'])->middleware(['auth', 'admin'])->name('dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class)->except(['show']);
    Route::resource('feedback', AdminFeedbackController::class)->except(['show']);
    Route::resource('spmb', AdminSPMBRegistrationController::class)->parameters(['spmb' => 'registration'])->except(['show']);
    Route::resource('guru', AdminTeacherController::class)->except(['show']);
    Route::resource('ekstra', AdminExtracurricularController::class)->except(['show']);
    Route::resource('prestasi', AdminAchievementController::class)->except(['show']);
});

Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');

Route::get('/ekstra', [EkstraController::class, 'index'])->name('ekstra.index');

Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');

Route::get('/spmb', function () {
    return view('spmb.index');
});

Route::post('/spmb', [SPMBRegistrationController::class, 'store'])->name('spmb.store');

Route::get('/kritik-saran', function () {
    return view('kritik saran.index');
});

Route::post('/kritik-saran', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/kontak', function () {
    return view('kontak.index');
});
