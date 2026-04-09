<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>SPMB | SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="spmb-page school-page bg-slate-100 text-slate-900">
        @php
            $steps = collect([
                [
                    'title' => 'Registrasi',
                    'desc' => 'Calon peserta didik mendaftar melalui sekolah atau jalur yang ditentukan.',
                ],
                [
                    'title' => 'Verifikasi Berkas',
                    'desc' => 'Panitia mengecek data, dokumen, dan kelengkapan syarat pendaftaran.',
                ],
                [
                    'title' => 'Wawancara & Observasi',
                    'desc' => 'Sekolah melakukan observasi ringan untuk memahami kebutuhan belajar anak.',
                ],
                [
                    'title' => 'Pengumuman',
                    'desc' => 'Hasil seleksi disampaikan secara resmi kepada orang tua atau wali.',
                ],
            ]);

            $requirements = collect([
                'Fotokopi Kartu Keluarga',
                'Fotokopi Akta Kelahiran',
                'Pas foto terbaru',
                'Kartu identitas orang tua/wali',
                'Formulir pendaftaran yang telah diisi',
            ]);

            $benefits = collect([
                'Lingkungan belajar yang nyaman dan aman',
                'Pembelajaran yang berfokus pada karakter dan potensi anak',
                'Guru berpengalaman dan komunikatif',
                'Kegiatan akademik dan non-akademik yang seimbang',
            ]);
        @endphp

        <header class="spmb-header sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 lg:px-8">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-blue-700 to-indigo-900 text-xs font-bold tracking-[0.1em] text-white">SDN</div>
                    <div>
                        <p class="text-lg font-semibold leading-tight text-slate-900">SDN Kragan</p>
                        <p class="text-sm text-slate-500">Penerimaan Peserta Didik Baru</p>
                    </div>
                </div>
                <a href="{{ url('/') }}" class="spmb-back-link">Kembali ke Beranda</a>
            </div>
        </header>

        <main>
            <section class="spmb-hero relative overflow-hidden text-white">
                <div class="spmb-noise" aria-hidden="true"></div>
                <div class="spmb-orb spmb-orb-1" aria-hidden="true"></div>
                <div class="spmb-orb spmb-orb-2" aria-hidden="true"></div>

                <div class="relative mx-auto grid max-w-7xl gap-10 px-6 py-12 lg:grid-cols-[1.05fr_0.95fr] lg:px-8 lg:py-14">
                    <div class="space-y-5">
                        <p class="spmb-kicker reveal">Penerimaan Peserta Didik Baru</p>
                        <div class="space-y-4 reveal" style="--reveal-delay: 90ms">
                            <h1 class="spmb-title">Daftar SPMB SDN Kragan</h1>
                            <p class="spmb-description">Informasi pendaftaran disusun sederhana agar orang tua mudah memahami alur, syarat, dan jadwal penerimaan peserta didik baru.</p>
                        </div>

                        <div class="spmb-stats-grid reveal" style="--reveal-delay: 180ms">
                            <article class="spmb-stat-card js-card">
                                <p class="spmb-stat-number"><span data-counter="4">0</span></p>
                                <p class="spmb-stat-label">Tahap Pendaftaran</p>
                            </article>
                            <article class="spmb-stat-card js-card">
                                <p class="spmb-stat-number"><span data-counter="5">0</span>+</p>
                                <p class="spmb-stat-label">Dokumen Penting</p>
                            </article>
                            <article class="spmb-stat-card js-card">
                                <p class="spmb-stat-number"><span data-counter="100">0</span>%</p>
                                <p class="spmb-stat-label">Fokus Layanan</p>
                            </article>
                        </div>
                    </div>

                    <div class="reveal" style="--reveal-delay: 150ms">
                        <div class="spmb-hero-card js-card">
                            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1200&q=80" alt="Orang tua sedang mengisi formulir pendaftaran" class="h-full w-full object-cover" />
                            <div class="spmb-hero-card-overlay">
                                <p>Alur jelas, informasi ringkas, dan mudah diakses</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 py-8 lg:px-8 lg:py-10">
                <div class="spmb-highlight-grid">
                    <article class="spmb-info-card" data-spmb-fade>
                        <p class="spmb-info-kicker">Syarat Pendaftaran</p>
                        <h2>Dokumen yang perlu disiapkan</h2>
                        <ul class="spmb-list">
                            @foreach ($requirements as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </article>
                    <article class="spmb-info-card spmb-info-card-accent" data-spmb-fade>
                        <p class="spmb-info-kicker">Keunggulan Sekolah</p>
                        <h2>Alasan memilih SDN Kragan</h2>
                        <ul class="spmb-list">
                            @foreach ($benefits as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </article>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 py-10 lg:px-8 lg:py-12">
                <div class="mb-6">
                    <p class="spmb-info-kicker">Tahapan Pendaftaran</p>
                    <h2 class="mt-2 text-2xl font-semibold text-slate-900">Alur SPMB yang sederhana</h2>
                </div>
                <div class="spmb-step-grid">
                    @foreach ($steps as $step)
                        <article class="spmb-step-card js-card" data-spmb-card>
                            <span class="spmb-step-number">0{{ $loop->iteration }}</span>
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['desc'] }}</p>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 pb-14 lg:px-8 lg:pb-16">
                <div class="spmb-cta-box" data-spmb-fade>
                    <div>
                        <p class="spmb-info-kicker text-blue-100">Informasi Pendaftaran</p>
                        <h3>Ingin bertanya lebih lanjut sebelum mendaftar?</h3>
                        <p>Silakan hubungi sekolah agar orang tua mendapatkan informasi yang lebih lengkap dan akurat mengenai proses penerimaan.</p>
                    </div>
                    <a href="{{ url('/') }}#kontak" class="spmb-cta-link">Hubungi Sekolah</a>
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
