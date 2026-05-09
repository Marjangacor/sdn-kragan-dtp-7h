<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Galeri Kegiatan | SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="galeri-page school-page bg-slate-100 text-slate-900">
        @php
            $galleryItems = $galleryItems ?? collect();

            if ($galleryItems->isEmpty()) {
                $galleryItems = collect([
                    [
                        'title' => 'Upacara Bendera',
                        'category' => 'Kegiatan Rutin',
                        'description' => 'Dokumentasi kegiatan rutin sekolah untuk membangun disiplin dan rasa cinta tanah air.',
                        'image_url' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=900&q=80',
                        'event_date' => null,
                    ],
                    [
                        'title' => 'Pembelajaran di Kelas',
                        'category' => 'Belajar',
                        'description' => 'Suasana belajar yang aktif, interaktif, dan menyenangkan di ruang kelas.',
                        'image_url' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=80',
                        'event_date' => null,
                    ],
                    [
                        'title' => 'Lomba Siswa',
                        'category' => 'Prestasi',
                        'description' => 'Momen siswa tampil percaya diri dalam berbagai ajang lomba akademik dan nonakademik.',
                        'image_url' => 'https://images.unsplash.com/photo-1527600478564-488952effedb?auto=format&fit=crop&w=900&q=80',
                        'event_date' => null,
                    ],
                    [
                        'title' => 'Kegiatan Seni',
                        'category' => 'Seni & Kreasi',
                        'description' => 'Ekspresi bakat siswa melalui seni, kreasi, dan pentas di sekolah.',
                        'image_url' => 'https://images.unsplash.com/photo-1452587925148-ce544e77e70d?auto=format&fit=crop&w=900&q=80',
                        'event_date' => null,
                    ],
                    [
                        'title' => 'Kerja Bakti',
                        'category' => 'Kepedulian',
                        'description' => 'Gotong royong membersihkan dan merawat lingkungan sekolah bersama.',
                        'image_url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&q=80',
                        'event_date' => null,
                    ],
                    [
                        'title' => 'Kegiatan Bersama Orang Tua',
                        'category' => 'Kolaborasi',
                        'description' => 'Kolaborasi sekolah dan wali murid dalam mendukung tumbuh kembang siswa.',
                        'image_url' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=900&q=80',
                        'event_date' => null,
                    ],
                ]);
            }

            $highlights = collect([
                ['label' => 'Dokumentasi', 'value' => (string) $galleryItems->count()],
                ['label' => 'Kategori Kegiatan', 'value' => (string) $galleryItems->pluck('category')->unique()->count()],
                ['label' => 'Momen Kebersamaan', 'value' => (string) max($galleryItems->count() * 4, 24)],
            ]);
        @endphp

        <header class="site-header app-navbar sticky top-0 z-40">
            <div class="navbar-inner mx-auto flex max-w-7xl items-center justify-between gap-2 px-4 py-4 lg:px-8">
                <div class="header-left flex min-w-0 items-center gap-2 lg:gap-3">
                    <div class="header-brand">
                        <img src="{{ asset('images/logo-upt-sdn-kragan.png') }}" alt="Logo SDN Kragan" class="school-logo-img school-logo-img--small" />
                        <div class="header-brand-copy">
                            <p class="brand-title text-[1.45rem] font-semibold leading-none text-slate-900">SDN Kragan</p>
                            <p class="brand-subtitle mt-1 text-xs text-slate-500">Galeri Kegiatan</p>
                        </div>
                    </div>

                    <nav class="nav-list hidden items-center gap-2 lg:flex">
                        <a href="{{ url('/') }}#beranda" class="nav-chip">Beranda</a>
                        <a href="{{ url('/') }}#tentang" class="nav-chip">Profil</a>
                        <a href="{{ url('/guru') }}" class="nav-chip">Guru & Karyawan</a>
                        <a href="{{ url('/prestasi') }}" class="nav-chip">Prestasi</a>
                        <a href="{{ url('/galeri') }}" class="nav-chip is-active">Galeri</a>
                        <a href="{{ url('/ekstra') }}" class="nav-chip">Ekstrakurikuler</a>
                        <a href="{{ url('/kritik-saran') }}" class="nav-chip">Kritik & Saran</a>
                        <a href="{{ url('/kontak') }}" class="nav-chip">Kontak</a>
                    </nav>
                </div>

                <div class="header-actions flex items-center gap-2">
                    @if (Route::has('login'))
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ url('/dashboard') }}" class="top-login-btn hidden lg:inline-flex lg:px-6">Dashboard</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="hidden lg:inline-flex">
                                @csrf
                                <button type="submit" class="top-login-btn lg:px-6">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="top-login-btn hidden lg:inline-flex lg:px-6">Login</a>
                        @endauth
                    @endif
                    <button id="menuToggle" class="inline-flex h-11 w-11 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-700 lg:hidden" aria-label="Buka menu">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" class="h-6 w-6 stroke-current">
                            <path d="M4 7H20M4 12H20M4 17H20" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="mobileMenu" class="hidden border-t border-slate-200 bg-white px-4 py-3 lg:hidden">
                <div class="grid gap-2 text-sm font-medium text-slate-700">
                    <a href="{{ url('/') }}#beranda" class="rounded-lg px-3 py-2 hover:bg-slate-100">Beranda</a>
                    <a href="{{ url('/') }}#tentang" class="rounded-lg px-3 py-2 hover:bg-slate-100">Profil</a>
                    <a href="{{ url('/guru') }}" class="rounded-lg px-3 py-2 hover:bg-slate-100">Guru & Karyawan</a>
                    <a href="{{ url('/prestasi') }}" class="rounded-lg px-3 py-2 hover:bg-slate-100">Prestasi</a>
                    <a href="{{ url('/galeri') }}" class="rounded-lg px-3 py-2 hover:bg-slate-100">Galeri</a>
                    <a href="{{ url('/ekstra') }}" class="rounded-lg px-3 py-2 hover:bg-slate-100">Ekstrakurikuler</a>
                    <a href="{{ url('/kritik-saran') }}" class="rounded-lg px-3 py-2 hover:bg-slate-100">Kritik & Saran</a>
                    <a href="{{ url('/kontak') }}" class="rounded-lg px-3 py-2 hover:bg-slate-100">Kontak</a>
                    @auth
                        <hr class="my-2 border-slate-200" />
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ url('/dashboard') }}" class="rounded-lg px-3 py-2 hover:bg-slate-100">Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full rounded-lg px-3 py-2 text-left text-red-600 hover:bg-red-50 font-medium">Logout</button>
                        </form>
                    @else
                        <hr class="my-2 border-slate-200" />
                        <a href="{{ route('login') }}" class="rounded-lg px-3 py-2 hover:bg-slate-100">Login</a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="galeri-page">
            <section class="galeri-hero relative overflow-hidden text-white">
                <div class="galeri-noise" aria-hidden="true"></div>
                <div class="galeri-orb galeri-orb-1" aria-hidden="true"></div>
                <div class="galeri-orb galeri-orb-2" aria-hidden="true"></div>

                <div class="relative mx-auto grid max-w-7xl gap-10 px-6 py-12 lg:grid-cols-[1.05fr_0.95fr] lg:px-8 lg:py-14">
                    <div class="space-y-5">
                        <p class="galeri-kicker reveal">Dokumentasi Sekolah</p>
                        <div class="space-y-4 reveal" style="--reveal-delay: 90ms">
                            <h1 class="galeri-title">Galeri Kegiatan SDN Kragan</h1>
                            <p class="galeri-description">Kumpulan foto dokumentasi kegiatan sekolah, mulai dari pembelajaran, upacara, seni, lomba, hingga kebersamaan warga sekolah. Setiap foto merekam proses tumbuh bersama di lingkungan yang aktif dan positif.</p>
                        </div>

                        <div class="galeri-stats-grid reveal" style="--reveal-delay: 180ms">
                            @foreach ($highlights as $item)
                                <article class="galeri-stat-card js-card" data-galeri-card>
                                    <p class="galeri-stat-number"><span data-counter="{{ data_get($item, 'value') }}">0</span>+</p>
                                    <p class="galeri-stat-label">{{ data_get($item, 'label') }}</p>
                                </article>
                            @endforeach
                        </div>
                    </div>

                    <div class="reveal" style="--reveal-delay: 160ms">
                        <div class="galeri-hero-card js-card">
                            <img src="https://images.unsplash.com/photo-1497486751825-1233686d5d80?auto=format&fit=crop&w=1200&q=80" alt="Siswa dan kegiatan sekolah" class="h-full w-full object-cover" />
                            <div class="galeri-hero-card-overlay">
                                <p>Setiap momen terdokumentasi untuk menghidupkan kembali semangat kegiatan sekolah.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 py-8 lg:px-8 lg:py-10">
                <div class="galeri-highlight-grid">
                    <article class="galeri-info-card" data-galeri-fade>
                        <p class="galeri-info-kicker">Ragam Kegiatan</p>
                        <h2>Foto dokumentasi yang mewakili suasana sekolah</h2>
                        <ul class="galeri-list">
                            <li>Upacara dan kegiatan rutin sekolah</li>
                            <li>Pembelajaran aktif di kelas</li>
                            <li>Kegiatan lomba, seni, dan kreasi siswa</li>
                            <li>Kerja bakti dan kolaborasi warga sekolah</li>
                        </ul>
                    </article>
                    <article class="galeri-info-card galeri-info-card-accent" data-galeri-fade>
                        <p class="galeri-info-kicker">Sorotan Utama</p>
                        <h2>Momen yang paling sering terdokumentasi</h2>
                        <div class="galeri-chip-wrap">
                            <span class="galeri-chip">Pembelajaran</span>
                            <span class="galeri-chip">Upacara</span>
                            <span class="galeri-chip">Seni & Lomba</span>
                            <span class="galeri-chip">Gotong Royong</span>
                            <span class="galeri-chip">Kolaborasi</span>
                        </div>
                    </article>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 py-10 lg:px-8 lg:py-12">
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="galeri-info-kicker">Album Kegiatan</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-900">Dokumentasi foto sekolah</h2>
                    </div>
                    <p class="max-w-2xl text-sm leading-7 text-slate-600">Galeri dibuat dalam format kartu foto agar mudah dipindai di desktop maupun mobile, tanpa mengorbankan tampilan visual.</p>
                </div>

                <div class="galeri-grid">
                    @foreach ($galleryItems as $item)
                        <article class="galeri-card js-card" data-galeri-card>
                            <div class="galeri-image-wrap">
                                <img src="{{ data_get($item, 'image_url') }}" alt="{{ data_get($item, 'title') }}" class="galeri-image" />
                                <span class="galeri-badge">{{ data_get($item, 'category') }}</span>
                            </div>
                            <div class="galeri-card-body">
                                <h3>{{ data_get($item, 'title') }}</h3>
                                <p>{{ data_get($item, 'description') }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 py-10 lg:px-8 lg:py-12">
                <div class="galeri-cta-box" data-galeri-fade>
                    <div>
                        <p class="galeri-info-kicker text-red-100">Galeri Sekolah</p>
                        <h3>Dokumentasi kegiatan membantu sekolah bercerita lewat gambar</h3>
                        <p>Kalau kamu punya foto kegiatan baru, halaman ini bisa dikembangkan lagi menjadi album yang lebih lengkap dan terurut per agenda.</p>
                    </div>
                    <a href="{{ url('/kontak') }}" class="galeri-cta-link">Hubungi Sekolah</a>
                </div>
            </section>
        </main>
    </body>
</html>