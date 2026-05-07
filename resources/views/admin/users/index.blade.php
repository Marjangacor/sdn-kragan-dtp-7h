<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Kelola Pengguna | Admin SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <main class="mx-auto max-w-7xl p-6 grid gap-6 lg:grid-cols-[280px_1fr]">
            @include('components.admin-sidebar')

            <div class="space-y-6">
            <header class="mb-8 rounded-3xl bg-white p-6 shadow-lg">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm uppercase tracking-[0.25em] text-orange-500">Admin Panel</p>
                        <h1 class="mt-2 text-3xl font-semibold text-slate-900">Kelola Pengguna</h1>
                        <p class="mt-2 text-sm text-slate-600">Tambah, edit, atau hapus akun pengguna dan admin.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Dashboard</a>
                        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center rounded-xl bg-[#c20f1a] px-4 py-3 text-sm font-semibold text-white transition hover:opacity-95">Tambah Pengguna</a>
                    </div>
                </div>
            </header>

            @if(session('success'))
                <div class="mb-6 rounded-3xl bg-emerald-100 p-5 text-emerald-900 shadow-sm">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-6 rounded-3xl bg-red-100 p-5 text-red-900 shadow-sm">{{ session('error') }}</div>
            @endif

            <div class="overflow-hidden rounded-3xl bg-white shadow-lg">
                <table class="w-full divide-y divide-slate-200 text-left text-sm">
                    <thead class="bg-slate-50 text-slate-700">
                        <tr>
                            <th class="px-6 py-4 font-medium">Nama</th>
                            <th class="px-6 py-4 font-medium">Email</th>
                            <th class="px-6 py-4 font-medium">Peran</th>
                            <th class="px-6 py-4 font-medium">Terdaftar</th>
                            <th class="px-6 py-4 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($users as $user)
                            <tr>
                                <td class="px-6 py-4 text-slate-900">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-slate-900">{{ ucfirst($user->role) }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-slate-900">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="rounded-xl bg-slate-900 px-3 py-2 text-xs font-semibold text-white hover:bg-slate-800">Edit</a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-xl bg-red-600 px-3 py-2 text-xs font-semibold text-white hover:bg-red-700">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-slate-500">Belum ada data pengguna.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>
