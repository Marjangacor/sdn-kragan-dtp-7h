@php
    use App\Models\User;
    use App\Models\Teacher;
    use App\Models\Extracurricular;
    use App\Models\Achievement;
    use App\Models\Gallery;
    
    $totalUsers = User::count();
    $totalTeachers = Teacher::count();
    $totalExtracurriculars = Extracurricular::count();
    $totalAchievements = Achievement::count();
    $totalGalleries = Gallery::count();
@endphp

<aside class="admin-sidebar rounded-3xl bg-slate-950 p-8 shadow-2xl text-white h-fit">
    <div class="space-y-8">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-slate-600">Panel Admin</p>
            <h2 class="mt-3 text-2xl font-semibold text-slate-900">Quick Access</h2>
            <p class="mt-2 text-sm text-slate-800">Akses monitoring dan CRUD fitur utama dengan cepat.</p>
        </div>

        <div class="rounded-3xl bg-slate-900/80 p-4 border border-white/10 shadow-inner">
            <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Status</p>
            <div class="mt-4 flex flex-wrap gap-2">
                <span class="inline-flex items-center rounded-full bg-emerald-500/15 px-3 py-1 text-xs font-semibold text-emerald-300">Online</span>
                <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-slate-200">{{ $totalUsers }} Akun</span>
            </div>
        </div>

        <div class="grid gap-3">
            <a href="{{ route('dashboard') }}" class="sidebar-link">Dashboard</a>
            <a href="{{ route('admin.users.index') }}" class="sidebar-link">Kelola Pengguna</a>
            <a href="{{ route('admin.feedback.index') }}" class="sidebar-link">Kelola Feedback</a>
            {{-- <a href="{{ route('admin.spmb.index') }}" class="sidebar-link">Kelola SPMB</a> --}}
            <a href="{{ route('admin.guru.index') }}" class="sidebar-link">Kelola Guru</a>
            <a href="{{ route('admin.ekstra.index') }}" class="sidebar-link">Kelola Ekstra</a>
            <a href="{{ route('admin.prestasi.index') }}" class="sidebar-link">Kelola Prestasi</a>
            <a href="{{ route('admin.galeri.index') }}" class="sidebar-link">Kelola Galeri</a>
        </div>

        <div class="rounded-3xl bg-slate-50 p-5 border border-slate-200">
            <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Ringkasan Cepat</p>
            <dl class="mt-4 space-y-3 text-sm text-slate-700">
                <div class="flex items-center justify-between">
                    <span>Guru / Karyawan</span>
                    <span class="font-semibold text-slate-900">{{ $totalTeachers }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Ekstrakurikuler</span>
                    <span class="font-semibold text-slate-900">{{ $totalExtracurriculars }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Prestasi</span>
                    <span class="font-semibold text-slate-900">{{ $totalAchievements }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Galeri</span>
                    <span class="font-semibold text-slate-900">{{ $totalGalleries }}</span>
                </div>
            </dl>
        </div>

        <div class="rounded-3xl bg-slate-50 p-5">
            <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Ringkasan</p>
            <dl class="mt-4 space-y-3 text-sm text-slate-700">
                <div class="flex items-center justify-between">
                    <span>Guru / Karyawan</span>
                    <span class="font-semibold text-slate-900">{{ $totalTeachers }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Ekstrakurikuler</span>
                    <span class="font-semibold text-slate-900">{{ $totalExtracurriculars }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Prestasi</span>
                    <span class="font-semibold text-slate-900">{{ $totalAchievements }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Galeri</span>
                    <span class="font-semibold text-slate-900">{{ $totalGalleries }}</span>
                </div>
            </dl>
        </div>
    </div>
</aside>
