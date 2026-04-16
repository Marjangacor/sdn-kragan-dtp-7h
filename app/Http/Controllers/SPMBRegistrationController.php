<?php

namespace App\Http\Controllers;

use App\Models\SPMBRegistration;
use Illuminate\Http\Request;

class SPMBRegistrationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_name' => ['required', 'string', 'max:255'],
            'student_email' => ['required', 'email', 'max:255'],
            'student_birthdate' => ['required', 'date', 'before:today'],
            'student_address' => ['required', 'string'],
            'parent_name' => ['required', 'string', 'max:255'],
            'parent_phone' => ['required', 'string', 'max:20'],
            'parent_email' => ['nullable', 'email', 'max:255'],
        ]);

        SPMBRegistration::create($data);

        return back()->with('success', 'Pendaftaran SPMB berhasil. Kami akan menghubungi Anda segera.');
    }
}
