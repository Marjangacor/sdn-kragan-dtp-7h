<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $teacher->name }} | Guru & Karyawan SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="guru-page school-page bg-slate-100 text-slate-900">
        <header class="guru-header site-header app-navbar sticky top-0 z-40">
            <div class="navbar-inner mx-auto flex max-w-7xl items-center justify-between gap-2 px-4 py-4 lg:px-8">
                <div class="header-left flex min-w-0 items-center gap-2 lg:gap-3">
                    <div class="header-brand">
                        <img src="{{ asset('images/logo-upt-sdn-kragan.png') }}" alt="Logo SDN Kragan" class="school-logo-img school-logo-img--small" />
                        <div class="header-brand-copy">
                            <p class="brand-title text-[1.45rem] font-semibold leading-none text-slate-900">SDN Kragan</p>
                            <p class="brand-subtitle mt-1 text-xs text-slate-500">Detail Guru</p>
                        </div>
                    </div>
                    <nav class="nav-list hidden items-center gap-2 lg:flex">
                        <a href="{{ url('/') }}#beranda" class="nav-chip">Beranda</a>
                        <a href="{{ route('guru.index') }}" class="nav-chip is-active">Guru & Karyawan</a>
                        <a href="{{ url('/kontak') }}" class="nav-chip">Kontak</a>
                    </nav>
                </div>
                <div class="header-actions flex items-center gap-2">
                    <a href="{{ route('guru.index') }}" class="top-login-btn hidden lg:inline-flex lg:px-6">Kembali ke Guru</a>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-5xl px-6 py-10 lg:px-8 lg:py-12">
            <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-lg">
                <div class="relative">
                    <img src="{{ $teacher->photo_url ? (str_starts_with($teacher->photo_url, 'http') ? $teacher->photo_url : asset($teacher->photo_url)) : 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=1400&q=80' }}" alt="Foto {{ $teacher->name }}" class="h-[260px] w-full object-cover md:h-[380px]" />
                    <div class="absolute left-4 top-4 inline-flex items-center rounded-full bg-black/60 px-3 py-1 text-xs font-semibold text-white backdrop-blur-sm">
                        {{ $teacher->type }}
                    </div>
                </div>

                <div class="p-6 md:p-9">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-red-600">Detail Tenaga Pendidik</p>
                    <h1 class="mt-3 text-3xl font-bold leading-tight text-slate-900 md:text-4xl">{{ $teacher->name }}</h1>
                    <p class="mt-6 text-base leading-8 text-slate-700">
                        {{ $teacher->type === 'Guru' ? 'Beliau merupakan tenaga pendidik yang mengajar pada mata pelajaran ' : 'Beliau merupakan tenaga kependidikan yang bertugas pada bidang ' }}
                        {{ $teacher->subject }}.
                    </p>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-500">Tipe</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ $teacher->type }}</p>
                        </div>
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-500">Mapel / Bidang Tugas</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ $teacher->subject }}</p>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        <a href="{{ route('guru.index') }}" class="inline-flex items-center rounded-xl bg-[#c20f1a] px-5 py-3 text-sm font-semibold text-white transition hover:opacity-95">Kembali ke Daftar</a>
                    </div>
                </div>
            </article>

            @if($relatedTeachers->isNotEmpty())
                <section class="mt-10">
                    <h2 class="text-xl font-semibold text-slate-900">Guru & Karyawan Lainnya</h2>
                    <div class="mt-4 grid gap-4 md:grid-cols-2">
                        @foreach ($relatedTeachers as $related)
                            <a href="{{ route('guru.show', $related) }}" class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-red-600">{{ $related->type }}</p>
                                <h3 class="mt-2 text-lg font-semibold text-slate-900">{{ $related->name }}</h3>
                                <p class="mt-2 text-sm text-slate-600">{{ $related->type === 'Guru' ? 'Mapel: ' : 'Bidang: ' }}{{ $related->subject }}</p>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </main>
    </body>
</html>