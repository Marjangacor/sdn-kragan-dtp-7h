<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Prestasi Siswa | Dashboard Guru SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <main class="mx-auto max-w-7xl p-6 grid gap-6 lg:grid-cols-[280px_1fr]">
            <!-- Sidebar -->
            <aside class="rounded-3xl bg-white p-6 shadow-lg h-fit">
                <div class="space-y-2">
                    <h3 class="text-lg font-semibold text-slate-900">Menu Guru</h3>
                    <nav class="space-y-1">
                        <a href="{{ route('teacher.dashboard') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                            📊 Dashboard
                        </a>
                        <a href="{{ route('teacher.achievements.index') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-blue-600 bg-blue-50 transition">
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
                            <p class="text-sm uppercase tracking-[0.25em] text-blue-600 font-semibold">Prestasi Siswa</p>
                            <h1 class="mt-2 text-3xl font-semibold text-slate-900">Daftar Prestasi</h1>
                            <p class="mt-2 text-sm text-slate-600">Kelola prestasi siswa-siswamu dari sini.</p>
                        </div>
                        <a href="{{ route('teacher.achievements.create') }}" class="inline-flex items-center rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700 transition">
                            ➕ Tambah Prestasi
                        </a>
                    </div>
                </header>

                <!-- Success Alert -->
                @if(session('success'))
                    <div class="rounded-2xl border border-green-200 bg-green-50 p-4">
                        <p class="text-sm font-semibold text-green-800">✓ {{ session('success') }}</p>
                    </div>
                @endif

                <!-- Achievements List -->
                @if($achievements->count() > 0)
                    <div class="space-y-4">
                        @foreach($achievements as $achievement)
                            <article class="rounded-2xl border border-slate-200 bg-white p-6 hover:shadow-md transition">
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-3">
                                            <span class="inline-flex items-center rounded-lg bg-blue-100 px-3 py-1.5">
                                                <span class="text-xs font-bold uppercase tracking-[0.1em] text-blue-700">{{ $achievement->category }}</span>
                                            </span>
                                            <span class="text-xs font-semibold text-slate-500">{{ $achievement->year }}</span>
                                        </div>
                                        <h3 class="mt-3 text-xl font-semibold text-slate-900">{{ $achievement->title }}</h3>
                                        <p class="mt-2 text-sm text-slate-600">
                                            <span class="font-semibold">Siswa:</span> {{ $achievement->student->name ?? 'N/A' }} 
                                            @if($achievement->student)
                                                <span class="text-slate-500">({{ $achievement->student->student_id }})</span>
                                            @endif
                                        </p>
                                        @if($achievement->description)
                                            <p class="mt-2 text-sm text-slate-600">{{ $achievement->description }}</p>
                                        @endif
                                        <p class="mt-3 text-xs text-slate-500">
                                            Ditambahkan: {{ $achievement->created_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('teacher.achievements.edit', $achievement) }}" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-4 py-2 font-semibold text-slate-700 hover:bg-slate-50 transition">
                                            ✏️ Edit
                                        </a>
                                        <form method="POST" action="{{ route('teacher.achievements.destroy', $achievement) }}" onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center rounded-lg border border-red-300 bg-white px-4 py-2 font-semibold text-red-600 hover:bg-red-50 transition">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center">
                        {{ $achievements->links() }}
                    </div>
                @else
                    <div class="rounded-3xl bg-white p-12 text-center shadow-lg">
                        <p class="text-lg text-slate-600">Belum ada prestasi yang tercatat.</p>
                        <a href="{{ route('teacher.achievements.create') }}" class="mt-4 inline-flex items-center rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700">
                            ➕ Tambah Prestasi
                        </a>
                    </div>
                @endif
            </div>
        </main>
    </body>
</html>
