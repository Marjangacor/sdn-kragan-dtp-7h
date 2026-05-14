<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Edit Pengguna | Admin SDN Kragan</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <main class="mx-auto max-w-3xl p-6">
            <header class="mb-8 rounded-3xl bg-white p-6 shadow-lg">
                <h1 class="text-3xl font-semibold text-slate-900">Edit Pengguna</h1>
                <p class="mt-2 text-sm text-slate-600">Perbarui informasi akun dan perannya.</p>
            </header>

            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6 rounded-3xl bg-white p-6 shadow-lg">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="name">Nama</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20" />
                    @error('name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20" />
                    @error('email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="role">Peran</label>
                    <select id="role" name="role" required class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20">
                        <option value="user" @selected(old('role', $user->role) === 'user')>User</option>
                        <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
                    </select>
                    @error('role')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="password">Password Baru (opsional)</label>
                    <input id="password" name="password" type="password" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20" />
                    @error('password')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="password_confirmation">Konfirmasi Password Baru</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-[#c20f1a] focus:ring-2 focus:ring-[#c20f1a]/20" />
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.users.index') }}" class="rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">Batal</a>
                    <button type="submit" class="rounded-xl bg-[#c20f1a] px-4 py-3 text-sm font-semibold text-white hover:opacity-95">Simpan Perubahan</button>
                </div>
            </form>
        </main>
    </body>
</html>
