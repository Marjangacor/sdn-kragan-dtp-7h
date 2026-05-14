<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Dashboard Guru | SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <main class="mx-auto max-w-7xl p-6 grid gap-6 lg:grid-cols-[280px_1fr]">
            <!-- Sidebar untuk Guru -->
            <aside class="rounded-3xl bg-white p-6 shadow-lg h-fit">
                <div class="space-y-2">
                    <h3 class="text-lg font-semibold text-slate-900">Menu Guru</h3>
                    <nav class="space-y-1">
                        <a href="{{ route('teacher.dashboard') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                            📊 Dashboard
                        </a>
                        <a href="{{ route('teacher.achievements.index') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                            🏆 Prestasi Siswa
                        </a>
                        <a href="{{ route('teacher.achievements.create') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                            ➕ Tambah Prestasi
                        </a>
                    </nav>
                </div>
                <hr class="my-6 border-slate-200">
                <div class="space-y-2">
                    <a href="{{ route('home') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                        🏠 Beranda
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left rounded-xl px-4 py-3 text-sm font-semibold text-red-600 hover:bg-red-50 transition">
                            🚪 Logout
                        </button>
                    </form>
                </div>
            </aside>

            <div class="space-y-6">
                <!-- Header -->
                <header class="rounded-3xl bg-white p-6 shadow-lg">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.25em] text-blue-600 font-semibold">Dashboard Guru</p>
                            <h1 class="mt-2 text-3xl font-semibold text-slate-900">Selamat datang, {{ auth()->user()->name }}</h1>
                            <p class="mt-2 text-sm text-slate-600">Kelola dan catat prestasi siswa-siswamu dengan mudah.</p>
                        </div>
                    </div>
                </header>

                <!-- Statistics Cards -->
                <section class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <article class="rounded-3xl bg-white p-6 shadow-lg">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500 font-semibold">Total Siswa</p>
                        <p class="mt-4 text-5xl font-bold text-blue-600">{{ $totalStudents }}</p>
                        <p class="mt-2 text-sm text-slate-600">Siswa dalam kelasmu</p>
                    </article>

                    <article class="rounded-3xl bg-white p-6 shadow-lg">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500 font-semibold">Prestasi Tercatat</p>
                        <p class="mt-4 text-5xl font-bold text-green-600">{{ $totalAchievements }}</p>
                        <p class="mt-2 text-sm text-slate-600">Prestasi yang sudah ditambahkan</p>
                    </article>

                    <article class="rounded-3xl bg-white p-6 shadow-lg">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500 font-semibold">Kategori Prestasi</p>
                        <div class="mt-4 space-y-2">
                            @forelse($achievementsByCategory as $category)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-slate-700 font-medium">{{ $category->category }}</span>
                                    <span class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-purple-100 text-sm font-bold text-purple-600">{{ $category->total }}</span>
                                </div>
                            @empty
                                <p class="text-sm text-slate-500">Belum ada prestasi</p>
                            @endforelse
                        </div>
                    </article>
                </section>

                <!-- Quick Action -->
                <section class="rounded-3xl bg-gradient-to-r from-blue-600 to-blue-700 p-8 shadow-lg text-white">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-2xl font-bold">Catat Prestasi Baru</h2>
                            <p class="mt-2 text-blue-100">Tambahkan prestasi untuk siswa-siswamu dengan cepat dan mudah.</p>
                        </div>
                        <a href="{{ route('teacher.achievements.create') }}" class="inline-flex items-center rounded-xl bg-white px-6 py-3 font-semibold text-blue-600 transition hover:bg-blue-50">
                            ➕ Tambah Prestasi
                        </a>
                    </div>
                </section>

                <!-- Recent Achievements -->
                <section>
                    <div class="mb-6 flex items-center justify-between">
                        <h2 class="text-2xl font-semibold text-slate-900">Prestasi Terbaru</h2>
                        <a href="{{ route('teacher.achievements.index') }}" class="text-sm font-semibold text-blue-600 hover:underline">
                            Lihat Semua →
                        </a>
                    </div>

                    @if($recentAchievements->count() > 0)
                        <div class="grid gap-4">
                            @foreach($recentAchievements as $achievement)
                                <article class="rounded-2xl border border-slate-200 bg-white p-6 hover:shadow-md transition">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-semibold uppercase tracking-[0.1em] text-blue-600">{{ $achievement->category }}</p>
                                            <h3 class="mt-2 text-lg font-semibold text-slate-900 truncate">{{ $achievement->title }}</h3>
                                            <p class="mt-1 text-sm text-slate-600">
                                                Siswa: <span class="font-semibold">{{ $achievement->student->name ?? 'N/A' }}</span>
                                            </p>
                                            <p class="mt-1 text-xs text-slate-500">Tahun: {{ $achievement->year }}</p>
                                            @if($achievement->description)
                                                <p class="mt-2 text-sm text-slate-600 line-clamp-2">{{ $achievement->description }}</p>
                                            @endif
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ route('teacher.achievements.edit', $achievement) }}" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                                                ✏️
                                            </a>
                                            <form method="POST" action="{{ route('teacher.achievements.destroy', $achievement) }}" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center rounded-lg border border-red-300 bg-white px-3 py-2 text-sm font-semibold text-red-600 hover:bg-red-50">
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="rounded-3xl bg-white p-12 text-center shadow-lg">
                            <p class="text-lg text-slate-600">Belum ada prestasi yang tercatat.</p>
                            <a href="{{ route('teacher.achievements.create') }}" class="mt-4 inline-flex items-center rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700">
                                ➕ Tambah Prestasi
                            </a>
                        </div>
                    @endif
                </section>
            </div>
        </main>
    </body>
</html>
