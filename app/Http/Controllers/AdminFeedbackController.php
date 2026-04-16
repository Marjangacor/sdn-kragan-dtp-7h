<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminFeedbackController extends AdminController
{
    public function index(Request $request)
    {
        $this->authorizeAdmin($request);

        return view('admin.feedback.index', [
            'feedbacks' => Feedback::orderByDesc('created_at')->get(),
        ]);
    }

    public function create(Request $request)
    {
        $this->authorizeAdmin($request);

        return view('admin.feedback.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin($request);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'category' => ['required', 'in:pembelajaran,fasilitas,pelayanan_administrasi,lainnya'],
            'type' => ['required', 'in:saran,kritik,pujian'],
            'message' => ['required', 'string', 'min:10'],
            'status' => ['nullable', 'in:pending,read,replied'],
        ]);

        Feedback::create(array_merge($data, ['status' => $data['status'] ?? 'pending']));

        return redirect()->route('admin.feedback.index')->with('success', 'Feedback berhasil ditambahkan.');
    }

    public function edit(Request $request, Feedback $feedback)
    {
        $this->authorizeAdmin($request);

        return view('admin.feedback.edit', [
            'feedback' => $feedback,
        ]);
    }

    public function update(Request $request, Feedback $feedback)
    {
        $this->authorizeAdmin($request);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'category' => ['required', 'in:pembelajaran,fasilitas,pelayanan_administrasi,lainnya'],
            'type' => ['required', 'in:saran,kritik,pujian'],
            'message' => ['required', 'string', 'min:10'],
            'status' => ['required', 'in:pending,read,replied'],
        ]);

        $feedback->update($data);

        return redirect()->route('admin.feedback.index')->with('success', 'Feedback berhasil diperbarui.');
    }

    public function destroy(Request $request, Feedback $feedback)
    {
        $this->authorizeAdmin($request);

        $feedback->delete();

        return redirect()->route('admin.feedback.index')->with('success', 'Feedback berhasil dihapus.');
    }
}
