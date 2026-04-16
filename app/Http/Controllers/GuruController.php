<?php

namespace App\Http\Controllers;

use App\Models\Teacher;

class GuruController extends Controller
{
    public function index()
    {
        return view('guru.index', [
            'teachers' => Teacher::orderBy('type')->orderBy('name')->get(),
        ]);
    }
}
