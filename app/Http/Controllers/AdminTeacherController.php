<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTeacherController extends AdminController
{
    public function index(Request $request)
    {
        $this->authorizeAdmin($request);

        return view('admin.guru.index', [
            'teachers' => Teacher::orderBy('name')->get(),
        ]);
    }

    public function create(Request $request)
    {
        $this->authorizeAdmin($request);

        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin($request);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:Guru,Karyawan'],
            'subject' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('teachers', 'public');
            $data['photo_url'] = 'storage/' . $path;
        }

        unset($data['photo']);

        Teacher::create($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil disimpan.');
    }

    public function edit(Request $request, Teacher $guru)
    {
        $this->authorizeAdmin($request);

        return view('admin.guru.edit', [
            'teacher' => $guru,
        ]);
    }

    public function update(Request $request, Teacher $guru)
    {
        $this->authorizeAdmin($request);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:Guru,Karyawan'],
            'subject' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
        ]);

        if ($request->hasFile('photo')) {
            if ($guru->photo_url && str_starts_with($guru->photo_url, 'storage/')) {
                Storage::disk('public')->delete(str_replace('storage/', '', $guru->photo_url));
            }

            $path = $request->file('photo')->store('teachers', 'public');
            $data['photo_url'] = 'storage/' . $path;
        } else {
            unset($data['photo']);
        }

        $guru->update($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Request $request, Teacher $guru)
    {
        $this->authorizeAdmin($request);

        $guru->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
