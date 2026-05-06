<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>403 - Akses Ditolak | SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <main class="flex min-h-screen items-center justify-center px-4">
            <div class="text-center">
                <div class="mb-8">
                    <p class="text-8xl font-bold text-orange-600">403</p>
                    <p class="mt-4 text-3xl font-semibold text-slate-900">Akses Ditolak</p>
                    <p class="mt-2 text-slate-600">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center rounded-xl bg-[#c20f1a] px-6 py-3 font-semibold text-white transition hover:opacity-95">
                        Kembali ke Beranda
                    </a>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-6 py-3 font-semibold text-slate-700 transition hover:bg-slate-50">
                                Ke Dashboard
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="mt-12">
                    <p class="text-sm text-slate-500">
                        Jika Anda merasa ini adalah kesalahan, silakan hubungi <a href="mailto:info@sdnkragan.sch.id" class="font-semibold text-[#c20f1a] hover:underline">admin sekolah</a>.
                    </p>
                </div>
            </div>
        </main>
    </body>
</html>
