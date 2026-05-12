<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TeacherAchievementController extends TeacherBaseController
{
    public function index(Request $request)
    {
        $this->authorizeTeacher($request);

        $user = $request->user();
        $teacher = $user->teacher;

        if (!$teacher) {
            abort(403, 'Anda belum terdaftar sebagai guru di sistem.');
        }

        $students = Student::where('teacher_id', $teacher->id)->get();
        $achievements = Achievement::whereIn('student_id', $students->pluck('id'))
            ->with('student')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('teacher.achievements.index', [
            'achievements' => $achievements,
            'teacher' => $teacher,
        ]);
    }

    public function create(Request $request)
    {
        $this->authorizeTeacher($request);

        $user = $request->user();
        $teacher = $user->teacher;

        if (!$teacher) {
            abort(403, 'Anda belum terdaftar sebagai guru di sistem.');
        }

        $students = Student::where('teacher_id', $teacher->id)->get();

        return view('teacher.achievements.create', [
            'students' => $students,
            'teacher' => $teacher,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorizeTeacher($request);

        $user = $request->user();
        $teacher = $user->teacher;

        if (!$teacher) {
            abort(403, 'Anda belum terdaftar sebagai guru di sistem.');
        }

        // Validate that the student belongs to this teacher
        $student = Student::find($request->student_id);
        if (!$student || $student->teacher_id !== $teacher->id) {
            throw ValidationException::withMessages([
                'student_id' => 'Siswa tidak ditemukan atau bukan siswa Anda.',
            ]);
        }

        $data = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'year' => ['required', 'integer', 'min:2000', 'max:2099'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $data['teacher_id'] = $teacher->id;

        Achievement::create($data);

        return redirect()->route('teacher.achievements.index')
            ->with('success', 'Prestasi siswa berhasil ditambahkan!');
    }

    public function edit(Request $request, Achievement $achievement)
    {
        $this->authorizeTeacher($request);

        $user = $request->user();
        $teacher = $user->teacher;

        if (!$teacher || $achievement->teacher_id !== $teacher->id) {
            abort(403, 'Anda tidak memiliki otorisasi untuk mengedit prestasi ini.');
        }

        $students = Student::where('teacher_id', $teacher->id)->get();

        return view('teacher.achievements.edit', [
            'achievement' => $achievement,
            'students' => $students,
            'teacher' => $teacher,
        ]);
    }

    public function update(Request $request, Achievement $achievement)
    {
        $this->authorizeTeacher($request);

        $user = $request->user();
        $teacher = $user->teacher;

        if (!$teacher || $achievement->teacher_id !== $teacher->id) {
            abort(403, 'Anda tidak memiliki otorisasi untuk mengedit prestasi ini.');
        }

        // Validate that the student belongs to this teacher
        $student = Student::find($request->student_id);
        if (!$student || $student->teacher_id !== $teacher->id) {
            throw ValidationException::withMessages([
                'student_id' => 'Siswa tidak ditemukan atau bukan siswa Anda.',
            ]);
        }

        $data = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'year' => ['required', 'integer', 'min:2000', 'max:2099'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $achievement->update($data);

        return redirect()->route('teacher.achievements.index')
            ->with('success', 'Prestasi siswa berhasil diperbarui!');
    }

    public function destroy(Request $request, Achievement $achievement)
    {
        $this->authorizeTeacher($request);

        $user = $request->user();
        $teacher = $user->teacher;

        if (!$teacher || $achievement->teacher_id !== $teacher->id) {
            abort(403, 'Anda tidak memiliki otorisasi untuk menghapus prestasi ini.');
        }

        $achievement->delete();

        return redirect()->route('teacher.achievements.index')
            ->with('success', 'Prestasi siswa berhasil dihapus!');
    }
}
