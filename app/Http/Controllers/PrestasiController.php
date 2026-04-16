<?php

namespace App\Http\Controllers;

use App\Models\Achievement;

class PrestasiController extends Controller
{
    public function index()
    {
        return view('prestasi.index', [
            'achievements' => Achievement::orderByDesc('year')->get(),
        ]);
    }
}
