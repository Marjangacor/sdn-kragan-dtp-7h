<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends AdminController
{
    public function index(Request $request)
    {
        $this->authorizeAdmin($request);

        return view('admin.galeri.index', [
            'galleries' => Gallery::orderBy('sort_order')->orderByDesc('event_date')->orderByDesc('created_at')->get(),
        ]);
    }

    public function create(Request $request)
    {
        $this->authorizeAdmin($request);

        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin($request);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'min:10'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,webp,gif', 'max:5120'],
            'event_date' => ['nullable', 'date'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99999'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;

        // Handle file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Store file in storage/app/public/gallery
            $path = Storage::disk('public')->putFileAs('gallery', $file, $filename);
            
            if ($path) {
                $data['image_url'] = 'storage/' . $path;
            }
        }

        Gallery::create($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Data galeri berhasil disimpan.');
    }

    public function edit(Request $request, Gallery $galeri)
    {
        $this->authorizeAdmin($request);

        return view('admin.galeri.edit', [
            'gallery' => $galeri,
        ]);
    }

    public function update(Request $request, Gallery $galeri)
    {
        $this->authorizeAdmin($request);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'min:10'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,webp,gif', 'max:5120'],
            'event_date' => ['nullable', 'date'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99999'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;

        // Handle file upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($galeri->image_url) {
                $oldPath = str_replace('storage/', '', $galeri->image_url);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Store file in storage/app/public/gallery
            $path = Storage::disk('public')->putFileAs('gallery', $file, $filename);
            
            if ($path) {
                $data['image_url'] = 'storage/' . $path;
            }
        } else {
            unset($data['image']);
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Data galeri berhasil diperbarui.');
    }

    public function destroy(Request $request, Gallery $galeri)
    {
        $this->authorizeAdmin($request);

        // Delete image file if exists
        if ($galeri->image_url) {
            $imagePath = str_replace('storage/', '', $galeri->image_url);
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Data galeri berhasil dihapus.');
    }
}
