<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Tambah Prestasi | Dashboard Guru SDN Kragan</title>
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
                        <a href="{{ route('teacher.achievements.index') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                            🏆 Prestasi Siswa
                        </a>
                        <a href="{{ route('teacher.achievements.create') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-blue-600 bg-blue-50 transition">
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
                            <p class="text-sm uppercase tracking-[0.25em] text-green-600 font-semibold">Tambah Prestasi</p>
                            <h1 class="mt-2 text-3xl font-semibold text-slate-900">Form Prestasi Baru</h1>
                            <p class="mt-2 text-sm text-slate-600">Masukkan data prestasi siswa dengan lengkap.</p>
                        </div>
                    </div>
                </header>

                <!-- Form Card -->
                <div class="rounded-3xl bg-white p-8 shadow-lg">
                    <form method="POST" action="{{ route('teacher.achievements.store') }}" class="space-y-6">
                        @csrf

                        <!-- Student Selection -->
                        <div>
                            <label for="student_id" class="block text-sm font-semibold text-slate-900 mb-2">
                                Pilih Siswa <span class="text-red-600">*</span>
                            </label>
                            <select 
                                id="student_id"
                                name="student_id"
                                required
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            >
                                <option value="">-- Pilih Siswa --</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->name }} ({{ $student->student_id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-semibold text-slate-900 mb-2">
                                Judul Prestasi <span class="text-red-600">*</span>
                            </label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                placeholder="Contoh: Juara 1 Lomba Cerdas Cermat"
                                required
                                value="{{ old('title') }}"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            />
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-semibold text-slate-900 mb-2">
                                Kategori <span class="text-red-600">*</span>
                            </label>
                            <select
                                id="category"
                                name="category"
                                required
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            >
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Akademik" {{ old('category') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                <option value="Olahraga" {{ old('category') == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                                <option value="Seni" {{ old('category') == 'Seni' ? 'selected' : '' }}>Seni</option>
                                <option value="Kepemimpinan" {{ old('category') == 'Kepemimpinan' ? 'selected' : '' }}>Kepemimpinan</option>
                                <option value="Lainnya" {{ old('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('category')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Year -->
                        <div>
                            <label for="year" class="block text-sm font-semibold text-slate-900 mb-2">
                                Tahun <span class="text-red-600">*</span>
                            </label>
                            <input
                                type="number"
                                id="year"
                                name="year"
                                min="2000"
                                max="2099"
                                placeholder="{{ date('Y') }}"
                                required
                                value="{{ old('year', date('Y')) }}"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            />
                            @error('year')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-900 mb-2">
                                Deskripsi <span class="text-slate-500">(Opsional)</span>
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                placeholder="Deskripsi detail tentang prestasi ini..."
                                rows="5"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-4 pt-6">
                            <button
                                type="submit"
                                class="flex-1 rounded-xl bg-green-600 px-6 py-3 font-semibold text-white hover:bg-green-700 transition"
                            >
                                ✓ Simpan Prestasi
                            </button>
                            <a
                                href="{{ route('teacher.achievements.index') }}"
                                class="flex-1 rounded-xl border border-slate-300 bg-white px-6 py-3 font-semibold text-slate-700 text-center hover:bg-slate-50 transition"
                            >
                                ✕ Batalkan
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>
