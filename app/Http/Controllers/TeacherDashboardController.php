<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Student;
use Illuminate\Http\Request;

class TeacherDashboardController extends TeacherBaseController
{
    public function index(Request $request)
    {
        $this->authorizeTeacher($request);

        $user = $request->user();
        $teacher = $user->teacher;

        if (!$teacher) {
            abort(403, 'Anda belum terdaftar sebagai guru di sistem.');
        }

        // Get teacher's students
        $students = Student::where('teacher_id', $teacher->id)->get();
        $totalStudents = $students->count();

        // Get achievements of the teacher's students
        $achievements = Achievement::whereIn('student_id', $students->pluck('id'))
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();
        $totalAchievements = Achievement::whereIn('student_id', $students->pluck('id'))->count();

        // Statistics by category
        $achievementsByCategory = Achievement::whereIn('student_id', $students->pluck('id'))
            ->groupBy('category')
            ->selectRaw('category, count(*) as total')
            ->get();

        return view('teacher.dashboard', [
            'teacher' => $teacher,
            'totalStudents' => $totalStudents,
            'students' => $students,
            'totalAchievements' => $totalAchievements,
            'recentAchievements' => $achievements,
            'achievementsByCategory' => $achievementsByCategory,
        ]);
    }
}
