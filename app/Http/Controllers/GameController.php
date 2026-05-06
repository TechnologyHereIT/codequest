<?php
// app/Http/Controllers/GameController.php
namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function dashboard()
    {
        $challenges = Challenge::orderBy('difficulty')->get();
        $userProgress = auth()->user()->completedChallenges()->pluck('challenges.id');
        $completedCount = auth()->user()->completedChallenges()->count();
        $totalChallenges = Challenge::count();
        
        // حساب عدد التحديات لكل مستوى
        $easyCount = Challenge::where('difficulty', 'easy')->count();
        $mediumCount = Challenge::where('difficulty', 'medium')->count();
        $hardCount = Challenge::where('difficulty', 'hard')->count();
        
        // حساب نسبة التقدم
        $progressPercentage = $totalChallenges > 0 ? round(($completedCount / $totalChallenges) * 100) : 0;
        
        // إحصائيات إضافية
        $activeUsers = \App\Models\User::where('last_activity', '>=', now()->subDay())->count();
        $totalSubmissions = \App\Models\Submission::whereDate('created_at', today())->count();
        
        // ترتيب المستخدم
        $userRank = \App\Models\User::where('points', '>', auth()->user()->points)->count() + 1;

        return view('game.dashboard', compact(
            'challenges', 
            'userProgress', 
            'completedCount',
            'totalChallenges',
            'easyCount',
            'mediumCount',
            'hardCount',
            'progressPercentage',
            'activeUsers',
            'totalSubmissions',
            'userRank'
        ));
    }

    public function leaderboard()
    {
        $topUsers = \App\Models\User::orderBy('points', 'desc')
            ->orderBy('level', 'desc')
            ->orderBy('created_at')
            ->take(20)
            ->get(['id', 'name', 'points', 'level']);
            
        $totalUsers = \App\Models\User::count();

        return view('game.leaderboard', compact('topUsers', 'totalUsers'));
    }

    public function profile()
    {
        $user = auth()->user();
        $submissions = $user->submissions()->with('challenge')->latest()->take(10)->get();
        $completedCount = $user->completedChallenges()->count();
        $totalSubmissions = $user->submissions()->count();

        return view('game.profile', compact(
            'user', 
            'submissions', 
            'completedCount',
            'totalSubmissions'
        ));
    }
}