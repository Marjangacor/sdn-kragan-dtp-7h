<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Prestasi | SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="prestasi-page school-page bg-slate-100 text-slate-900">
        @php
            $highlights = collect([
                ['label' => 'Juara Umum', 'value' => '12'],
                ['label' => 'Prestasi Akademik', 'value' => '28'],
                ['label' => 'Prestasi Nonakademik', 'value' => '19'],
            ]);

            $journey = collect([
                'Pembinaan rutin oleh guru pembimbing',
                'Latihan disiplin sebelum kompetisi',
                'Pendampingan mental dan karakter sportif',
                'Apresiasi untuk setiap proses dan hasil',
            ]);

            $showcase = collect([
                [
                    'title' => 'Piala Utama',
                    'desc' => 'Pencapaian sekolah dalam lomba tingkat kecamatan dan kabupaten.',
                ],
                [
                    'title' => 'Siswa Berprestasi',
                    'desc' => 'Siswa yang aktif dalam akademik, seni, dan olahraga.',
                ],
                [
                    'title' => 'Budaya Juara',
                    'desc' => 'Kebiasaan belajar, berlatih, dan bertanggung jawab yang terus dibangun.',
                ],
                [
                    'title' => 'Kolaborasi Sekolah',
                    'desc' => 'Dukungan guru, orang tua, dan siswa dalam setiap kegiatan lomba.',
                ],
            ]);
        @endphp

        <header class="prestasi-header site-header app-navbar sticky top-0 z-40">
            <div class="navbar-inner mx-auto flex max-w-7xl items-center justify-between gap-2 px-4 py-4 lg:px-8">
                <div class="header-left flex min-w-0 items-center gap-2 lg:gap-3">
                    <div class="header-brand">
                        <img src="{{ asset('images/logo-upt-sdn-kragan.png') }}" alt="Logo SDN Kragan" class="school-logo-img school-logo-img--small" />
                        <div class="header-brand-copy">
                            <p class="brand-title text-[1.45rem] font-semibold leading-none text-slate-900">SDN Kragan</p>
                            <p class="brand-subtitle mt-1 text-xs text-slate-500">Prestasi</p>
                        </div>
                    </div>

                    <nav class="nav-list hidden items-center gap-2 lg:flex">
                        <a href="{{ url('/') }}#beranda" class="nav-chip">Beranda</a>
                        <a href="{{ url('/') }}#tentang" class="nav-chip">Profil</a>
                        <a href="{{ url('/guru') }}" class="nav-chip">Guru & Karyawan</a>
                        <a href="{{ url('/prestasi') }}" class="nav-chip is-active">Prestasi</a>
                        <a href="{{ url('/galeri') }}" class="nav-chip">Galeri</a>
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

        <main>
            <section class="prestasi-hero relative overflow-hidden text-white">
                <div class="prestasi-noise" aria-hidden="true"></div>
                <div class="prestasi-orb prestasi-orb-1" aria-hidden="true"></div>
                <div class="prestasi-orb prestasi-orb-2" aria-hidden="true"></div>

                <div class="relative mx-auto grid max-w-7xl gap-10 px-6 py-12 lg:grid-cols-[1.05fr_0.95fr] lg:px-8 lg:py-14">
                    <div class="space-y-5">
                        <p class="prestasi-kicker reveal">Jejak Keberhasilan</p>
                        <div class="space-y-4 reveal" style="--reveal-delay: 90ms">
                            <h1 class="prestasi-title">Prestasi Siswa SDN Kragan</h1>
                            <p class="prestasi-description">Setiap pencapaian lahir dari proses belajar, latihan, dan kerja sama yang konsisten. Halaman ini merangkum prestasi yang dibangun dengan semangat positif dan kebanggaan sekolah.</p>
                        </div>

                        <div class="prestasi-stats-grid reveal" style="--reveal-delay: 180ms">
                            @foreach ($highlights as $item)
                                <article class="prestasi-stat-card js-card" data-prestasi-card>
                                    <p class="prestasi-stat-number"><span data-counter="{{ $item['value'] }}">0</span>+</p>
                                    <p class="prestasi-stat-label">{{ $item['label'] }}</p>
                                </article>
                            @endforeach
                        </div>
                    </div>

                    <div class="reveal" style="--reveal-delay: 160ms">
                        <div class="prestasi-hero-card js-card">
                            <img src="https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=1200&q=80" alt="Siswa menerima piala prestasi" class="h-full w-full object-cover" />
                            <div class="prestasi-hero-card-overlay">
                                <p>Prestasi dibangun dari proses yang disiplin dan dukungan yang berkelanjutan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 py-8 lg:px-8 lg:py-10">
                <div class="prestasi-highlight-grid">
                    <article class="prestasi-info-card" data-prestasi-fade>
                        <p class="prestasi-info-kicker">Perjalanan Prestasi</p>
                        <h2>Langkah yang membentuk hasil</h2>
                        <ul class="prestasi-list">
                            @foreach ($journey as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </article>
                    <article class="prestasi-info-card prestasi-info-card-accent" data-prestasi-fade>
                        <p class="prestasi-info-kicker">Fokus Pengembangan</p>
                        <h2>Aspek yang terus diperkuat</h2>
                        <div class="prestasi-chip-wrap">
                            @foreach ($showcase as $item)
                                <div class="prestasi-mini-card js-card" data-prestasi-card>
                                    <strong>{{ $item['title'] }}</strong>
                                    <span>{{ $item['desc'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </article>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 py-10 lg:px-8 lg:py-12">
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="prestasi-info-kicker">Daftar Prestasi</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-900">Pencapaian yang telah diraih</h2>
                    </div>
                    <p class="max-w-2xl text-sm leading-7 text-slate-600">Semua kartu di bawah ini tampil dengan animasi masuk bertahap agar halaman terasa hidup tanpa berlebihan.</p>
                </div>

                <div class="prestasi-grid">
                    @foreach ($achievements as $item)
                        <article class="prestasi-card js-card" data-prestasi-card data-category="{{ $item['category'] }}">
                            <div class="prestasi-card-head">
                                <span class="prestasi-badge">{{ $item['category'] }}</span>
                                <span class="prestasi-year">{{ $item['year'] }}</span>
                            </div>
                            <div class="mb-4 overflow-hidden rounded-2xl">
                                <img src="{{ $item['image_url'] ? (str_starts_with($item['image_url'], 'http') ? $item['image_url'] : asset($item['image_url'])) : 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $item['title'] }}" class="h-44 w-full object-cover" loading="lazy" />
                            </div>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit($item['description'], 120) }}</p>
                            <a href="{{ route('prestasi.show', $item) }}" class="mt-4 inline-flex items-center rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 transition hover:bg-red-100">Lihat Detail</a>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 py-10 lg:px-8 lg:py-12">
                <div class="prestasi-cta-box" data-prestasi-fade>
                    <div>
                        <p class="prestasi-info-kicker text-red-100">Apresiasi Sekolah</p>
                        <h3>Prestasi adalah hasil dari kerja sama dan pembinaan yang konsisten</h3>
                        <p>Kami terus membuka ruang bagi siswa untuk berkembang di bidang akademik, seni, olahraga, dan karakter.</p>
                    </div>
                    <a href="{{ url('/') }}#kontak" class="prestasi-cta-link">Hubungi Sekolah</a>
                </div>
            </section>
        </main>

        <button id="accessibilityToggle" class="acc-toggle-btn" type="button" aria-label="Buka aksesibilitas" aria-expanded="false" aria-controls="accessibilityPanel">
            <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" aria-hidden="true">
                <path d="M12 4.5C10.4812 4.5 9.25 5.73122 9.25 7.25C9.25 8.76878 10.4812 10 12 10C13.5188 10 14.75 8.76878 14.75 7.25C14.75 5.73122 13.5188 4.5 12 4.5Z" stroke="currentColor" stroke-width="1.7" />
                <path d="M6.5 12.5H17.5M8.8 12.5L7.2 19.5M15.2 12.5L16.8 19.5M12 10.5V19.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
            </svg>
        </button>

        <aside id="accessibilityPanel" class="acc-panel" aria-hidden="true">
            <div class="acc-panel-header">
                <button id="accessibilityClose" class="acc-icon-btn" type="button" aria-label="Tutup panel">
                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" aria-hidden="true"><path d="M6 6L18 18M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" /></svg>
                </button>
                <h3>Aksesibilitas</h3>
                <button id="accessibilityReset" class="acc-icon-btn" type="button" aria-label="Reset pengaturan">
                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" aria-hidden="true"><path d="M20 12C20 16.4183 16.4183 20 12 20C7.58172 20 4 16.4183 4 12C4 7.58172 7.58172 4 12 4C14.6344 4 16.9712 5.27366 18.429 7.2376M18.429 7.2376V4.5M18.429 7.2376H15.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" /></svg>
                </button>
            </div>

            <div class="acc-list">
                <button class="acc-item" type="button" data-acc-action="text-increase"><span class="acc-item-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M4 19H10M7 19V7M17 8V16M13 12H21" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" /></svg></span><span>Perbesar Teks</span></button>
                <button class="acc-item" type="button" data-acc-action="text-decrease"><span class="acc-item-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M4 19H10M7 19V7M13 12H21" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" /></svg></span><span>Perkecil Teks</span></button>
                <button class="acc-item" type="button" data-acc-action="letter-increase"><span class="acc-item-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M4 17L7.5 7L11 17M5.5 13H9.5M14 8H20M17 5V11" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" /></svg></span><span>Tambah Jarak Teks</span></button>
                <button class="acc-item" type="button" data-acc-action="letter-decrease"><span class="acc-item-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M4 17L7.5 7L11 17M5.5 13H9.5M14 8H20" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" /></svg></span><span>Kurangi Jarak Teks</span></button>
                <button class="acc-item" type="button" data-acc-action="line-increase"><span class="acc-item-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M4 7H12M4 17H12M16 12H22M19 9V15" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" /></svg></span><span>Tambah Tinggi Teks</span></button>
                <button class="acc-item" type="button" data-acc-action="line-decrease"><span class="acc-item-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M4 7H12M4 17H12M16 12H22" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" /></svg></span><span>Kurangi Tinggi Teks</span></button>
                <button class="acc-item" type="button" data-acc-action="invert"><span class="acc-item-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20V4Z" fill="currentColor" /><path d="M12 4C16.4183 4 20 7.58172 20 12C20 16.4183 16.4183 20 12 20" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" /></svg></span><span>Balik Warna</span></button>
                <button class="acc-item" type="button" data-acc-action="grayscale"><span class="acc-item-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M4 7.5L8 4L12 7.5L16 4L20 7.5V16.5L16 20L12 16.5L8 20L4 16.5V7.5Z" stroke="currentColor" stroke-width="1.9" stroke-linejoin="round" /></svg></span><span>Warna Abu-Abu</span></button>
                <button class="acc-item" type="button" data-acc-action="underline"><span class="acc-item-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M7 6V11C7 13.7614 9.23858 16 12 16C14.7614 16 17 13.7614 17 11V6M6 19H18" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" /></svg></span><span>Garis Bawahi Teks</span></button>
                <button class="acc-item" type="button" data-acc-action="big-cursor"><span class="acc-item-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M5 4L14 12L10 12.8L12.5 19L9.5 20L7 13.8L4.8 16.5L5 4Z" stroke="currentColor" stroke-width="1.9" stroke-linejoin="round" /></svg></span><span>Perbesar Kursor</span></button>
                <button class="acc-item" type="button" data-acc-action="reading-guide"><span class="acc-item-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M4 7H20M4 12H20M4 17H14" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" /></svg></span><span>Alat Bantu Baca</span></button>
                <button class="acc-item" type="button" data-acc-action="reduce-motion"><span class="acc-item-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M12 4C16.4183 4 20 7.58172 20 12C20 16.4183 16.4183 20 12 20C7.58172 20 4 16.4183 4 12C4 7.58172 7.58172 4 12 4ZM6 18L18 6" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" /></svg></span><span>Matikan Animasi</span></button>
            </div>
        </aside>

        <div id="readingGuide" class="reading-guide" aria-hidden="true"></div>
    </body>
</html>
