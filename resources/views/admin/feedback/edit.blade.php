<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Edit Feedback | Admin SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <main class="mx-auto max-w-4xl p-6">
            <header class="mb-8 rounded-3xl bg-white p-6 shadow-lg">
                <h1 class="text-3xl font-semibold text-slate-900">Edit Feedback</h1>
                <p class="mt-2 text-sm text-slate-600">Perbarui masukan atau ubah statusnya.</p>
            </header>

            <form action="{{ route('admin.feedback.update', $feedback) }}" method="POST" class="space-y-6 rounded-3xl bg-white p-6 shadow-lg">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="name">Nama</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $feedback->name) }}" required class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20" />
                    @error('name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $feedback->email) }}" required class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20" />
                    @error('email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="grid gap-6 lg:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700" for="type">Tipe</label>
                        <select id="type" name="type" required class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20">
                            <option value="saran" @selected(old('type', $feedback->type) === 'saran')>Saran</option>
                            <option value="kritik" @selected(old('type', $feedback->type) === 'kritik')>Kritik</option>
                            <option value="pujian" @selected(old('type', $feedback->type) === 'pujian')>Apresiasi</option>
                        </select>
                        @error('type')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700" for="status">Status</label>
                        <select id="status" name="status" required class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20">
                            <option value="pending" @selected(old('status', $feedback->status) === 'pending')>Pending</option>
                            <option value="read" @selected(old('status', $feedback->status) === 'read')>Dibaca</option>
                            <option value="replied" @selected(old('status', $feedback->status) === 'replied')>Dibalas</option>
                        </select>
                        @error('status')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="message">Pesan</label>
                    <textarea id="message" name="message" rows="6" required class="mt-2 w-full rounded-3xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20">{{ old('message', $feedback->message) }}</textarea>
                    @error('message')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.feedback.index') }}" class="rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">Batal</a>
                    <button type="submit" class="rounded-xl bg-[#c20f1a] px-4 py-3 text-sm font-semibold text-white hover:opacity-95">Simpan</button>
                </div>
            </form>
        </main>
    </body>
</html>
