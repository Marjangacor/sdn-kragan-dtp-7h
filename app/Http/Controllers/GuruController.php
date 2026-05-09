<?php

namespace App\Http\Controllers;

use App\Models\Teacher;

class GuruController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all()->sortBy(function (Teacher $teacher) {
            $subject = mb_strtoupper($teacher->subject ?? '');

            if ($teacher->type === 'Karyawan') {
                return sprintf('1-99-%s', mb_strtolower($teacher->name));
            }

            if (str_contains($subject, 'KEPALA SEKOLAH')) {
                $priority = 0;
            } elseif (str_contains($subject, 'GURU KELAS')) {
                $priority = 1;
            } elseif (str_contains($subject, 'GURU MAPEL')) {
                $priority = 2;
            } elseif (str_contains($subject, 'GURU')) {
                $priority = 3;
            } else {
                $priority = 4;
            }

            return sprintf('0-%02d-%s', $priority, mb_strtolower($teacher->name));
        })->values();

        return view('guru.index', [
            'teachers' => $teachers,
        ]);
    }

    public function show(Teacher $guru)
    {
        return view('guru.show', [
            'teacher' => $guru,
            'relatedTeachers' => Teacher::where('id', '!=', $guru->id)
                ->orderBy('type')
                ->orderBy('name')
                ->limit(4)
                ->get(),
        ]);
    }
}
