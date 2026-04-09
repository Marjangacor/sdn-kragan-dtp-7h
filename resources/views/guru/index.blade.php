<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Guru & Karyawan | SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="guru-page school-page bg-slate-100 text-slate-900">
        @php
            $staff = collect([
                [
                    'name' => 'Dra. Siti Nur Aisyah, M.Pd',
                    'type' => 'Guru',
                    'subject' => 'Bahasa Indonesia',
                    'photo' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=700&q=80',
                ],
                [
                    'name' => 'Bapak Eko Prasetyo, S.Pd',
                    'type' => 'Guru',
                    'subject' => 'Matematika',
                    'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=700&q=80',
                ],
                [
                    'name' => 'Ibu Rina Maharani, S.Pd',
                    'type' => 'Guru',
                    'subject' => 'IPAS',
                    'photo' => 'https://images.unsplash.com/photo-1544723795-3fb6469f5b39?auto=format&fit=crop&w=700&q=80',
                ],
                [
                    'name' => 'Bapak Wahyu Kurniawan, S.Pd',
                    'type' => 'Guru',
                    'subject' => 'Pendidikan Jasmani',
                    'photo' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=700&q=80',
                ],
                [
                    'name' => 'Ibu Dwi Lestari, S.Pd',
                    'type' => 'Guru',
                    'subject' => 'Seni Budaya',
                    'photo' => 'https://images.unsplash.com/photo-1580894732444-8ecded7900cd?auto=format&fit=crop&w=700&q=80',
                ],
                [
                    'name' => 'Bapak Ahmad Fauzi, S.Pd.I',
                    'type' => 'Guru',
                    'subject' => 'Pendidikan Agama Islam',
                    'photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=700&q=80',
                ],
                [
                    'name' => 'Ibu Ratna Puspitasari, A.Md',
                    'type' => 'Karyawan',
                    'subject' => 'Tata Usaha',
                    'photo' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=700&q=80',
                ],
                [
                    'name' => 'Bapak M. Arifin',
                    'type' => 'Karyawan',
                    'subject' => 'Operator Sekolah',
                    'photo' => 'https://images.unsplash.com/photo-1504257432389-52343af06ae3?auto=format&fit=crop&w=700&q=80',
                ],
                [
                    'name' => 'Ibu Lina Handayani',
                    'type' => 'Karyawan',
                    'subject' => 'Perpustakaan',
                    'photo' => 'https://images.unsplash.com/photo-1595152772835-219674b2a8a6?auto=format&fit=crop&w=700&q=80',
                ],
                [
                    'name' => 'Bapak Sugeng Riyanto',
                    'type' => 'Karyawan',
                    'subject' => 'Penjaga Sekolah',
                    'photo' => 'https://images.unsplash.com/photo-1568602471122-7832951cc4c5?auto=format&fit=crop&w=700&q=80',
                ],
            ]);

            $guruCount = $staff->where('type', 'Guru')->count();
            $karyawanCount = $staff->where('type', 'Karyawan')->count();
            $mapelCount = $staff->where('type', 'Guru')->pluck('subject')->unique()->count();
        @endphp

        <header class="guru-header sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 lg:px-8">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-blue-700 to-indigo-900 text-xs font-bold tracking-[0.1em] text-white">SDN</div>
                    <div>
                        <p class="text-lg font-semibold leading-tight text-slate-900">SDN Kragan</p>
                        <p class="text-sm text-slate-500">Data Guru & Karyawan</p>
                    </div>
                </div>
                <a href="{{ url('/') }}" class="guru-back-link">Kembali ke Beranda</a>
            </div>
        </header>

        <main>
            <section class="guru-hero relative overflow-hidden text-white">
                <div class="guru-orb guru-orb-1" aria-hidden="true"></div>
                <div class="guru-orb guru-orb-2" aria-hidden="true"></div>
                <div class="relative mx-auto max-w-7xl px-6 py-12 lg:px-8 lg:py-14">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-blue-100">Profil SDM Sekolah</p>
                    <h1 class="mt-3 max-w-4xl text-4xl font-bold leading-tight md:text-5xl">Guru dan Karyawan SDN Kragan</h1>
                    <p class="mt-4 max-w-3xl text-base leading-relaxed text-blue-100">Berikut data tenaga pendidik dan kependidikan SDN Kragan lengkap dengan nama, bidang mapel atau tugas, serta foto profil.</p>

                    <div class="mt-7 grid gap-4 md:grid-cols-3">
                        <article class="guru-summary-card" data-guru-card>
                            <p class="guru-summary-number" data-counter-target="{{ $guruCount }}">0</p>
                            <p class="guru-summary-label">Jumlah Guru</p>
                        </article>
                        <article class="guru-summary-card" data-guru-card>
                            <p class="guru-summary-number" data-counter-target="{{ $karyawanCount }}">0</p>
                            <p class="guru-summary-label">Jumlah Karyawan</p>
                        </article>
                        <article class="guru-summary-card" data-guru-card>
                            <p class="guru-summary-number" data-counter-target="{{ $mapelCount }}">0</p>
                            <p class="guru-summary-label">Mapel Aktif</p>
                        </article>
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 py-8 lg:px-8 lg:py-10">
                <div class="guru-showcase-grid">
                    <article class="guru-info-card" data-guru-fade>
                        <p class="guru-info-kicker">Pendekatan Pembelajaran</p>
                        <h2>Tim Pengajar Kolaboratif dan Adaptif</h2>
                        <p>Setiap guru aktif berkolaborasi merancang pembelajaran berbasis proyek, literasi, dan numerasi. Kegiatan kelas diperkaya media interaktif untuk meningkatkan antusiasme siswa.</p>
                        <ul class="guru-bullet-list">
                            <li>Rapat evaluasi pembelajaran setiap pekan</li>
                            <li>Pengembangan modul ajar berbasis kebutuhan siswa</li>
                            <li>Pendampingan karakter dan komunikasi orang tua</li>
                        </ul>
                    </article>

                    <article class="guru-info-card guru-info-card-accent" data-guru-fade>
                        <p class="guru-info-kicker">Mapel Unggulan</p>
                        <h2>Variasi Mata Pelajaran Aktif</h2>
                        <div class="guru-chip-wrap">
                            <span class="guru-chip">Bahasa Indonesia</span>
                            <span class="guru-chip">Matematika</span>
                            <span class="guru-chip">IPAS</span>
                            <span class="guru-chip">PAI</span>
                            <span class="guru-chip">PJOK</span>
                            <span class="guru-chip">Seni Budaya</span>
                        </div>
                        <p class="mt-4">Distribusi mapel ditangani guru sesuai bidang kompetensi agar pembelajaran lebih terarah, menyenangkan, dan relevan.</p>
                    </article>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 py-10 lg:px-8 lg:py-12">
                <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-2xl font-semibold text-slate-900">Daftar Tenaga Pendidik & Kependidikan</h2>
                    <div class="guru-filter-wrap" role="tablist" aria-label="Filter data guru dan karyawan">
                        <button type="button" class="guru-filter-btn is-active" data-filter-type="all" role="tab" aria-selected="true">Semua</button>
                        <button type="button" class="guru-filter-btn" data-filter-type="guru" role="tab" aria-selected="false">Guru</button>
                        <button type="button" class="guru-filter-btn" data-filter-type="karyawan" role="tab" aria-selected="false">Karyawan</button>
                    </div>
                </div>

                <div class="guru-grid" id="guruGrid">
                    @foreach ($staff as $member)
                        <article class="guru-card" data-guru-card data-type="{{ strtolower($member['type']) }}">
                            <div class="guru-photo-wrap">
                                <img src="{{ $member['photo'] }}" alt="Foto {{ $member['name'] }}" class="guru-photo" loading="lazy" />
                                <span class="guru-type-badge">{{ $member['type'] }}</span>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold leading-snug text-slate-900">{{ $member['name'] }}</h3>
                                <p class="mt-2 text-sm font-medium text-blue-700">{{ $member['type'] === 'Guru' ? 'Mapel' : 'Bidang Tugas' }}: {{ $member['subject'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 pb-14 lg:px-8 lg:pb-16">
                <div class="guru-cta-box" data-guru-fade>
                    <div>
                        <p class="guru-info-kicker text-blue-100">Informasi Lanjutan</p>
                        <h3>Ingin Mengenal Guru dan Karyawan Lebih Dekat?</h3>
                        <p>Silakan hubungi sekolah untuk jadwal konsultasi orang tua, kunjungan sekolah, atau diskusi kebutuhan belajar peserta didik.</p>
                    </div>
                    <a href="{{ url('/') }}#kontak" class="guru-cta-link">Hubungi Sekolah</a>
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
