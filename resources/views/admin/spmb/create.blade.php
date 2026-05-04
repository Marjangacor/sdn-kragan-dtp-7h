<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Tambah Pendaftar SPMB | Admin SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="admin-page min-h-screen bg-slate-100 text-slate-900">
        <main class="mx-auto max-w-4xl p-6">
            <header class="mb-8 rounded-3xl bg-white p-6 shadow-lg">
                <h1 class="text-3xl font-semibold text-slate-900">Tambah Pendaftar SPMB</h1>
                <p class="mt-2 text-sm text-slate-600">Masukkan data calon peserta didik baru.</p>
            </header>

            <form action="{{ route('admin.spmb.store') }}" method="POST" class="space-y-6 rounded-3xl bg-white p-6 shadow-lg">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="student_name">Nama Siswa</label>
                    <input id="student_name" name="student_name" type="text" value="{{ old('student_name') }}" required class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20" />
                    @error('student_name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="grid gap-6 lg:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700" for="student_email">Email Siswa</label>
                        <input id="student_email" name="student_email" type="email" value="{{ old('student_email') }}" required class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20" />
                        @error('student_email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700" for="student_birthdate">Tanggal Lahir</label>
                        <input id="student_birthdate" name="student_birthdate" type="date" value="{{ old('student_birthdate') }}" required class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20" />
                        @error('student_birthdate')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="student_address">Alamat</label>
                    <textarea id="student_address" name="student_address" rows="4" required class="mt-2 w-full rounded-3xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20">{{ old('student_address') }}</textarea>
                    @error('student_address')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="grid gap-6 lg:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700" for="parent_name">Nama Orang Tua</label>
                        <input id="parent_name" name="parent_name" type="text" value="{{ old('parent_name') }}" required class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20" />
                        @error('parent_name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700" for="parent_phone">Nomor HP</label>
                        <input id="parent_phone" name="parent_phone" type="text" value="{{ old('parent_phone') }}" required class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20" />
                        @error('parent_phone')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="parent_email">Email Orang Tua</label>
                    <input id="parent_email" name="parent_email" type="email" value="{{ old('parent_email') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20" />
                    @error('parent_email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="status">Status</label>
                    <select id="status" name="status" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20">
                        <option value="pending" @selected(old('status') === 'pending')>Pending</option>
                        <option value="approved" @selected(old('status') === 'approved')>Disetujui</option>
                        <option value="rejected" @selected(old('status') === 'rejected')>Ditolak</option>
                    </select>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.spmb.index') }}" class="rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">Batal</a>
                    <button type="submit" class="rounded-xl bg-[#c20f1a] px-4 py-3 text-sm font-semibold text-white hover:opacity-95">Simpan</button>
                </div>
            </form>
        </main>
    </body>
</html>
