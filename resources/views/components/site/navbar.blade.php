@props([
    'active' => null,
    'subtitle' => 'Sekolah Dasar',
])

<header class="site-header app-navbar sticky top-0 z-40">
    <div class="navbar-inner mx-auto flex max-w-7xl items-center justify-between gap-2 px-4 py-4 lg:px-8">
        <div class="header-left flex min-w-0 items-center gap-2 lg:gap-3">
            <div class="header-brand">
                <img src="{{ asset('images/logo-upt-sdn-kragan.png') }}" alt="Logo SDN Kragan" class="school-logo-img school-logo-img--small" />
                <div class="header-brand-copy">
                    <p class="brand-title text-[1.45rem] font-semibold leading-none text-slate-900">SDN Kragan</p>
                    <p class="brand-subtitle mt-1 text-xs text-slate-500">{{ $subtitle }}</p>
                </div>
            </div>

            <nav class="nav-list hidden items-center gap-2 lg:flex">
                <a href="{{ url('/') }}#beranda" class="nav-chip {{ $active === 'beranda' ? 'is-active' : '' }}">Beranda</a>
                <a href="{{ url('/guru') }}" class="nav-chip {{ $active === 'guru' ? 'is-active' : '' }}">Guru & Karyawan</a>
                <a href="{{ url('/prestasi') }}" class="nav-chip {{ $active === 'prestasi' ? 'is-active' : '' }}">Prestasi</a>
                <a href="{{ url('/galeri') }}" class="nav-chip {{ $active === 'galeri' ? 'is-active' : '' }}">Galeri</a>
                <a href="{{ url('/ekstra') }}" class="nav-chip {{ $active === 'ekstra' ? 'is-active' : '' }}">Ekstrakurikuler</a>
                <a href="{{ url('/kritik-saran') }}" class="nav-chip {{ $active === 'kritik-saran' ? 'is-active' : '' }}">Kritik & Saran</a>
                <a href="{{ url('/kontak') }}" class="nav-chip {{ $active === 'kontak' ? 'is-active' : '' }}">Kontak</a>
            </nav>
        </div>

        <div class="header-actions flex items-center gap-3">
            @if (Route::has('login'))
                @auth
                    <div class="relative hidden lg:block" data-user-menu>
                        <button
                            type="button"
                            class="top-login-btn inline-flex items-center gap-2 lg:px-5"
                            aria-haspopup="true"
                            aria-expanded="false"
                            aria-controls="userMenuDesktop"
                            data-user-menu-toggle
                        >
                            <span class="max-w-[11rem] truncate">{{ auth()->user()->name }}</span>
                            <svg viewBox="0 0 20 20" fill="none" aria-hidden="true" class="h-4 w-4 stroke-current transition-transform duration-200">
                                <path d="M5 7.5L10 12.5L15 7.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>

                        <div
                            id="userMenuDesktop"
                            class="absolute right-0 top-full z-50 mt-3 hidden w-52 overflow-hidden rounded-2xl border border-slate-200 bg-white p-2 shadow-2xl shadow-slate-900/15"
                            data-user-menu-panel
                        >
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ url('/dashboard') }}" class="flex items-center rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-100 hover:text-[#c20f1a]">Dashboard</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center rounded-xl px-4 py-3 text-left text-sm font-semibold text-slate-700 hover:bg-red-50 hover:text-[#c20f1a]">Logout</button>
                            </form>
                        </div>
                    </div>
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
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-2 shadow-sm" data-user-menu>
                    <button
                        type="button"
                        class="flex w-full items-center justify-between rounded-xl px-3 py-3 text-left text-sm font-semibold text-slate-800 hover:bg-white"
                        aria-haspopup="true"
                        aria-expanded="false"
                        aria-controls="userMenuMobile"
                        data-user-menu-toggle
                    >
                        <span class="truncate">{{ auth()->user()->name }}</span>
                        <svg viewBox="0 0 20 20" fill="none" aria-hidden="true" class="h-4 w-4 stroke-current transition-transform duration-200">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <div id="userMenuMobile" class="mt-2 hidden overflow-hidden rounded-xl bg-white" data-user-menu-panel>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ url('/dashboard') }}" class="block rounded-lg px-3 py-2 hover:bg-slate-100">Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full rounded-lg px-3 py-2 text-left text-red-600 hover:bg-red-50 font-medium">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <hr class="my-2 border-slate-200" />
                <a href="{{ route('login') }}" class="rounded-lg px-3 py-2 hover:bg-slate-100">Login</a>
            @endauth
        </div>
    </div>
</header>
