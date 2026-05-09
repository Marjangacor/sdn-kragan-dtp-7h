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

    public function show(Achievement $prestasi)
    {
        return view('prestasi.show', [
            'achievement' => $prestasi,
            'relatedAchievements' => Achievement::where('id', '!=', $prestasi->id)
                ->orderByDesc('year')
                ->limit(4)
                ->get(),
        ]);
    }
}
