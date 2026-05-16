<?php

use App\Http\Controllers\AdminAchievementController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminExtracurricularController;
use App\Http\Controllers\AdminFeedbackController;
use App\Http\Controllers\AdminGalleryController;
use App\Http\Controllers\AdminSPMBRegistrationController;
use App\Http\Controllers\AdminTeacherController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\EkstraController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\SPMBRegistrationController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\TeacherAchievementController;
use App\Models\Gallery;
use App\Models\User;
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
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Get user from database to determine role
        $user = User::where('email', $credentials['email'])->first();
        
        if ($user && in_array($user->role, ['admin', 'pembina-ekstra'], true)) {
            $redirectTo = route('dashboard');
        } elseif ($user && $user->role === 'guru') {
            $redirectTo = route('teacher.dashboard');
        } else {
            $redirectTo = route('home');
        }

        // Attempt authentication with email and password only
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
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
            'password' => $data['password'],
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

Route::get('/dashboard', [AdminDashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class)->except(['show']);
    Route::resource('feedback', AdminFeedbackController::class)->except(['show']);
    Route::resource('galeri', AdminGalleryController::class)->except(['show']);
    Route::resource('spmb', AdminSPMBRegistrationController::class)->parameters(['spmb' => 'registration'])->except(['show']);
    Route::resource('guru', AdminTeacherController::class)->except(['show']);
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('ekstra', AdminExtracurricularController::class)->except(['show']);
    Route::resource('prestasi', AdminAchievementController::class)->except(['show']);
});

// Teacher Routes
Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])->middleware(['auth', 'guru'])->name('teacher.dashboard');

Route::middleware(['auth', 'guru'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::resource('achievements', TeacherAchievementController::class)->except(['show']);
});

Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
Route::get('/guru/{guru}', [GuruController::class, 'show'])->name('guru.show');

Route::get('/ekstra', [EkstraController::class, 'index'])->name('ekstra.index');
Route::get('/ekstra/{ekstra}', [EkstraController::class, 'show'])->name('ekstra.show');

Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
Route::get('/prestasi/{prestasi}', [PrestasiController::class, 'show'])->name('prestasi.show');

Route::get('/galeri', function () {
    $galleryItems = Gallery::orderBy('sort_order')->orderByDesc('event_date')->orderByDesc('created_at')->get();

    if ($galleryItems->isEmpty()) {
        $galleryItems = collect([
            [
                'title' => 'Upacara Bendera',
                'category' => 'Kegiatan Rutin',
                'description' => 'Dokumentasi kegiatan rutin sekolah untuk membangun disiplin dan rasa cinta tanah air.',
                'image_url' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=900&q=80',
                'event_date' => null,
            ],
            [
                'title' => 'Pembelajaran di Kelas',
                'category' => 'Belajar',
                'description' => 'Suasana belajar yang aktif, interaktif, dan menyenangkan di ruang kelas.',
                'image_url' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=80',
                'event_date' => null,
            ],
            [
                'title' => 'Lomba Siswa',
                'category' => 'Prestasi',
                'description' => 'Momen siswa tampil percaya diri dalam berbagai ajang lomba akademik dan nonakademik.',
                'image_url' => 'https://images.unsplash.com/photo-1527600478564-488952effedb?auto=format&fit=crop&w=900&q=80',
                'event_date' => null,
            ],
            [
                'title' => 'Kegiatan Seni',
                'category' => 'Seni & Kreasi',
                'description' => 'Ekspresi bakat siswa melalui seni, kreasi, dan pentas di sekolah.',
                'image_url' => 'https://images.unsplash.com/photo-1452587925148-ce544e77e70d?auto=format&fit=crop&w=900&q=80',
                'event_date' => null,
            ],
            [
                'title' => 'Kerja Bakti',
                'category' => 'Kepedulian',
                'description' => 'Gotong royong membersihkan dan merawat lingkungan sekolah bersama.',
                'image_url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&q=80',
                'event_date' => null,
            ],
            [
                'title' => 'Kegiatan Bersama Orang Tua',
                'category' => 'Kolaborasi',
                'description' => 'Kolaborasi sekolah dan wali murid dalam mendukung tumbuh kembang siswa.',
                'image_url' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=900&q=80',
                'event_date' => null,
            ],
        ]);
    }

    return view('galeri.index', [
        'galleryItems' => $galleryItems,
    ]);
})->name('galeri.index');

Route::get('/spmb', function () {
    return view('spmb.index');
});

// SPMB registration form submission disabled - only syarat/requirements page
// Route::post('/spmb', [SPMBRegistrationController::class, 'store'])->name('spmb.store');

Route::get('/kritik-saran', function () {
    return view('kritik saran.index');
});

Route::post('/kritik-saran', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/kontak', function () {
    return view('kontak.index');
});
