<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Extracurricular;
use App\Models\Feedback;
use App\Models\SPMBRegistration;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends AdminController
{
    public function index(Request $request)
    {
        $this->authorizeAdmin($request);

        // Admin dashboard - User statistics
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalRegularUsers = User::where('role', 'user')->count();
        $recentUsers = User::orderByDesc('created_at')->limit(5)->get();

        // Feedback statistics
        $totalFeedbacks = Feedback::count();
        $feedbackPending = Feedback::where('status', 'pending')->count();
        $feedbackByType = Feedback::groupBy('type')->selectRaw('type, count(*) as total')->get();
        $feedbackByCategory = Feedback::groupBy('category')->selectRaw('category, count(*) as total')->get();
        $recentFeedbacks = Feedback::orderByDesc('created_at')->limit(5)->get();

        // SPMB statistics
        $totalSPMB = SPMBRegistration::count();
        $spmbiPending = SPMBRegistration::where('status', 'pending')->count();
        $spmbiApproved = SPMBRegistration::where('status', 'approved')->count();
        $spmbiRejected = SPMBRegistration::where('status', 'rejected')->count();
        $recentSPMB = SPMBRegistration::orderByDesc('created_at')->limit(5)->get();

        // Guru / Ekstrakurikuler / Prestasi metrics
        $totalTeachers = Teacher::count();
        $totalExtracurriculars = Extracurricular::count();
        $totalAchievements = Achievement::count();
        $recentTeachers = Teacher::orderByDesc('created_at')->limit(5)->get();
        $recentExtracurriculars = Extracurricular::orderByDesc('created_at')->limit(5)->get();
        $recentAchievements = Achievement::orderByDesc('created_at')->limit(5)->get();
        
        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'totalRegularUsers' => $totalRegularUsers,
            'recentUsers' => $recentUsers,
            'totalFeedbacks' => $totalFeedbacks,
            'feedbackPending' => $feedbackPending,
            'feedbackByType' => $feedbackByType,
            'feedbackByCategory' => $feedbackByCategory,
            'recentFeedbacks' => $recentFeedbacks,
            'totalSPMB' => $totalSPMB,
            'spmbiPending' => $spmbiPending,
            'spmbiApproved' => $spmbiApproved,
            'spmbiRejected' => $spmbiRejected,
            'recentSPMB' => $recentSPMB,
            'totalTeachers' => $totalTeachers,
            'totalExtracurriculars' => $totalExtracurriculars,
            'totalAchievements' => $totalAchievements,
            'recentTeachers' => $recentTeachers,
            'recentExtracurriculars' => $recentExtracurriculars,
            'recentAchievements' => $recentAchievements,
        ]);
    }
}
