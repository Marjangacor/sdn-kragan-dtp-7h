<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $activity->title }} | Ekstrakurikuler SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="ekstra-page school-page bg-slate-100 text-slate-900">
        <header class="ekstra-header site-header app-navbar sticky top-0 z-40">
            <div class="navbar-inner mx-auto flex max-w-7xl items-center justify-between gap-2 px-4 py-4 lg:px-8">
                <div class="header-left flex min-w-0 items-center gap-2 lg:gap-3">
                    <div class="header-brand">
                        <img src="{{ asset('images/logo-upt-sdn-kragan.png') }}" alt="Logo SDN Kragan" class="school-logo-img school-logo-img--small" />
                        <div class="header-brand-copy">
                            <p class="brand-title text-[1.45rem] font-semibold leading-none text-slate-900">SDN Kragan</p>
                            <p class="brand-subtitle mt-1 text-xs text-slate-500">Detail Ekstrakurikuler</p>
                        </div>
                    </div>
                    <nav class="nav-list hidden items-center gap-2 lg:flex">
                        <a href="{{ url('/') }}#beranda" class="nav-chip">Beranda</a>
                        <a href="{{ route('ekstra.index') }}" class="nav-chip is-active">Ekstrakurikuler</a>
                        <a href="{{ url('/kontak') }}" class="nav-chip">Kontak</a>
                    </nav>
                </div>
                <div class="header-actions flex items-center gap-2">
                    <a href="{{ route('ekstra.index') }}" class="top-login-btn hidden lg:inline-flex lg:px-6">Kembali ke Ekstra</a>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-5xl px-6 py-10 lg:px-8 lg:py-12">
            <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-lg">
                <div class="relative">
                    <img src="{{ $activity->photo_url ? (str_starts_with($activity->photo_url, 'http') ? $activity->photo_url : asset($activity->photo_url)) : 'https://images.unsplash.com/photo-1517927033932-b3d18e61fb3a?auto=format&fit=crop&w=1400&q=80' }}" alt="{{ $activity->title }}" class="h-[240px] w-full object-cover md:h-[360px]" />
                    <div class="absolute left-4 top-4 inline-flex items-center rounded-full bg-black/60 px-3 py-1 text-xs font-semibold text-white backdrop-blur-sm">
                        {{ $activity->category }}
                    </div>
                </div>

                <div class="p-6 md:p-9">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-red-600">Detail Kegiatan</p>
                    <h1 class="mt-3 text-3xl font-bold leading-tight text-slate-900 md:text-4xl">{{ $activity->title }}</h1>
                    <p class="mt-6 text-base leading-8 text-slate-700">{{ $activity->description }}</p>

                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        <a href="{{ route('ekstra.index') }}" class="inline-flex items-center rounded-xl bg-[#c20f1a] px-5 py-3 text-sm font-semibold text-white transition hover:opacity-95">Kembali ke Daftar</a>
                    </div>
                </div>
            </article>

            @if($relatedActivities->isNotEmpty())
                <section class="mt-10">
                    <h2 class="text-xl font-semibold text-slate-900">Kegiatan Lainnya</h2>
                    <div class="mt-4 grid gap-4 md:grid-cols-2">
                        @foreach ($relatedActivities as $related)
                            <a href="{{ route('ekstra.show', $related) }}" class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-red-600">{{ $related->category }}</p>
                                <h3 class="mt-2 text-lg font-semibold text-slate-900">{{ $related->title }}</h3>
                                <p class="mt-2 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($related->description, 95) }}</p>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </main>
    </body>
</html>