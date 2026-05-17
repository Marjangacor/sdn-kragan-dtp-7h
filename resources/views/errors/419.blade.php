<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>419 - Halaman Kadaluarsa | SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <main class="flex min-h-screen items-center justify-center px-4">
            <div class="text-center">
                <div class="mb-8">
                    <p class="text-8xl font-bold text-orange-600">419</p>
                    <p class="mt-4 text-3xl font-semibold text-slate-900">Halaman Kadaluarsa</p>
                    <p class="mt-2 text-slate-600">Sesi Anda telah berakhir. Silakan coba lagi.</p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center rounded-xl bg-[#c20f1a] px-6 py-3 font-semibold text-white transition hover:opacity-95">
                        Kembali ke Beranda
                    </a>
                    <a href="javascript:history.back()" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-6 py-3 font-semibold text-slate-700 transition hover:bg-slate-50">
                        Coba Lagi
                    </a>
                </div>
            </div>
        </main>
    </body>
</html>
