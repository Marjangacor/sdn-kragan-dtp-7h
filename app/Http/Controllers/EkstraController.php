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
}
