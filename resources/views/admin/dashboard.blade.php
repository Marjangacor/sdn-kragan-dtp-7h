<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Dashboard Admin | SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="admin-page min-h-screen bg-slate-100 text-slate-900">
        <main class="mx-auto max-w-7xl p-6 grid gap-6 lg:grid-cols-[280px_1fr]">
            <aside class="admin-sidebar rounded-3xl bg-slate-950 p-6 shadow-2xl text-white">
                <div class="space-y-6">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Panel Admin</p>
                        <h2 class="mt-3 text-2xl font-semibold text-white">Quick Access</h2>
                        <p class="mt-2 text-sm text-slate-300">Akses monitoring dan CRUD fitur utama dengan cepat.</p>
                    </div>

                    <div class="rounded-3xl bg-slate-900/80 p-4 border border-white/10 shadow-inner">
                        <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Status</p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="inline-flex items-center rounded-full bg-emerald-500/15 px-3 py-1 text-xs font-semibold text-emerald-300">Online</span>
                            <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-slate-200">{{ $totalUsers }} Akun</span>
                        </div>
                    </div>

                    <div class="grid gap-3">
                        <a href="{{ route('dashboard') }}" class="sidebar-link">Dashboard</a>
                        <a href="{{ route('admin.users.index') }}" class="sidebar-link">Kelola Pengguna</a>
                        <a href="{{ route('admin.feedback.index') }}" class="sidebar-link">Kelola Feedback</a>
                        <a href="{{ route('admin.spmb.index') }}" class="sidebar-link">Kelola SPMB</a>
                        <a href="{{ route('admin.guru.index') }}" class="sidebar-link">Kelola Guru</a>
                        <a href="{{ route('admin.ekstra.index') }}" class="sidebar-link">Kelola Ekstra</a>
                        <a href="{{ route('admin.prestasi.index') }}" class="sidebar-link">Kelola Prestasi</a>
                    </div>

                    <div class="rounded-3xl bg-white/5 p-5 border border-white/10">
                        <p class="text-sm uppercase tracking-[0.24em] text-slate-400">Ringkasan Cepat</p>
                        <dl class="mt-4 space-y-3 text-sm text-slate-200">
                            <div class="flex items-center justify-between">
                                <span>Guru / Karyawan</span>
                                <span class="font-semibold text-white">{{ $totalTeachers }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Ekstrakurikuler</span>
                                <span class="font-semibold text-white">{{ $totalExtracurriculars }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Prestasi</span>
                                <span class="font-semibold text-white">{{ $totalAchievements }}</span>
                            </div>
                        </dl>
                    </div>
                </div>

                    <div class="rounded-3xl bg-slate-50 p-5">
                        <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Ringkasan</p>
                        <dl class="mt-4 space-y-3 text-sm text-slate-700">
                            <div class="flex items-center justify-between">
                                <span>Guru / Karyawan</span>
                                <span class="font-semibold text-slate-900">{{ $totalTeachers }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Ekstrakurikuler</span>
                                <span class="font-semibold text-slate-900">{{ $totalExtracurriculars }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Prestasi</span>
                                <span class="font-semibold text-slate-900">{{ $totalAchievements }}</span>
                            </div>
                        </dl>
                    </div>
                </div>
            </aside>

            <div class="space-y-6">
                <header class="admin-hero rounded-3xl bg-gradient-to-r from-[#fff1f1] via-[#fff5f3] to-[#fef7f6] p-6 shadow-2xl overflow-hidden relative reveal">
                    <div class="admin-hero-shape admin-hero-shape-1"></div>
                    <div class="admin-hero-shape admin-hero-shape-2"></div>
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.25em] text-orange-500">Dashboard Admin</p>
                            <h1 class="mt-2 text-3xl font-semibold text-slate-900">Selamat datang, {{ auth()->user()->name }}</h1>
                            <p class="mt-2 text-sm text-slate-600">Pantau pengguna, feedback, dan pendaftar SPMB dengan cepat.</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-3">
                            <a href="{{ route('home') }}" class="ripple-btn inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Beranda</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="ripple-btn inline-flex items-center rounded-xl bg-gradient-to-r from-[#c20f1a] to-[#8f0f16] px-4 py-3 text-sm font-semibold text-white transition hover:opacity-95">Logout</button>
                            </form>
                        </div>
                    </div>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                        <article class="rounded-3xl bg-white/90 p-5 shadow-sm border border-white/70 backdrop-blur-xl">
                            <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Akun Hari Ini</p>
                            <p class="mt-3 text-3xl font-bold text-slate-900" data-counter="{{ $recentUsers->count() }}">{{ $recentUsers->count() }}</p>
                            <p class="mt-2 text-sm text-slate-500">Pengguna baru hari ini</p>
                        </article>
                        <article class="rounded-3xl bg-white/90 p-5 shadow-sm border border-white/70 backdrop-blur-xl">
                            <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Total Feedback</p>
                            <p class="mt-3 text-3xl font-bold text-slate-900" data-counter="{{ $totalFeedbacks }}">{{ $totalFeedbacks }}</p>
                            <p class="mt-2 text-sm text-slate-500">Kritik dan saran masuk</p>
                        </article>
                        <article class="rounded-3xl bg-white/90 p-5 shadow-sm border border-white/70 backdrop-blur-xl">
                            <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Total Pendaftar</p>
                            <p class="mt-3 text-3xl font-bold text-slate-900" data-counter="{{ $totalSPMB }}">{{ $totalSPMB }}</p>
                            <p class="mt-2 text-sm text-slate-500">Pendaftar SPMB</p>
                        </article>
                        <article class="rounded-3xl bg-white/90 p-5 shadow-sm border border-white/70 backdrop-blur-xl">
                            <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Admin Aktif</p>
                            <p class="mt-3 text-3xl font-bold text-orange-600" data-counter="{{ $totalAdmins }}">{{ $totalAdmins }}</p>
                            <p class="mt-2 text-sm text-slate-500">Akun admin</p>
                        </article>
                    </div>
                </header>

            <section class="mb-8 grid gap-4 sm:grid-cols-3">
                <a href="{{ route('admin.users.index') }}" class="admin-card reveal admin-animate rounded-3xl bg-white p-6 shadow-lg transition hover:-translate-y-0.5" style="--reveal-delay: 80ms">
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Kelola Pengguna</p>
                    <p class="mt-4 text-xl font-semibold text-slate-900">User & Admin</p>
                </a>
                <a href="{{ route('admin.feedback.index') }}" class="admin-card reveal admin-animate rounded-3xl bg-white p-6 shadow-lg transition hover:-translate-y-0.5" style="--reveal-delay: 140ms">
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Kelola Feedback</p>
                    <p class="mt-4 text-xl font-semibold text-slate-900">Kritik & Saran</p>
                </a>
                <a href="{{ route('admin.spmb.index') }}" class="admin-card reveal admin-animate rounded-3xl bg-white p-6 shadow-lg transition hover:-translate-y-0.5" style="--reveal-delay: 200ms">
                    <p class="mt-4 text-xl font-semibold text-slate-900">Pendaftar SPMB</p>
                </a>
            </section>

            <!-- User Statistics -->
            <section class="mb-8">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h2 class="mb-2 text-2xl font-semibold text-slate-900">Statistik Pengguna</h2>
                        <p class="text-sm text-slate-500">Ringkasan data akun pengguna dan admin.</p>
                    </div>
                    <div class="rounded-full bg-white/90 px-4 py-2 text-sm text-slate-600 shadow-sm">Changelog terakhir: UI diperbarui</div>
                </div>
                <div class="grid gap-6 lg:grid-cols-4">
                    <article class="admin-card reveal admin-animate rounded-3xl bg-white p-6 shadow-lg" style="--reveal-delay: 90ms">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Total Akun</p>
                        <p class="mt-4 text-5xl font-bold text-slate-900" data-counter="{{ $totalUsers }}">{{ $totalUsers }}</p>
                        <p class="mt-2 text-sm text-slate-600">Jumlah akun terdaftar</p>
                    </article>
                    <article class="admin-card reveal admin-animate rounded-3xl bg-white p-6 shadow-lg" style="--reveal-delay: 130ms">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Admin</p>
                        <p class="mt-4 text-5xl font-bold text-orange-600" data-counter="{{ $totalAdmins }}">{{ $totalAdmins }}</p>
                        <p class="mt-2 text-sm text-slate-600">Akun dengan peran admin</p>
                    </article>
                    <article class="admin-card reveal admin-animate rounded-3xl bg-white p-6 shadow-lg" style="--reveal-delay: 170ms">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Pengguna Biasa</p>
                        <p class="mt-4 text-5xl font-bold text-blue-600" data-counter="{{ $totalRegularUsers }}">{{ $totalRegularUsers }}</p>
                        <p class="mt-2 text-sm text-slate-600">Akun dengan peran user</p>
                    </article>
                    <article class="admin-card reveal admin-animate rounded-3xl bg-white p-6 shadow-lg" style="--reveal-delay: 210ms">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Bulan Ini</p>
                        <p class="mt-4 text-5xl font-bold text-green-600" data-counter="{{ $recentUsers->count() }}">{{ $recentUsers->count() }}</p>
                        <p class="mt-2 text-sm text-slate-600">Akun terbaru</p>
                    </article>
                </div>
            </section>

            <!-- Feedback Statistics -->
            <section class="mb-8">
                <h2 class="mb-4 text-2xl font-semibold text-slate-900">Statistik Kritik & Saran</h2>
                <div class="grid gap-6 lg:grid-cols-3">
                    <article class="admin-card reveal admin-animate rounded-3xl bg-white p-6 shadow-lg" style="--reveal-delay: 90ms">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Total Feedback</p>
                        <p class="mt-4 text-5xl font-bold text-slate-900" data-counter="{{ $totalFeedbacks }}">{{ $totalFeedbacks }}</p>
                        <p class="mt-2 text-sm text-slate-600">Kritik, saran, dan pujian</p>
                    </article>
                    <article class="admin-card reveal admin-animate rounded-3xl bg-white p-6 shadow-lg" style="--reveal-delay: 130ms">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Belum Dibaca</p>
                        <p class="mt-4 text-5xl font-bold text-red-600" data-counter="{{ $feedbackPending }}">{{ $feedbackPending }}</p>
                        <p class="mt-2 text-sm text-slate-600">Status pending</p>
                    </article>
                    <article class="admin-card reveal admin-animate rounded-3xl bg-white p-6 shadow-lg" style="--reveal-delay: 170ms">
                        <div class="space-y-2">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Tipe Feedback</p>
                            @foreach($feedbackByType as $item)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-slate-700">{{ ucfirst($item->type) }}</span>
                                    <span class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-slate-100 text-sm font-semibold text-slate-900">{{ $item->total }}</span>
                                </div>
                            @endforeach
                        </div>
                    </article>
                </div>
            </section>

            <!-- SPMB Statistics -->
            <section class="mb-8">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h2 class="mb-2 text-2xl font-semibold text-slate-900">Statistik Pendaftar SPMB</h2>
                        <p class="text-sm text-slate-500">Data pendaftaran terbaru dan status verifikasi.</p>
                    </div>
                    <div class="rounded-full bg-white/90 px-4 py-2 text-sm text-slate-600 shadow-sm">Tracking performa pendaftaran</div>
                </div>
                <div class="grid gap-6 lg:grid-cols-5">
                    <article class="rounded-3xl bg-white p-6 shadow-lg">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Total Pendaftar</p>
                        <p class="mt-4 text-5xl font-bold text-slate-900">{{ $totalSPMB }}</p>
                        <p class="mt-2 text-sm text-slate-600">Semua pendaftaran</p>
                    </article>
                    <article class="rounded-3xl bg-white p-6 shadow-lg">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Pending</p>
                        <p class="mt-4 text-5xl font-bold text-yellow-600">{{ $spmbiPending }}</p>
                        <p class="mt-2 text-sm text-slate-600">Verifikasi</p>
                    </article>
                    <article class="rounded-3xl bg-white p-6 shadow-lg">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Disetujui</p>
                        <p class="mt-4 text-5xl font-bold text-green-600">{{ $spmbiApproved }}</p>
                        <p class="mt-2 text-sm text-slate-600">Diterima</p>
                    </article>
                    <article class="rounded-3xl bg-white p-6 shadow-lg">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Ditolak</p>
                        <p class="mt-4 text-5xl font-bold text-red-600">{{ $spmbiRejected }}</p>
                        <p class="mt-2 text-sm text-slate-600">Tidak diterima</p>
                    </article>
                    <article class="rounded-3xl bg-white p-6 shadow-lg">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Tingkat Diterima</p>
                        <p class="mt-4 text-5xl font-bold text-blue-600">{{ $totalSPMB > 0 ? floor(($spmbiApproved / $totalSPMB) * 100) : 0 }}%</p>
                        <p class="mt-2 text-sm text-slate-600">Dari total</p>
                    </article>
                </div>
            </section>

            <!-- Recent Data Tables -->
            <section class="grid gap-6 lg:grid-cols-2">
                <!-- Recent Users -->
                <article class="rounded-3xl bg-white p-6 shadow-lg">
                    <h3 class="mb-4 text-xl font-semibold text-slate-900">Pengguna Terbaru</h3>
                    <div class="overflow-hidden rounded-2xl border border-slate-200">
                        <table class="w-full divide-y divide-slate-200 text-left text-sm">
                            <thead class="bg-slate-50 text-slate-700">
                                <tr>
                                    <th class="px-4 py-3 font-medium">Nama</th>
                                    <th class="px-4 py-3 font-medium">Peran</th>
                                    <th class="px-4 py-3 font-medium">Terdaftar</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white">
                                @forelse ($recentUsers as $user)
                                    <tr>
                                        <td class="px-4 py-3 text-slate-900">{{ $user->name }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ ucfirst($user->role) }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $user->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-6 text-center text-slate-500">Belum ada akun</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </article>

                <!-- Recent Feedback -->
                <article class="rounded-3xl bg-white p-6 shadow-lg">
                    <h3 class="mb-4 text-xl font-semibold text-slate-900">Feedback Terbaru</h3>
                    <div class="overflow-hidden rounded-2xl border border-slate-200">
                        <table class="w-full divide-y divide-slate-200 text-left text-sm">
                            <thead class="bg-slate-50 text-slate-700">
                                <tr>
                                    <th class="px-4 py-3 font-medium">Nama</th>
                                    <th class="px-4 py-3 font-medium">Tipe</th>
                                    <th class="px-4 py-3 font-medium">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white">
                                @forelse ($recentFeedbacks as $feedback)
                                    <tr>
                                        <td class="px-4 py-3 text-slate-900">{{ $feedback->name }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ ucfirst($feedback->type) }}</td>
                                        <td class="px-4 py-3">
                                            @if($feedback->status === 'pending')
                                                <span class="inline-flex rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-semibold text-yellow-800">Pending</span>
                                            @elseif($feedback->status === 'read')
                                                <span class="inline-flex rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-800">Dibaca</span>
                                            @else
                                                <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800">Dibalas</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-6 text-center text-slate-500">Belum ada feedback</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </article>
            </section>

            <!-- SPMB Registrations -->
            <section class="mt-6 rounded-3xl bg-white p-6 shadow-lg">
                <h3 class="mb-4 text-xl font-semibold text-slate-900">Pendaftar SPMB Terbaru</h3>
                <div class="overflow-hidden rounded-2xl border border-slate-200">
                    <table class="w-full divide-y divide-slate-200 text-left text-sm">
                        <thead class="bg-slate-50 text-slate-700">
                            <tr>
                                <th class="px-4 py-3 font-medium">Nama Siswa</th>
                                <th class="px-4 py-3 font-medium">Nama Orang Tua</th>
                                <th class="px-4 py-3 font-medium">No. HP</th>
                                <th class="px-4 py-3 font-medium">Status</th>
                                <th class="px-4 py-3 font-medium">Terdaftar</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @forelse ($recentSPMB as $registration)
                                <tr>
                                    <td class="px-4 py-3 text-slate-900">{{ $registration->student_name }}</td>
                                    <td class="px-4 py-3 text-slate-600">{{ $registration->parent_name }}</td>
                                    <td class="px-4 py-3 text-slate-600">{{ $registration->parent_phone }}</td>
                                    <td class="px-4 py-3">
                                        @if($registration->status === 'pending')
                                            <span class="inline-flex rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-semibold text-yellow-800">Pending</span>
                                        @elseif($registration->status === 'approved')
                                            <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800">Disetujui</span>
                                        @else
                                            <span class="inline-flex rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-semibold text-red-800">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-slate-600">{{ $registration->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-slate-500">Belum ada pendaftar</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </body>
</html>
