<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Dashboard Pengguna | SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <main class="mx-auto max-w-5xl p-6">
            <header class="mb-8 rounded-3xl bg-white p-6 shadow-lg">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm uppercase tracking-[0.25em] text-orange-500">Dashboard</p>
                        <h1 class="mt-2 text-3xl font-semibold text-slate-900">Halo, {{ auth()->user()->name }}</h1>
                        <p class="mt-2 text-sm text-slate-600">Selamat datang di halaman pengguna. Anda dapat kembali ke beranda atau mengelola akun Anda.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('home') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Beranda</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center rounded-xl bg-gradient-to-r from-[#c20f1a] to-[#8f0f16] px-4 py-3 text-sm font-semibold text-white transition hover:opacity-95">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <section class="grid gap-6 lg:grid-cols-2">
                <article class="rounded-3xl bg-white p-6 shadow-lg">
                    <h2 class="text-xl font-semibold text-slate-900">Informasi Akun</h2>
                    <div class="mt-4 space-y-3 text-sm text-slate-600">
                        <p><span class="font-semibold text-slate-900">Nama:</span> {{ auth()->user()->name }}</p>
                        <p><span class="font-semibold text-slate-900">Email:</span> {{ auth()->user()->email }}</p>
                        <p><span class="font-semibold text-slate-900">Peran:</span> {{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </article>
                <article class="rounded-3xl bg-white p-6 shadow-lg">
                    <h2 class="text-xl font-semibold text-slate-900">Tentang</h2>
                    <p class="mt-4 text-sm leading-7 text-slate-600">Sebagai pengguna, Anda dapat mengakses halaman khusus pengguna dan kembali ke beranda sekolah. Halaman admin tersedia hanya untuk akun yang memiliki peran admin.</p>
                </article>
            </section>
        </main>
    </body>
</html>
