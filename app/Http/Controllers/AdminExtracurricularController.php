<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminExtracurricularController extends AdminController
{
    public function index(Request $request)
    {
        $this->authorizeAdmin($request);

        return view('admin.ekstra.index', [
            'activities' => Extracurricular::orderBy('title')->get(),
        ]);
    }

    public function create(Request $request)
    {
        $this->authorizeAdmin($request);

        return view('admin.ekstra.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin($request);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('ekstra', 'public');
            $data['photo_url'] = 'storage/' . $path;
        }

        unset($data['photo']);

        Extracurricular::create($data);

        return redirect()->route('admin.ekstra.index')->with('success', 'Data ekstrakurikuler berhasil disimpan.');
    }

    public function edit(Request $request, Extracurricular $ekstra)
    {
        $this->authorizeAdmin($request);

        return view('admin.ekstra.edit', [
            'activity' => $ekstra,
        ]);
    }

    public function update(Request $request, Extracurricular $ekstra)
    {
        $this->authorizeAdmin($request);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
        ]);

        if ($request->hasFile('photo')) {
            if ($ekstra->photo_url && str_starts_with($ekstra->photo_url, 'storage/')) {
                Storage::disk('public')->delete(str_replace('storage/', '', $ekstra->photo_url));
            }

            $path = $request->file('photo')->store('ekstra', 'public');
            $data['photo_url'] = 'storage/' . $path;
        } else {
            unset($data['photo']);
        }

        $ekstra->update($data);

        return redirect()->route('admin.ekstra.index')->with('success', 'Data ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy(Request $request, Extracurricular $ekstra)
    {
        $this->authorizeAdmin($request);

        $ekstra->delete();

        return redirect()->route('admin.ekstra.index')->with('success', 'Data ekstrakurikuler berhasil dihapus.');
    }
}
