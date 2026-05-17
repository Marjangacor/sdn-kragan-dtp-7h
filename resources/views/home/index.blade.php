<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>SDN Kragan | Sekolah Dasar Negeri</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-100 text-slate-900">
        <div class="school-page">
        <x-site.navbar active="beranda" subtitle="Kragan Gedangan Sidoarjo" />

        <main class="overflow-hidden">
            <section id="beranda" class="hero-wrap relative text-white">
                <div class="hero-noise"></div>
                <div class="hero-orbs" aria-hidden="true">
                    <span class="hero-orb hero-orb-a"></span>
                    <span class="hero-orb hero-orb-b"></span>
                    <span class="hero-orb hero-orb-c"></span>
                </div>
                <div class="hero-grid relative mx-auto grid max-w-7xl gap-8 px-6 py-12 lg:grid-cols-[1.05fr_0.95fr] lg:px-8 lg:py-14">
                    <div class="hero-copy space-y-5">
                        <span class="hero-pill reveal">Selamat Datang di SDN Kragan Gedangan</span>
                        <div class="space-y-5 reveal" style="--reveal-delay: 120ms">
                            <h1 class="hero-title">Mewujudkan Generasi Cerdas, Berkarakter, dan Berprestasi</h1>
                            <p class="hero-description">Memberikan pendidikan berkualitas dengan pendekatan holistik untuk mengembangkan potensi siswa secara akademis, karakter, dan kreativitas.</p>
                        </div>
                        <div id="heroFeatureBox" class="hero-feature-box reveal" style="--reveal-delay: 220ms">
                            <div id="heroCtaGroup" class="hero-cta-group flex flex-wrap gap-3">
                                <a href="{{ url('/spmb') }}" class="hero-cta hero-cta-primary ripple-btn">Daftar SPMB</a>
                                <!-- Profil link removed per request -->
                            </div>
                            <div id="heroStats" class="hero-stats-grid mt-4 grid max-w-3xl grid-cols-3 gap-3">
                                <article class="stat-card stat-card-lg js-card">
                                    <p class="stat-number"><span data-counter="500">0</span>+</p>
                                    <p class="stat-label">Siswa Aktif</p>
                                </article>
                                <article class="stat-card stat-card-lg js-card">
                                    <p class="stat-number"><span data-counter="30">0</span>+</p>
                                    <p class="stat-label">Tenaga Pendidik</p>
                                </article>
                                <article class="stat-card stat-card-lg js-card">
                                    <p class="stat-number"><span data-counter="25">0</span>+</p>
                                    <p class="stat-label">Siswa Berprestasi</p>
                                </article>
                            </div>
                        </div>
                    </div>

                    <div class="reveal" style="--reveal-delay: 260ms">
                        <div class="hero-emblem-scene aspect-[16/10]">
                            <img src="{{ asset('images/logo-upt-sdn-kragan.png') }}" alt="Logo resmi SDN Kragan Gedangan Sidoarjo" class="hero-emblem js-logo-orbit school-logo-img school-logo-img--hero" />
                        </div>
                    </div>
                </div>
            </section>

            <section id="tentang" class="bg-slate-100 py-14 lg:py-18">
                <div class="mx-auto grid max-w-7xl gap-6 px-6 lg:grid-cols-[1fr_1.1fr] lg:items-center lg:px-8">
                    <div class="overflow-hidden rounded-3xl bg-white shadow-xl shadow-slate-900/10 reveal js-card">
                        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1200&q=80" alt="Kepala sekolah SDN Kragan" class="h-full w-full object-cover" />
                    </div>
                    <article class="rounded-3xl bg-white p-8 shadow-xl shadow-slate-900/8 reveal js-card" style="--reveal-delay: 140ms">
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-white-500">Sambutan Kepala Sekolah</p>
                        <h2 class="mt-3 text-3xl font-semibold leading-tight text-slate-900">Membangun Masa Depan Bangsa Dimulai dari Pendidikan</h2>
                        <p class="mt-5 text-sm leading-7 text-slate-600">Assalamualaikum warahmatullahi wabarakatuh. Puji syukur kita panjatkan kepada Tuhan Yang Maha Esa atas segala rahmat-Nya, sehingga SDN Kragan terus berkembang menjadi sekolah yang berkomitmen mencetak generasi unggul, berkarakter, dan kreatif.</p>
                        <p class="mt-4 text-sm leading-7 text-slate-600">Kami percaya bahwa setiap anak memiliki potensi luar biasa yang perlu didampingi dengan pendidikan yang tepat. Melalui metode pembelajaran inovatif dan lingkungan belajar yang sehat, kami berupaya memfasilitasi perkembangan peserta didik secara optimal.</p>
                        <div class="mt-6 text-sm text-slate-700">
                            <p class="font-semibold">Ariyani Purwaningsih, S.pd</p>
                            <p class="text-slate-500">Kepala Sekolah SDN Kragan</p>
                        </div>
                    </article>
                </div>
            </section>

            <section id="visi-misi" class="bg-stone-200/70 py-14 lg:py-18">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center reveal">
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-white-500">Visi & Misi</p>
                        <h2 class="mt-3 text-3xl font-semibold text-slate-900">Arah dan Tujuan Kami</h2>
                    </div>
                    <div class="mt-8 grid gap-5 lg:grid-cols-2">
                        <article class="rounded-3xl bg-white p-8 shadow-xl shadow-slate-900/8 reveal js-card" style="--reveal-delay: 80ms">
                            <div class="mb-5 inline-flex h-10 w-10 items-center justify-center rounded-xl bg-red-700 text-white">
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" class="h-5 w-5 stroke-current">
                                    <path d="M6 5.5C6 4.67157 6.67157 4 7.5 4H18.5C19.3284 4 20 4.67157 20 5.5V18.5C20 19.3284 19.3284 20 18.5 20H7.5C6.67157 20 6 19.3284 6 18.5V5.5Z" stroke-width="1.8" />
                                    <path d="M9 8H17M9 12H17M9 16H14" stroke-width="1.8" stroke-linecap="round" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-slate-900">Visi</h3>
                          <p class="mt-4 text-sm leading-7 text-slate-600">Menjadi sekolah dasar unggulan yang menghasilkan lulusan cerdas, berkarakter Pancasila, berwawasan lingkungan, dan mampu bersaing di era global tanpa meninggalkan budaya bangsa.</p>
                        </article>
                        <article class="rounded-3xl bg-white p-8 shadow-xl shadow-slate-900/8 reveal js-card" style="--reveal-delay: 180ms">
                            <div class="mb-5 inline-flex h-10 w-10 items-center justify-center rounded-xl bg-red-700 text-white">
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" class="h-5 w-5 stroke-current">
                                    <path d="M8 4H16V6C16 7.10457 15.1046 8 14 8H10C8.89543 8 8 7.10457 8 6V4Z" stroke-width="1.8" />
                                    <path d="M8 6H6C4.89543 6 4 6.89543 4 8V9C4 10.6569 5.34315 12 7 12H8.5M16 6H18C19.1046 6 20 6.89543 20 8V9C20 10.6569 18.6569 12 17 12H15.5" stroke-width="1.8" stroke-linecap="round" />
                                    <path d="M12 12V16" stroke-width="1.8" stroke-linecap="round" />
                                    <path d="M9.5 16H14.5V20H9.5V16Z" stroke-width="1.8" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-slate-900">Misi</h3>
                            <ul class="space-y-3 text-slate-600 list-disc pl-5 marker:text-red-500">
                                <li class="flex gap-3"><span class="mt-2 h-2.5 w-2.5 rounded-full bg-red-700"></span><span>Menyelenggarakan pendidikan yang berpusat pada peserta didik.</span></li>
                                <li class="flex gap-3"><span class="mt-2 h-2.5 w-2.5 rounded-full bg-red-700"></span><span>Membentuk karakter disiplin, religius, dan berbudaya.</span></li>
                                <li class="flex gap-3"><span class="mt-2 h-2.5 w-2.5 rounded-full bg-red-700"></span><span>Mengembangkan potensi akademik dan non-akademik siswa.</span></li>
                                <li class="flex gap-3"><span class="mt-2 h-2.5 w-2.5 rounded-full bg-red-700"></span><span>Membangun kemitraan aktif dengan orang tua dan masyarakat.</span></li>
                            </ul>
                        </article>
                    </div>
                </div>
            </section>

            <section id="profil" class="bg-slate-100 py-14 lg:py-18">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center reveal">
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-white-500">Tentang Kami</p>
                        <h2 class="mt-3 text-3xl font-semibold text-slate-900">Profil Singkat Sekolah</h2>
                    </div>
                    <div class="mt-8 grid gap-6 lg:grid-cols-[1fr_1fr]">
                        <article class="space-y-5 rounded-3xl bg-white p-8 shadow-xl shadow-slate-900/8 reveal js-card" style="--reveal-delay: 80ms">
                            <p class="text-sm leading-7 text-slate-600">SDN Kragan berdiri sejak tahun 2021 dan berkomitmen mencetak generasi berakhlak, cerdas, serta memiliki keterampilan hidup. Program pembelajaran dirancang seimbang antara aspek akademik, karakter, dan kreativitas.</p>
                            <p class="text-sm leading-7 text-slate-600">Sekolah kami didukung guru profesional, lingkungan belajar nyaman, dan fasilitas yang menunjang proses pendidikan modern. Pembelajaran kolaboratif menjadi bagian penting dari pengalaman siswa.</p>
                            <div class="grid grid-cols-2 gap-4 pt-2">
                                <div class="rounded-2xl bg-slate-100 p-5">
                                    <p class="text-3xl font-semibold text-slate-900"><span data-counter="500">0</span>+</p>
                                    <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Siswa Aktif</p>
                                </div>
                                <div class="rounded-2xl bg-slate-100 p-5">
                                    <p class="text-3xl font-semibold text-slate-900"><span data-counter="30">0</span>+</p>
                                    <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Guru & Karyawan</p>
                                </div>
                            </div>
                        </article>
