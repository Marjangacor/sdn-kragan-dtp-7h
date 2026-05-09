<header class="site-header app-navbar sticky top-0 z-40">
    <div class="navbar-inner mx-auto flex max-w-7xl items-center justify-between gap-2 px-4 py-4 lg:px-8">
        <div class="header-left flex min-w-0 items-center gap-2 lg:gap-3">
            <div class="header-brand">
                <img src="{{ asset('images/logo-upt-sdn-kragan.png') }}" alt="Logo SDN Kragan" class="school-logo-img school-logo-img--small" />
                <div class="header-brand-copy">
                    <p class="brand-title text-[1.45rem] font-semibold leading-none text-slate-900">SDN Kragan</p>
                    <p class="brand-subtitle mt-1 text-xs text-slate-500">{{ $subtitle ?? 'Sekolah Dasar' }}</p>
                </div>
            </div>

            <nav class="nav-list hidden items-center gap-2 lg:flex">
                <a href="{{ url('/') }}#beranda" class="nav-chip {{ $active === 'beranda' ? 'is-active' : '' }}">Beranda</a>
                <a href="{{ url('/') }}#tentang" class="nav-chip {{ $active === 'profil' ? 'is-active' : '' }}">Profil</a>
                <a href="{{ url('/guru') }}" class="nav-chip {{ $active === 'guru' ? 'is-active' : '' }}">Guru & Karyawan</a>
                <a href="{{ url('/prestasi') }}" class="nav-chip {{ $active === 'prestasi' ? 'is-active' : '' }}">Prestasi</a>
                <a href="{{ url('/galeri') }}" class="nav-chip {{ $active === 'galeri' ? 'is-active' : '' }}">Galeri</a>
                <a href="{{ url('/ekstra') }}" class="nav-chip {{ $active === 'ekstra' ? 'is-active' : '' }}">Ekstrakurikuler</a>
                <a href="{{ url('/kritik-saran') }}" class="nav-chip {{ $active === 'kritik' ? 'is-active' : '' }}">Kritik & Saran</a>
                <a href="{{ url('/kontak') }}" class="nav-chip {{ $active === 'kontak' ? 'is-active' : '' }}">Kontak</a>
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
