<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Extracurricular;
use App\Models\Feedback;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends AdminController
{
    public function index(Request $request)
    {
        $this->authorizePanelManager($request);

        $isPembinaEkstra = $request->user()->role === 'pembina-ekstra';

        // Admin dashboard - User statistics
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalPembinaEkstra = User::where('role', 'pembina-ekstra')->count();
        $totalRegularUsers = User::where('role', 'user')->count();
        $recentUsers = User::orderByDesc('created_at')->limit(5)->get();

        // Feedback statistics
        $totalFeedbacks = Feedback::count();
        $feedbackPending = Feedback::where('status', 'pending')->count();
        $feedbackByType = Feedback::groupBy('type')->selectRaw('type, count(*) as total')->get();
        $feedbackByCategory = Feedback::groupBy('category')->selectRaw('category, count(*) as total')->get();
        $recentFeedbacks = Feedback::orderByDesc('created_at')->limit(5)->get();

        // Guru / Ekstrakurikuler / Prestasi metrics
        $totalTeachers = Teacher::count();
        $totalExtracurriculars = Extracurricular::count();
        $totalAchievements = Achievement::count();
        $recentTeachers = Teacher::orderByDesc('created_at')->limit(5)->get();
        $recentExtracurriculars = Extracurricular::orderByDesc('created_at')->limit(5)->get();
        $recentAchievements = Achievement::orderByDesc('created_at')->limit(5)->get();
        
        return view('admin.dashboard', [
            'isPembinaEkstra' => $isPembinaEkstra,
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'totalPembinaEkstra' => $totalPembinaEkstra,
            'totalRegularUsers' => $totalRegularUsers,
            'recentUsers' => $recentUsers,
            'totalFeedbacks' => $totalFeedbacks,
            'feedbackPending' => $feedbackPending,
            'feedbackByType' => $feedbackByType,
            'feedbackByCategory' => $feedbackByCategory,
            'recentFeedbacks' => $recentFeedbacks,
            'totalTeachers' => $totalTeachers,
            'totalExtracurriculars' => $totalExtracurriculars,
            'totalAchievements' => $totalAchievements,
            'recentTeachers' => $recentTeachers,
            'recentExtracurriculars' => $recentExtracurriculars,
            'recentAchievements' => $recentAchievements,
        ]);
    }
}
