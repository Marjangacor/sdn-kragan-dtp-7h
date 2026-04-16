<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

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
            'photo_url' => ['nullable', 'url', 'max:1000'],
        ]);

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
            'photo_url' => ['nullable', 'url', 'max:1000'],
        ]);

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
