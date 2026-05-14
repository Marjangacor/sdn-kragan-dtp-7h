<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $achievement->title }} | Prestasi SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="prestasi-page school-page bg-slate-100 text-slate-900">
        <header class="prestasi-header site-header app-navbar sticky top-0 z-40">
            <div class="navbar-inner mx-auto flex max-w-7xl items-center justify-between gap-2 px-4 py-4 lg:px-8">
                <div class="header-left flex min-w-0 items-center gap-2 lg:gap-3">
                    <div class="header-brand">
                        <img src="{{ asset('images/logo-upt-sdn-kragan.png') }}" alt="Logo SDN Kragan" class="school-logo-img school-logo-img--small" />
                        <div class="header-brand-copy">
                            <p class="brand-title text-[1.45rem] font-semibold leading-none text-slate-900">SDN Kragan</p>
                            <p class="brand-subtitle mt-1 text-xs text-slate-500">Detail Prestasi</p>
                        </div>
                    </div>

                    <nav class="nav-list hidden items-center gap-2 lg:flex">
                        <a href="{{ url('/') }}#beranda" class="nav-chip">Beranda</a>
                        <a href="{{ url('/prestasi') }}" class="nav-chip is-active">Prestasi</a>
                        <a href="{{ url('/kontak') }}" class="nav-chip">Kontak</a>
                    </nav>
                </div>

                <div class="header-actions flex items-center gap-2">
                    <a href="{{ route('prestasi.index') }}" class="top-login-btn hidden lg:inline-flex lg:px-6">Kembali ke Prestasi</a>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-5xl px-6 py-10 lg:px-8 lg:py-12">
            <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-lg">
                <div class="relative">
                    <img src="{{ $achievement->image_url ? (str_starts_with($achievement->image_url, 'http') ? $achievement->image_url : asset($achievement->image_url)) : 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=1400&q=80' }}" alt="{{ $achievement->title }}" class="h-[240px] w-full object-cover md:h-[360px]" />
                    <div class="absolute left-4 top-4 inline-flex items-center gap-2 rounded-full bg-black/60 px-3 py-1 text-xs font-semibold text-white backdrop-blur-sm">
                        <span>{{ $achievement->category }}</span>
                        <span>•</span>
                        <span>{{ $achievement->year }}</span>
                    </div>
                </div>

                <div class="p-6 md:p-9">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-red-600">Detail Prestasi</p>
                    <h1 class="mt-3 text-3xl font-bold leading-tight text-slate-900 md:text-4xl">{{ $achievement->title }}</h1>
                    <p class="mt-6 text-base leading-8 text-slate-700">{{ $achievement->description }}</p>

                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        <a href="{{ route('prestasi.index') }}" class="inline-flex items-center rounded-xl bg-[#c20f1a] px-5 py-3 text-sm font-semibold text-white transition hover:opacity-95">Kembali ke Daftar</a>
                    </div>
                </div>
            </article>

            @if($relatedAchievements->isNotEmpty())
                <section class="mt-10">
                    <h2 class="text-xl font-semibold text-slate-900">Prestasi Lainnya</h2>
                    <div class="mt-4 grid gap-4 md:grid-cols-2">
                        @foreach ($relatedAchievements as $related)
                            <a href="{{ route('prestasi.show', $related) }}" class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-red-600">{{ $related->category }} • {{ $related->year }}</p>
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