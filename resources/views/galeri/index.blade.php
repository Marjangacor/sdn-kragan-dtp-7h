<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Galeri Kegiatan | SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
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
                        'image_url' => asset('images/lomba-siswa-sdn-kragan.jpg'),
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

        <x-site.navbar active="galeri" subtitle="Galeri Kegiatan" />

        <main class="galeri-page">
            <section class="galeri-hero relative overflow-hidden text-white">
                <div class="galeri-noise" aria-hidden="true"></div>
                <div class="galeri-orb galeri-orb-1" aria-hidden="true"></div>
                <div class="galeri-orb galeri-orb-2" aria-hidden="true"></div>

                <div class="relative mx-auto grid max-w-7xl gap-10 px-6 py-12 lg:grid-cols-[1.05fr_0.95fr] lg:px-8 lg:py-14">
                    <div class="space-y-5">
                        <p class="galeri-kicker reveal">Galeri Kegiatan</p>
                        <div class="space-y-4 reveal" style="--reveal-delay: 90ms">
                            <h1 class="galeri-title">Cerita Kegiatan SDN Kragan</h1>
                            <p class="galeri-description">Di sini kamu bisa melihat berbagai momen sekolah, dari belajar di kelas sampai kegiatan kebersamaan. Klik foto mana saja untuk membuka detail kegiatan secara lengkap.</p>
                        </div>
                    </div>

                    <div class="reveal" style="--reveal-delay: 160ms">
                        <div class="galeri-hero-card js-card">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1200&q=80" alt="Kegiatan sekolah SDN Kragan" class="h-full w-full object-cover" />
                        </div>
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
                                <h3>{{ data_get($item, 'title') }}</h3>
                                <p>{{ data_get($item, 'description') }}</p>
                                <span class="galeri-detail-hint">Lihat Detail</span>
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