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
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <main class="mx-auto max-w-7xl p-6 grid gap-6 lg:grid-cols-[280px_1fr]">
            <aside class="rounded-3xl bg-white p-6 shadow-lg">
                <div class="space-y-6">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Panel Admin</p>
                        <h2 class="mt-3 text-2xl font-semibold text-slate-900">Navigasi Cepat</h2>
                        <p class="mt-2 text-sm text-slate-600">Akses monitoring dan CRUD fitur utama.</p>
                    </div>

                    <div class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="block rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">Dashboard</a>
                        <a href="{{ route('admin.users.index') }}" class="block rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">Kelola Pengguna</a>
                        <a href="{{ route('admin.feedback.index') }}" class="block rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">Kelola Feedback</a>
                        {{-- <a href="{{ route('admin.spmb.index') }}" class="block rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">Kelola SPMB</a> --}}
                        <a href="{{ route('admin.guru.index') }}" class="block rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">Kelola Guru</a>
                        <a href="{{ route('admin.ekstra.index') }}" class="block rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">Kelola Ekstra</a>
                        <a href="{{ route('admin.prestasi.index') }}" class="block rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">Kelola Prestasi</a>
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
                <header class="rounded-3xl bg-white p-6 shadow-lg">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.25em] text-orange-500">Dashboard Admin</p>
                            <h1 class="mt-2 text-3xl font-semibold text-slate-900">Selamat datang, {{ auth()->user()->name }}</h1>
                            <p class="mt-2 text-sm text-slate-600">Pantau pengguna, feedback, data guru, dan ekstrakurikuler.</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-3">
                            <a href="{{ route('home') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Beranda</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="inline-flex items-center rounded-xl bg-gradient-to-r from-[#c20f1a] to-[#8f0f16] px-4 py-3 text-sm font-semibold text-white transition hover:opacity-95">Logout</button>
                            </form>
                        </div>
                    </div>
                </header>

            <section class="mb-8 grid gap-4 sm:grid-cols-3">
                <a href="{{ route('admin.users.index') }}" class="rounded-3xl bg-white p-6 shadow-lg transition hover:-translate-y-0.5">
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Kelola Pengguna</p>
                    <p class="mt-4 text-xl font-semibold text-slate-900">User & Admin</p>
                </a>
                <a href="{{ route('admin.feedback.index') }}" class="rounded-3xl bg-white p-6 shadow-lg transition hover:-translate-y-0.5">
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Kelola Feedback</p>
                    <p class="mt-4 text-xl font-semibold text-slate-900">Kritik & Saran</p>
                </a>
                {{-- <a href="{{ route('admin.spmb.index') }}" class="rounded-3xl bg-white p-6 shadow-lg transition hover:-translate-y-0.5">
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Kelola SPMB</p>
                    <p class="mt-4 text-xl font-semibold text-slate-900">Pendaftar SPMB</p>
                </a> --}}
            </section>

            <!-- User Statistics -->
            <section class="mb-8">
                <h2 class="mb-4 text-2xl font-semibold text-slate-900">Statistik Pengguna</h2>
                <div class="grid gap-6 lg:grid-cols-4">
                    <article class="rounded-3xl bg-white p-6 shadow-lg">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Total Akun</p>
                        <p class="mt-4 text-5xl font-bold text-slate-900">{{ $totalUsers }}</p>
                        <p class="mt-2 text-sm text-slate-600">Jumlah akun terdaftar</p>
                    </article>
                    <article class="rounded-3xl bg-white p-6 shadow-lg">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Admin</p>
                        <p class="mt-4 text-5xl font-bold text-orange-600">{{ $totalAdmins }}</p>
                        <p class="mt-2 text-sm text-slate-600">Akun dengan peran admin</p>
                    </article>
                    <article class="rounded-3xl bg-white p-6 shadow-lg">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Pengguna Biasa</p>
                        <p class="mt-4 text-5xl font-bold text-blue-600">{{ $totalRegularUsers }}</p>
                        <p class="mt-2 text-sm text-slate-600">Akun dengan peran user</p>
                    </article>
                    <article class="rounded-3xl bg-white p-6 shadow-lg">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Bulan Ini</p>
                        <p class="mt-4 text-5xl font-bold text-green-600">{{ $recentUsers->count() }}</p>
                        <p class="mt-2 text-sm text-slate-600">Akun terbaru</p>
                    </article>
                </div>
            </section>

            <!-- Feedback Statistics -->
            <section class="mb-8">
                <h2 class="mb-4 text-2xl font-semibold text-slate-900">Statistik Kritik & Saran</h2>
                <div class="grid gap-6 lg:grid-cols-3">
                    <article class="rounded-3xl bg-white p-6 shadow-lg">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Total Feedback</p>
                        <p class="mt-4 text-5xl font-bold text-slate-900">{{ $totalFeedbacks }}</p>
                        <p class="mt-2 text-sm text-slate-600">Kritik, saran, dan pujian</p>
                    </article>
                    <article class="rounded-3xl bg-white p-6 shadow-lg">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Belum Dibaca</p>
                        <p class="mt-4 text-5xl font-bold text-red-600">{{ $feedbackPending }}</p>
                        <p class="mt-2 text-sm text-slate-600">Status pending</p>
                    </article>
                    <article class="rounded-3xl bg-white p-6 shadow-lg">
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


        </main>
    </body>
</html>
