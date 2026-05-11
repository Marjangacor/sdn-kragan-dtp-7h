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
                        <a href="{{ url('/guru') }}" class="nav-chip">Guru & Karyawan</a>
                        <a href="{{ url('/prestasi') }}" class="nav-chip">Prestasi</a>
                        <a href="{{ url('/galeri') }}" class="nav-chip is-active">Galeri</a>
                        <a href="{{ url('/ekstra') }}" class="nav-chip">Ekstrakurikuler</a>
                        <a href="{{ url('/kritik-saran') }}" class="nav-chip">Kritik & Saran</a>
                        <a href="{{ url('/kontak') }}" class="nav-chip">Kontak</a>
                    </nav>
                </div>

                <div class="header-actions flex items-center gap-3">
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
            <section class="mx-auto max-w-7xl px-6 pt-8 lg:px-8 lg:pt-10">
                <div class="galeri-intro-card">
                    <p class="galeri-intro-kicker">Galeri Kegiatan</p>
                    <h1>Cerita Kegiatan SDN Kragan</h1>
                    <p>Di sini kamu bisa melihat berbagai momen sekolah, dari belajar di kelas sampai kegiatan kebersamaan. Klik foto mana saja untuk membuka detail kegiatan secara lengkap.</p>
                    <div class="galeri-intro-points">
                        <span>Foto terbaru</span>
                        <span>Informasi ringkas</span>
                        <span>Detail bisa dibuka</span>
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 py-10 lg:px-8 lg:py-12">
                <div class="galeri-album-header mb-8">
                    <div>
                        <p class="galeri-info-kicker galeri-album-kicker">Album Kegiatan</p>
                        <h2 class="galeri-album-title mt-3">Momen Sekolah Dalam Foto</h2>
                    </div>
                </div>

                <div class="galeri-grid">
                    @foreach ($galleryItems as $item)
                        @php
                            $eventDate = data_get($item, 'event_date');
                            $formattedDate = $eventDate ? \Illuminate\Support\Carbon::parse($eventDate)->translatedFormat('d F Y') : 'Tanggal belum ditentukan';
                        @endphp
                        <button
                            type="button"
                            class="galeri-card js-card galeri-detail-trigger"
                            data-galeri-card
                            data-title="{{ data_get($item, 'title') }}"
                            data-category="{{ data_get($item, 'category') }}"
                            data-description="{{ data_get($item, 'description') }}"
                            data-image="{{ data_get($item, 'image_url') }}"
                            data-date="{{ $formattedDate }}"
                        >
                            <div class="galeri-image-wrap">
                                <img src="{{ data_get($item, 'image_url') }}" alt="{{ data_get($item, 'title') }}" class="galeri-image" />
                                <span class="galeri-badge">{{ data_get($item, 'category') }}</span>
                            </div>
                            <div class="galeri-card-body">
                                <div class="galeri-card-meta">
                                    <span>{{ data_get($item, 'category') }}</span>
                                    <span>{{ $formattedDate }}</span>
                                </div>
                                <h3>{{ data_get($item, 'title') }}</h3>
                                <p>{{ data_get($item, 'description') }}</p>
                                <span class="galeri-detail-hint">Lihat detail kegiatan</span>
                            </div>
                        </button>
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
                    <a href="https://wa.me/62318913900?text=Halo%20Admin%20SDN%20Kragan,%20saya%20ingin%20menghubungi%20sekolah." class="galeri-cta-link" target="_blank" rel="noopener noreferrer">Hubungi Sekolah</a>
                </div>
            </section>

            <div id="galeriDetailModal" class="galeri-modal" aria-hidden="true">
                <div class="galeri-modal-backdrop" data-galeri-modal-close></div>
                <div class="galeri-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="galeriModalTitle">
                    <button type="button" class="galeri-modal-close" data-galeri-modal-close aria-label="Tutup detail galeri">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="galeri-modal-media-wrap">
                        <img id="galeriModalImage" src="" alt="" class="galeri-modal-image" />
                    </div>
                    <div class="galeri-modal-content">
                        <p id="galeriModalCategory" class="galeri-modal-category"></p>
                        <h3 id="galeriModalTitle" class="galeri-modal-title"></h3>
                        <p id="galeriModalDate" class="galeri-modal-date"></p>
                        <p id="galeriModalDescription" class="galeri-modal-description"></p>
                    </div>
                </div>
            </div>
        </main>

        <footer id="kontak" class="footer-wrap text-slate-200">
            <div class="mx-auto grid max-w-7xl gap-8 px-6 py-12 lg:grid-cols-[1.1fr_0.9fr] lg:px-8">
                <div class="space-y-5 reveal js-card">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-upt-sdn-kragan.png') }}" alt="Logo SDN Kragan" class="school-logo-img school-logo-img--footer" />
                        <div>
                            <p class="text-base font-semibold text-white">SDN Kragan</p>
                            <p class="text-xs text-blue-100/80">Galeri Kegiatan Sekolah</p>
                        </div>
                    </div>
                    <p class="max-w-md text-sm leading-7 text-blue-100/80">Dokumentasi kegiatan sekolah sebagai media informasi dan arsip visual untuk siswa, orang tua, dan masyarakat.</p>
                </div>
                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="reveal js-card" style="--reveal-delay: 80ms">
                        <h3 class="text-sm font-semibold text-white">Tautan Cepat</h3>
                        <ul class="space-y-3 text-slate-600 list-disc pl-5 marker:text-white-600">
                            <!-- Profil Sekolah link removed -->
                            <li><a href="{{ route('guru.index') }}" class="hover:text-white">Guru & Karyawan</a></li>
                            <li><a href="{{ route('prestasi.index') }}" class="hover:text-white">Prestasi</a></li>
                            <li><a href="{{ route('ekstra.index') }}" class="hover:text-white">Ekstrakurikuler</a></li>
                        </ul>
                    </div>
                    <div class="reveal js-card" style="--reveal-delay: 160ms">
                        <h3 class="text-sm font-semibold text-white">Kontak</h3>
                        <div class="mt-3 space-y-2 text-sm text-blue-100/80">
                            <p>Jl. Pendidikan No. 12, Kragan, Rembang</p>
                            <p>(0298) 123-456</p>
                            <p>info@sdnkragan.sch.id</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/15 py-4 text-center text-xs text-blue-100/70">© 2026 SDN Kragan. All rights reserved.</div>
        </footer>

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