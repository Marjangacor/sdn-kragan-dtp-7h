<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class TeacherController extends Controller
{
    protected function authorizeTeacher(Request $request): void
    {
        $user = $request->user();

        if (! $user || $user->role !== 'guru') {
            abort(403, 'Akses guru diperlukan.');
        }
    }
}
