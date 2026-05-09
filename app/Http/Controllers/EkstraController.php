<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;

class EkstraController extends Controller
{
    public function index()
    {
        return view('ekstra.index', [
            'activities' => Extracurricular::orderBy('title')->get(),
        ]);
    }

    public function show(Extracurricular $ekstra)
    {
        return view('ekstra.show', [
            'activity' => $ekstra,
            'relatedActivities' => Extracurricular::where('id', '!=', $ekstra->id)
                ->orderBy('title')
                ->limit(4)
                ->get(),
        ]);
    }
}