<div class="grid grid-cols-2 gap-3 reveal" style="--reveal-delay: 180ms">
    
    <div class="overflow-hidden rounded-2xl bg-white shadow-md js-card h-72">
        <img src="{{ asset('images/Dok Sekol 11.jpeg') }}" 
             alt="Aktivitas belajar 1" 
             class="w-full h-full object-cover" />
    </div>

    <div class="overflow-hidden rounded-2xl bg-white shadow-md js-card h-72">
        <img src="{{ asset('images/Prestasi 2.jpeg') }}" 
             alt="Aktivitas belajar 2" 
             class="w-full h-full object-cover" />
    </div>

    <div class="overflow-hidden rounded-2xl bg-white shadow-md js-card h-72">
        <img src="{{ asset('images/Prestasi 6.jpeg') }}" 
             alt="Aktivitas belajar 3" 
             class="w-full h-full object-cover" />
    </div>

    <div class="overflow-hidden rounded-2xl bg-white shadow-md js-card h-72">
        <img src="{{ asset('images/Prestasi 9.jpeg') }}" 
             alt="Aktivitas belajar 4" 
             class="w-full h-full object-cover" />
    </div>

</div>
                </div>
            </section>

            <section id="filosofi" class="bg-stone-200/70 py-14 lg:py-18">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center reveal">
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-white-500">Identitas Kami</p>
                        <h2 class="mt-3 text-3xl font-semibold text-slate-900">Filosofi Logo SDN Kragan</h2>
                    </div>
                    <div class="mt-8 grid gap-6 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
                        <div class="flex items-center justify-center reveal" style="--reveal-delay: 80ms">
                            <div class="js-card">
                                        <img src="{{ asset('images/logo-upt-sdn-kragan.png') }}" alt="Logo SDN Kragan" class="school-logo-img school-logo-img--large" />
             <style>
                    .school-logo-img--large {  
                    height: 350px;px;  
                    width: auto;  
                    background: transparent;  
}
</style>
                            </div>
                        </div>

                        <div class="space-y-3 reveal" style="--reveal-delay: 180ms">
                            <article class="feature-card feature-card-red js-card">
                                <h3>Merah Putih</h3>
                                <p>Melambangkan bendera Indonesia.</p>
                            </article>
                            <article class="feature-card feature-card-green js-card">
                                <h3>Lingkar Hijau</h3>
                                <p>Melambangkan  persaudaraan, pertumbuhan dan lingkungan yang sehat.</p>
                            </article>
                            <article class="feature-card feature-card-gold js-card">
                                <h3>Bintang Emas</h3>
                                <p>Melambangkan Ketuhanan.</p>
                            </article>
                             <article class="feature-card feature-card-neutral js-card">
                                <h3>Al Quran</h3>
                                <p>Melambangkan religiusitas dan pondasi pendidikan adalah  agama.</p>
                            </article>
                            <article class="feature-card feature-card-neutral js-card">
                                <h3>Figur Siswa</h3>
                                <p>Melambangkan jenjang sekolah dasar.</p>
                            </article>
                            <article class="rounded-2xl home-makna-card p-6 text-white shadow-lg shadow-slate-900/20 js-card">
                                <h3 class="text-lg font-semibold">Makna Keseluruhan</h3>
                                <p class="mt-2 text-sm leading-7 text-red-50">Logo SDN Kragan menegaskan komitmen sekolah untuk membentuk generasi cerdas, berkarakter, cinta Indonesia, dan siap berprestasi.</p>
                            </article>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <x-site.footer
            subtitle="Sekolah Dasar Negeri"
            description="Mewujudkan generasi cerdas, berkarakter, dan berprestasi melalui pendidikan yang berkualitas dan humanis."
            :quickLinks="[
                ['label' => 'Visi & Misi', 'href' => '#visi-misi'],
                ['label' => 'Prestasi', 'href' => '#profil'],
                ['label' => 'Filosofi Logo', 'href' => '#filosofi'],
            ]"
        />
        </div>

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

