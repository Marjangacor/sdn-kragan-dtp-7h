<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Daftar | SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <main class="flex min-h-screen items-center justify-center px-4 py-10">
            <section class="w-full max-w-md rounded-3xl border border-slate-200 bg-white p-8 shadow-[0_24px_60px_rgba(15,23,42,0.12)]">
                <div class="mb-8 text-center">
                    <img src="{{ asset('images/logo-upt-sdn-kragan.png') }}" alt="Logo SDN Kragan" class="mx-auto mb-4 h-16 w-16 rounded-full object-contain" />
                    <h1 class="text-3xl font-bold text-slate-900">Daftar Akun Baru</h1>
                    <p class="mt-2 text-sm text-slate-500">Buat akun untuk mengakses fitur pengguna.</p>
                </div>

                <form method="POST" action="{{ route('register.store') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Nama Lengkap</label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20"
                            placeholder="Nama lengkap"
                        />
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20"
                            placeholder="nama@email.com"
                        />
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20"
                            placeholder="Minimal 8 karakter"
                        />
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">Konfirmasi Password</label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20"
                            placeholder="Ulangi password"
                        />
                    </div>

                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-[#c20f1a] to-[#8f0f16] px-4 py-3 font-semibold text-white transition hover:opacity-95">
                        Daftar
                    </button>
                </form>

                <div class="mt-6 text-center text-sm text-slate-500">
                    Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-[#8f0f16] hover:underline">Masuk di sini</a>
                </div>
            </section>
        </main>
    </body>
</html>
