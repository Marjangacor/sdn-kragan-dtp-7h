<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Ekstrakurikuler | SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="ekstra-page school-page bg-slate-100 text-slate-900">
        @php
            $activities = collect([
                [
                    'title' => 'Pramuka',
                    'category' => 'Kepemimpinan',
                    'desc' => 'Melatih disiplin, kerja sama, dan kemandirian melalui kegiatan lapangan yang menyenangkan.',
                    'photo' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=900&q=80',
                ],
                [
                    'title' => 'Paduan Suara',
                    'category' => 'Seni & Budaya',
                    'desc' => 'Mengasah rasa percaya diri, kekompakan, dan kepekaan musikal siswa.',
                    'photo' => 'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?auto=format&fit=crop&w=900&q=80',
                ],
                [
                    'title' => 'Futsal',
                    'category' => 'Olahraga',
                    'desc' => 'Menumbuhkan sportivitas, kebugaran, dan semangat kerja tim dalam olahraga.',
                    'photo' => 'https://images.unsplash.com/photo-1517927033932-b3d18e61fb3a?auto=format&fit=crop&w=900&q=80',
                ],
                [
                    'title' => 'Tari Tradisional',
                    'category' => 'Seni & Budaya',
                    'desc' => 'Mengenalkan kearifan lokal sekaligus melatih keanggunan gerak dan ekspresi.',
                    'photo' => 'https://images.unsplash.com/photo-1508804185872-d7badad00f7d?auto=format&fit=crop&w=900&q=80',
                ],
                [
                    'title' => 'Sains Club',
                    'category' => 'Akademik',
                    'desc' => 'Eksperimen sederhana dan proyek sains untuk memupuk rasa ingin tahu siswa.',
                    'photo' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=900&q=80',
                ],
                [
                    'title' => 'Literasi & Menulis',
                    'category' => 'Akademik',
                    'desc' => 'Mendorong kebiasaan membaca, menulis, dan menyampaikan gagasan secara percaya diri.',
                    'photo' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=900&q=80',
                ],
            ]);

            $activityCount = $activities->count();
            $categoryCount = $activities->pluck('category')->unique()->count();
            $studentCount = 500;
        @endphp

        <header class="ekstra-header sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 lg:px-8">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-upt-sdn-kragan.png') }}" alt="Logo SDN Kragan" class="school-logo-img school-logo-img--medium" />
                    <div>
                        <p class="text-lg font-semibold leading-tight text-slate-900">SDN Kragan</p>
                        <p class="text-sm text-slate-500">Ekstrakurikuler</p>
                    </div>
                </div>
                <nav class="nav-list hidden items-center gap-2 lg:flex">
                    <a href="{{ url('/') }}#beranda" class="nav-chip">Beranda</a>
                    <a href="{{ url('/') }}#tentang" class="nav-chip">Profil</a>
                    <a href="{{ url('/guru') }}" class="nav-chip">Guru & Karyawan</a>
                    <a href="{{ url('/prestasi') }}" class="nav-chip">Prestasi</a>
                    <a href="{{ url('/ekstra') }}" class="nav-chip is-active">Ekstrakurikuler</a>
                    <a href="{{ url('/kritik-saran') }}" class="nav-chip">Kritik & Saran</a>
                    <a href="{{ url('/kontak') }}" class="nav-chip">Kontak</a>
                </nav>
            </div>
        </header>

        <main>
            <section class="ekstra-hero relative overflow-hidden text-white">
                <div class="ekstra-noise" aria-hidden="true"></div>
                <div class="ekstra-orb ekstra-orb-1" aria-hidden="true"></div>
                <div class="ekstra-orb ekstra-orb-2" aria-hidden="true"></div>

                <div class="relative mx-auto grid max-w-7xl gap-10 px-6 py-12 lg:grid-cols-[1.08fr_0.92fr] lg:px-8 lg:py-14">
                    <div class="space-y-5">
                        <p class="ekstra-kicker reveal">Profil Kegiatan Sekolah</p>
                        <div class="space-y-4 reveal" style="--reveal-delay: 90ms">
                            <h1 class="ekstra-title">Ekstrakurikuler SDN Kragan</h1>
                            <p class="ekstra-description">Kegiatan tambahan yang dirancang untuk mengembangkan bakat, minat, karakter, dan kepercayaan diri siswa di luar jam pelajaran inti.</p>
                        </div>

                        <div class="ekstra-stats-grid reveal" style="--reveal-delay: 180ms">
                            <article class="ekstra-stat-card js-card">
                                <p class="ekstra-stat-number"><span data-counter="{{ $activityCount }}">0</span>+</p>
                                <p class="ekstra-stat-label">Jenis Kegiatan</p>
                            </article>
                            <article class="ekstra-stat-card js-card">
                                <p class="ekstra-stat-number"><span data-counter="{{ $categoryCount }}">0</span>+</p>
                                <p class="ekstra-stat-label">Kategori Program</p>
                            </article>
                            <article class="ekstra-stat-card js-card">
                                <p class="ekstra-stat-number"><span data-counter="{{ $studentCount }}">0</span>+</p>
                                <p class="ekstra-stat-label">Potensi Siswa</p>
                            </article>
                        </div>
                    </div>

                    <div class="reveal" style="--reveal-delay: 160ms">
                        <div class="ekstra-hero-card js-card">
                            <img src="https://images.unsplash.com/photo-1523049673857-eb18f1d7b578?auto=format&fit=crop&w=1200&q=80" alt="Siswa mengikuti kegiatan ekstrakurikuler" class="h-full w-full object-cover" />
                            <div class="ekstra-hero-card-overlay">
                                <p>Aktif, kreatif, dan berkarakter</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 py-8 lg:px-8 lg:py-10">
                <div class="ekstra-highlight-grid">
                    <article class="ekstra-info-card" data-ekstra-fade>
                        <p class="ekstra-info-kicker">Tujuan Kegiatan</p>
                        <h2>Membangun minat, bakat, dan kebiasaan positif</h2>
                        <p>Ekstrakurikuler di SDN Kragan bukan sekadar tambahan, tetapi ruang belajar yang membantu siswa menemukan potensi diri dan tumbuh lebih percaya diri.</p>
                    </article>
                    <article class="ekstra-info-card ekstra-info-card-accent" data-ekstra-fade>
                        <p class="ekstra-info-kicker">Manfaat Utama</p>
                        <h2>Belajar bekerja sama dan bertanggung jawab</h2>
                        <p>Kegiatan rutin ini membentuk karakter yang kuat, melatih kepemimpinan, serta membuat siswa lebih aktif dan berani tampil di depan umum.</p>
                    </article>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 py-10 lg:px-8 lg:py-12">
                <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <p class="ekstra-info-kicker">Daftar Kegiatan</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-900">Pilihan Ekstrakurikuler SDN Kragan</h2>
                    </div>
                    <div class="ekstra-filter-wrap" role="tablist" aria-label="Filter ekstrakurikuler">
                        <button type="button" class="ekstra-filter-btn is-active" data-ekstra-filter="all" role="tab" aria-selected="true">Semua</button>
                        <button type="button" class="ekstra-filter-btn" data-ekstra-filter="Akademik" role="tab" aria-selected="false">Akademik</button>
                        <button type="button" class="ekstra-filter-btn" data-ekstra-filter="Olahraga" role="tab" aria-selected="false">Olahraga</button>
                        <button type="button" class="ekstra-filter-btn" data-ekstra-filter="Seni & Budaya" role="tab" aria-selected="false">Seni & Budaya</button>
                        <button type="button" class="ekstra-filter-btn" data-ekstra-filter="Kepemimpinan" role="tab" aria-selected="false">Kepemimpinan</button>
                    </div>
                </div>

                <div class="ekstra-grid" id="ekstraGrid">
                    @foreach ($activities as $activity)
                        <article class="ekstra-card js-card" data-ekstra-card data-category="{{ $activity['category'] }}">
                            <div class="ekstra-photo-wrap">
                                <img src="{{ $activity['photo'] }}" alt="{{ $activity['title'] }}" class="ekstra-photo" loading="lazy" />
                                <span class="ekstra-category-badge">{{ $activity['category'] }}</span>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold leading-snug text-slate-900">{{ $activity['title'] }}</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">{{ $activity['desc'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 pb-14 lg:px-8 lg:pb-16">
                <div class="ekstra-cta-box" data-ekstra-fade>
                    <div>
                        <p class="ekstra-info-kicker text-red-100">Ajakan</p>
                        <h3>Yuk dukung bakat anak lewat kegiatan yang tepat</h3>
                        <p>Ekstrakurikuler yang konsisten membantu siswa berkembang secara seimbang, baik secara akademik maupun non-akademik.</p>
                    </div>
                    <a href="{{ url('/') }}#kontak" class="ekstra-cta-link">Hubungi Sekolah</a>
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

