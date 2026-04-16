<?php

namespace App\Http\Controllers;

use App\Models\SPMBRegistration;
use Illuminate\Http\Request;

class AdminSPMBRegistrationController extends AdminController
{
    public function index(Request $request)
    {
        $this->authorizeAdmin($request);

        return view('admin.spmb.index', [
            'registrations' => SPMBRegistration::orderByDesc('created_at')->get(),
        ]);
    }

    public function create(Request $request)
    {
        $this->authorizeAdmin($request);

        return view('admin.spmb.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin($request);

        $data = $request->validate([
            'student_name' => ['required', 'string', 'max:255'],
            'student_email' => ['required', 'email', 'max:255'],
            'student_birthdate' => ['required', 'date', 'before:today'],
            'student_address' => ['required', 'string'],
            'parent_name' => ['required', 'string', 'max:255'],
            'parent_phone' => ['required', 'string', 'max:20'],
            'parent_email' => ['nullable', 'email', 'max:255'],
            'status' => ['nullable', 'in:pending,approved,rejected'],
        ]);

        SPMBRegistration::create(array_merge($data, ['status' => $data['status'] ?? 'pending']));

        return redirect()->route('admin.spmb.index')->with('success', 'Pendaftaran SPMB berhasil ditambahkan.');
    }

    public function edit(Request $request, SPMBRegistration $registration)
    {
        $this->authorizeAdmin($request);

        return view('admin.spmb.edit', [
            'registration' => $registration,
        ]);
    }

    public function update(Request $request, SPMBRegistration $registration)
    {
        $this->authorizeAdmin($request);

        $data = $request->validate([
            'student_name' => ['required', 'string', 'max:255'],
            'student_email' => ['required', 'email', 'max:255'],
            'student_birthdate' => ['required', 'date', 'before:today'],
            'student_address' => ['required', 'string'],
            'parent_name' => ['required', 'string', 'max:255'],
            'parent_phone' => ['required', 'string', 'max:20'],
            'parent_email' => ['nullable', 'email', 'max:255'],
            'status' => ['required', 'in:pending,approved,rejected'],
        ]);

        $registration->update($data);

        return redirect()->route('admin.spmb.index')->with('success', 'Data pendaftar SPMB berhasil diperbarui.');
    }

    public function destroy(Request $request, SPMBRegistration $registration)
    {
        $this->authorizeAdmin($request);

        $registration->delete();

        return redirect()->route('admin.spmb.index')->with('success', 'Pendaftaran SPMB berhasil dihapus.');
    }
}
