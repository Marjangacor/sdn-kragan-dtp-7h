<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Http\Request;

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
            'photo_url' => ['nullable', 'url', 'max:1000'],
        ]);

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
            'photo_url' => ['nullable', 'url', 'max:1000'],
        ]);

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
