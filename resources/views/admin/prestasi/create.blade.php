<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Tambah Prestasi | Admin SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <main class="mx-auto max-w-3xl p-6">
            <header class="mb-8 rounded-3xl bg-white p-6 shadow-lg">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm uppercase tracking-[0.25em] text-orange-500">Admin Panel</p>
                        <h1 class="mt-2 text-3xl font-semibold text-slate-900">Tambah Prestasi</h1>
                        <p class="mt-2 text-sm text-slate-600">Tambahkan prestasi siswa baru ke halaman sekolah.</p>
                    </div>
                    <a href="{{ route('admin.prestasi.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Kembali</a>
                </div>
            </header>

            <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 rounded-3xl bg-white p-6 shadow-lg">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Judul Prestasi</label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400" />
                    @error('title')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Kategori</label>
                    <input type="text" name="category" value="{{ old('category') }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400" />
                    @error('category')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Tahun</label>
                    <input type="text" name="year" value="{{ old('year') }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400" />
                    @error('year')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Deskripsi</label>
                    <textarea name="description" rows="4" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400">{{ old('description') }}</textarea>
                    @error('description')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="image">Pilih Gambar</label>
                    <input id="image" type="file" name="image" accept="image/jpeg,image/png,image/webp,image/gif" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 file:mr-3 file:cursor-pointer file:border-0 file:bg-orange-500 file:px-3 file:py-2 file:text-white file:font-semibold file:rounded-lg" />
                    <p class="mt-2 text-xs text-slate-500">Format: JPG, PNG, WebP, GIF. Maksimal 5MB.</p>
                    <div id="imagePreviewWrap" class="mt-3 hidden">
                        <p class="text-sm font-semibold text-slate-700">Preview Gambar</p>
                        <img id="imagePreview" alt="Preview gambar prestasi" class="mt-2 h-48 w-48 rounded-2xl object-cover shadow-sm" />
                    </div>
                    @error('image')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="rounded-xl bg-[#c20f1a] px-6 py-3 text-sm font-semibold text-white transition hover:opacity-95">Simpan</button>
                    <a href="{{ route('admin.prestasi.index') }}" class="rounded-xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Batal</a>
                </div>
            </form>
        </main>

        <script>
            const imageInput = document.getElementById('image');
            const imagePreviewWrap = document.getElementById('imagePreviewWrap');
            const imagePreview = document.getElementById('imagePreview');

            if (imageInput && imagePreview && imagePreviewWrap) {
                imageInput.addEventListener('change', function () {
                    const file = this.files && this.files[0];

                    if (!file) {
                        imagePreviewWrap.classList.add('hidden');
                        imagePreview.removeAttribute('src');
                        return;
                    }

                    imagePreview.src = URL.createObjectURL(file);
                    imagePreviewWrap.classList.remove('hidden');
                });
            }
        </script>
    </body>
</html>
