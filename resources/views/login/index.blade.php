<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Login | SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <main class="flex min-h-screen items-center justify-center px-4 py-10">
            <section class="w-full max-w-md rounded-3xl border border-slate-200 bg-white p-8 shadow-[0_24px_60px_rgba(15,23,42,0.12)]">
                <div class="mb-8 text-center">
                    <img src="{{ asset('images/logo-upt-sdn-kragan.png') }}" alt="Logo SDN Kragan" class="mx-auto mb-4 h-16 w-16 rounded-full object-contain" />
                    <h1 class="text-3xl font-bold text-slate-900">Masuk ke SDN Kragan</h1>
                    <p class="mt-2 text-sm text-slate-500">Gunakan email dan password untuk melanjutkan.</p>
                </div>

                <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="role" class="mb-2 block text-sm font-semibold text-slate-700">Login sebagai</label>
                        <select
                            id="role"
                            name="role"
                            required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20"
                        >
                            <option value="user" @selected(old('role', 'user') === 'user')>User</option>
                            <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                        </select>
                        @error('role')
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
                            autofocus
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
                            placeholder="Masukkan password"
                        />
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="flex items-center gap-2 text-sm text-slate-600">
                        <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-[#c20f1a] focus:ring-[#c20f1a]" />
                        Ingat saya
                    </label>

                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-[#c20f1a] to-[#8f0f16] px-4 py-3 font-semibold text-white transition hover:opacity-95">
                        Login
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('home') }}" class="text-sm font-semibold text-[#8f0f16] hover:underline">Kembali ke beranda</a>
                </div>
            </section>
        </main>
    </body>
</html>
