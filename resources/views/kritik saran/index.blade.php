<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Kritik & Saran | SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="kritik-page school-page bg-slate-100 text-slate-900">
        @php
            $channels = collect([
                [
                    'title' => 'Kontak Sekolah',
                    'desc' => 'Sampaikan masukan langsung melalui kontak resmi sekolah untuk tindak lanjut yang lebih cepat.',
                    'value' => '(0298) 123-456',
                ],
                [
                    'title' => 'Email Sekolah',
                    'desc' => 'Cocok untuk saran yang lebih panjang, detail, atau bersifat administrasi.',
                    'value' => 'info@sdnkragan.sch.id',
                ],
                [
                    'title' => 'Kunjungan Langsung',
                    'desc' => 'Orang tua dapat datang ke sekolah pada jam kerja untuk berdiskusi dengan pihak sekolah.',
                    'value' => 'Senin - Jumat, 07.00 - 13.00',
                ],
            ]);

            $principles = collect([
                'Ramah dan menghargai setiap masukan',
                'Mendorong perbaikan layanan pendidikan',
                'Membantu sekolah memahami kebutuhan orang tua',
                'Menjaga komunikasi yang sehat dan terbuka',
            ]);

            $topics = collect([
                'Kualitas pembelajaran',
                'Kebersihan lingkungan sekolah',
                'Pelayanan administrasi',
                'Komunikasi guru dan orang tua',
                'Kegiatan siswa dan fasilitas',
                'Usulan program baru',
            ]);

            $feedbackCards = collect([
                [
                    'title' => 'Saran untuk Pembelajaran',
                    'desc' => 'Ide tentang metode belajar, media ajar, atau kegiatan kelas yang lebih menarik.',
                    'icon' => '✎',
                ],
                [
                    'title' => 'Saran Fasilitas',
                    'desc' => 'Masukan tentang ruang kelas, perpustakaan, sanitasi, dan kenyamanan lingkungan.',
                    'icon' => '◫',
                ],
                [
                    'title' => 'Saran Pelayanan',
                    'desc' => 'Hal-hal yang berkaitan dengan admin sekolah, komunikasi, dan kecepatan layanan.',
                    'icon' => '◎',
                ],
                [
                    'title' => 'Apresiasi',
                    'desc' => 'Ucapan terima kasih atau apresiasi untuk guru, karyawan, dan kegiatan sekolah.',
                    'icon' => '★',
                ],
            ]);
        @endphp

        <header class="kritik-header site-header app-navbar sticky top-0 z-40">
            <div class="navbar-inner mx-auto flex max-w-7xl items-center justify-between gap-2 px-4 py-4 lg:px-8">
                <div class="header-left flex min-w-0 items-center gap-2 lg:gap-3">
                    <div class="header-brand">
                    <img src="{{ asset('images/logo-upt-sdn-kragan.png') }}" alt="Logo SDN Kragan" class="school-logo-img school-logo-img--small" />
                    <div class="header-brand-copy">
                        <p class="text-lg font-semibold leading-tight text-slate-900">SDN Kragan</p>
                        <p class="text-sm text-slate-500">Kritik & Saran</p>
                    </div>
                </div>
                    <nav class="nav-list hidden items-center gap-2 lg:flex">
                    <a href="{{ url('/') }}#beranda" class="nav-chip">Beranda</a>
                    <a href="{{ url('/guru') }}" class="nav-chip">Guru & Karyawan</a>
                    <a href="{{ url('/prestasi') }}" class="nav-chip">Prestasi</a>
                    <a href="{{ url('/galeri') }}" class="nav-chip">Galeri</a>
                    <a href="{{ url('/ekstra') }}" class="nav-chip">Ekstrakurikuler</a>
                    <a href="{{ url('/kritik-saran') }}" class="nav-chip is-active">Kritik & Saran</a>
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

        <main>
            <section class="kritik-hero relative overflow-hidden text-white">
                <div class="kritik-noise" aria-hidden="true"></div>
                <div class="kritik-orb kritik-orb-1" aria-hidden="true"></div>
                <div class="kritik-orb kritik-orb-2" aria-hidden="true"></div>

                <div class="relative mx-auto grid max-w-7xl gap-10 px-6 py-12 lg:grid-cols-[1.05fr_0.95fr] lg:px-8 lg:py-14">
                    <div class="space-y-5">
                        <p class="kritik-kicker reveal">Ruang Suara Orang Tua</p>
                        <div class="space-y-4 reveal" style="--reveal-delay: 90ms">
                            <h1 class="kritik-title">Kritik & Saran untuk SDN Kragan</h1>
                            <p class="kritik-description">Kami membuka ruang komunikasi yang sopan, jelas, dan mudah diakses agar sekolah dapat terus berbenah dan memberikan layanan yang lebih baik.</p>
                        </div>

                        <div class="kritik-stats-grid reveal" style="--reveal-delay: 180ms">
                            <article class="kritik-stat-card js-card">
                                <p class="kritik-stat-number"><span data-counter="4">0</span></p>
                                <p class="kritik-stat-label">Jenis Kanal</p>
                            </article>
                            <article class="kritik-stat-card js-card">
                                <p class="kritik-stat-number"><span data-counter="6">0</span>+</p>
                                <p class="kritik-stat-label">Topik Masukan</p>
                            </article>
                            <article class="kritik-stat-card js-card">
                                <p class="kritik-stat-number"><span data-counter="100">0</span>%</p>
                                <p class="kritik-stat-label">Ruang Terbuka</p>
                            </article>
                        </div>
                    </div>

                    <div class="reveal" style="--reveal-delay: 160ms">
                        <div class="kritik-hero-card js-card kritik-hero-image-container">
                            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80" alt="Diskusi antara orang tua dan pihak sekolah" class="h-full w-full object-cover" />
                        </div>
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 py-8 lg:px-8 lg:py-10">
                <div class="kritik-highlight-grid">
                    <article class="kritik-info-card" data-kritik-fade>
                        <p class="kritik-info-kicker">Prinsip Tanggapan</p>
                        <h2>Masukan harus sopan, jujur, dan membangun</h2>
                        <ul class="kritik-list">
                            @foreach ($principles as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </article>
                    <article class="kritik-info-card kritik-info-card-accent" data-kritik-fade>
                        <p class="kritik-info-kicker">Topik Masukan</p>
                        <h2>Hal yang bisa disampaikan</h2>
                        <div class="kritik-chip-wrap">
                            @foreach ($topics as $topic)
                                <span class="kritik-chip">{{ $topic }}</span>
                            @endforeach
                        </div>
                    </article>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 py-10 lg:px-8 lg:py-12">
                <div class="mb-6">
                    <p class="kritik-info-kicker">Kotak Saran</p>
                    <h2 class="mt-2 text-2xl font-semibold text-slate-900">Jenis masukan yang kami terima</h2>
                </div>
                <div class="kritik-grid">
                    @foreach ($feedbackCards as $card)
                        <article class="kritik-card js-card" data-kritik-card>
                            <div class="kritik-card-icon">{{ $card['icon'] }}</div>
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['desc'] }}</p>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 py-10 lg:px-8 lg:py-12">
                <div class="kritik-form-grid">
                    <article class="kritik-form-card" data-kritik-fade>
                        <p class="kritik-info-kicker">Formulir Saran</p>
                        <h2>Berikan kritik dan saran Anda</h2>
                        @if(session('success'))
                            <div class="mb-4 rounded-3xl bg-emerald-100 p-4 text-sm text-emerald-900">{{ session('success') }}</div>
                        @endif
                        <form method="POST" action="{{ route('feedback.store') }}" class="mt-5 space-y-4">
                            @csrf
                            <div>
                                <label class="kritik-label" for="name">Nama</label>
                                <input id="name" name="name" type="text" value="{{ old('name') }}" class="kritik-input" placeholder="Nama orang tua / wali" required />
                                @error('name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="kritik-label" for="email">Email</label>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" class="kritik-input" placeholder="Email Anda" required />
                                @error('email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="kritik-label" for="category">Kategori</label>
                                <select id="category" name="category" class="kritik-input" required>
                                    <option value="pembelajaran" @selected(old('category') === 'pembelajaran')>Pembelajaran</option>
                                    <option value="fasilitas" @selected(old('category') === 'fasilitas')>Fasilitas</option>
                                    <option value="pelayanan_administrasi" @selected(old('category') === 'pelayanan_administrasi')>Pelayanan Administrasi</option>
                                    <option value="lainnya" @selected(old('category') === 'lainnya')>Lainnya</option>
                                </select>
                                @error('category')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="kritik-label" for="type">Tipe</label>
                                <select id="type" name="type" class="kritik-input" required>
                                    <option value="saran" @selected(old('type') === 'saran')>Saran</option>
                                    <option value="kritik" @selected(old('type') === 'kritik')>Kritik</option>
                                    <option value="pujian" @selected(old('type') === 'pujian')>Apresiasi</option>
                                </select>
                                @error('type')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="kritik-label" for="message">Pesan</label>
                                <textarea id="message" name="message" class="kritik-textarea" rows="6" placeholder="Tulis kritik atau saran Anda di sini..." required>{{ old('message') }}</textarea>
                                @error('message')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <button type="submit" class="kritik-submit-btn">Kirim Pesan</button>
                        </form>
                    </article>

                    <article class="kritik-form-card kritik-form-card-accent" data-kritik-fade>
                        <p class="kritik-info-kicker">Saluran Resmi</p>
                        <h2>Cara menyampaikan masukan</h2>
                        <div class="space-y-3 mt-5">
                            @foreach ($channels as $channel)
                                <div class="kritik-channel-item js-card">
                                    <h3>{{ $channel['title'] }}</h3>
                                    <p>{{ $channel['desc'] }}</p>
                                    <span>{{ $channel['value'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </article>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 pb-14 lg:px-8 lg:pb-16">
                <div class="kritik-cta-box" data-kritik-fade>
                    <div>
                        <p class="kritik-info-kicker text-red-100">Komitmen Sekolah</p>
                        <h3>Kritik dan saran Anda sangat berarti bagi kami</h3>
                        <p>Setiap masukan akan membantu SDN Kragan meningkatkan layanan, komunikasi, dan kualitas pembelajaran secara bertahap.</p>
                    </div>
                    <a href="https://wa.me/62318913900?text=Halo%20Admin%20SDN%20Kragan,%20saya%20ingin%20menghubungi%20sekolah." class="kritik-cta-link" target="_blank" rel="noopener noreferrer">Hubungi Sekolah</a>
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

