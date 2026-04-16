<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AdminAchievementController extends AdminController
{
    public function index(Request $request)
    {
        $this->authorizeAdmin($request);

        return view('admin.prestasi.index', [
            'achievements' => Achievement::orderByDesc('year')->get(),
        ]);
    }

    public function create(Request $request)
    {
        $this->authorizeAdmin($request);

        return view('admin.prestasi.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin($request);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:10'],
            'description' => ['required', 'string', 'min:10'],
            'image_url' => ['nullable', 'url', 'max:1000'],
        ]);

        Achievement::create($data);

        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi berhasil disimpan.');
    }

    public function edit(Request $request, Achievement $prestasi)
    {
        $this->authorizeAdmin($request);

        return view('admin.prestasi.edit', [
            'achievement' => $prestasi,
        ]);
    }

    public function update(Request $request, Achievement $prestasi)
    {
        $this->authorizeAdmin($request);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:10'],
            'description' => ['required', 'string', 'min:10'],
            'image_url' => ['nullable', 'url', 'max:1000'],
        ]);

        $prestasi->update($data);

        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi berhasil diperbarui.');
    }

    public function destroy(Request $request, Achievement $prestasi)
    {
        $this->authorizeAdmin($request);

        $prestasi->delete();

        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi berhasil dihapus.');
    }
}
