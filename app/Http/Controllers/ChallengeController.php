<?php
// app/Http/Controllers/ChallengeController.php
namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Submission;
use App\Services\CodeExecutionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
{
    public function show(Challenge $challenge)
    {
        // التحقق إذا كان المستخدم قد استنفد محاولاته لهذا التحدي
        $user = Auth::user();
        
        // البحث عن آخر محاولة انتهى وقتها
        $lastExpiredSubmission = Submission::where('user_id', $user->id)
            ->where('challenge_id', $challenge->id)
            ->where('time_expired', true)
            ->latest()
            ->first();

        // إذا كان هناك محاولة انتهى وقتها، نمنع الدخول
        if ($lastExpiredSubmission) {
            return redirect()->route('dashboard')->with('error', 'لقد انتهى وقت هذا التحدي بالفعل. لا يمكنك المحاولة مرة أخرى.');
        }

        // التحقق إذا كان المستخدم قد أكمل التحدي بنجاح
        $completedSubmission = Submission::where('user_id', $user->id)
            ->where('challenge_id', $challenge->id)
            ->where('passed_tests', '>=', \DB::raw('total_tests'))
            ->first();

        if ($completedSubmission) {
            return redirect()->route('dashboard')->with('info', 'لقد أكملت هذا التحدي بنجاح بالفعل! 🎉');
        }

        $testCases = $this->getTestCasesAsArray($challenge->test_cases);
        
        return view('game.challenge', compact('challenge', 'testCases'));
    }

    public function submit(Request $request, Challenge $challenge)
    {
        $request->validate([
            'code' => 'required|string',
            'time_used' => 'sometimes|integer',
            'bonus_earned' => 'sometimes|integer',
            'completed_in_time' => 'sometimes|boolean',
            'time_expired' => 'sometimes|boolean'
        ]);

        $user = Auth::user();

        // التحقق إذا كان الوقت قد انتهى مسبقاً
        $existingExpiredSubmission = Submission::where('user_id', $user->id)
            ->where('challenge_id', $challenge->id)
            ->where('time_expired', true)
            ->first();

        if ($existingExpiredSubmission) {
            return response()->json([
                'success' => false,
                'error' => 'لقد انتهى وقت هذا التحدي بالفعل. لا يمكنك إرسال حلول جديدة.',
                'result' => [
                    'passed' => 0,
                    'total' => 0,
                    'details' => []
                ]
            ]);
        }

        $executionService = new CodeExecutionService();
        $testCases = $this->getTestCasesAsArray($challenge->test_cases);
        
        try {
            $result = $executionService->executePython($request->code, $testCases);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'فشل تنفيذ الكود: ' . $e->getMessage(),
                'result' => [
                    'passed' => 0,
                    'total' => count($testCases),
                    'details' => []
                ]
            ]);
        }

        // حساب النقاط الإضافية والوقت
        $timeUsed = $request->time_used ?? 0;
        $bonusEarned = $request->bonus_earned ?? 0;
        $completedInTime = $request->completed_in_time ?? true;
        $timeExpired = $request->time_expired ?? false;
        $totalPoints = 0;

        // إذا انتهى الوقت، لا نمنح أي نقاط حتى لو كان الحل صحيحاً
        if ($timeExpired) {
            $totalPoints = 0;
            $bonusEarned = 0;
        } else {
            // منح النقاط إذا نجح في جميع الاختبارات
            if ($result['passed'] == $result['total'] && $result['total'] > 0) {
                $totalPoints = $challenge->points + $bonusEarned;
                $user->increment('points', $totalPoints);
                $user->completedChallenges()->syncWithoutDetaching([$challenge->id]);
                
                $this->updateUserLevel($user);
            }
        }

        // حفظ المحاولة
        $submission = Submission::create([
            'user_id' => $user->id,
            'challenge_id' => $challenge->id,
            'code' => $request->code,
            'passed_tests' => $result['passed'],
            'total_tests' => $result['total'],
            'time_taken' => $timeUsed,
            'completed_in_time' => $completedInTime,
            'bonus_earned' => $bonusEarned,
            'time_expired' => $timeExpired
        ]);

        // تنسيق الوقت للعرض
        $formattedTime = $this->formatTime($timeUsed);

        return response()->json([
            'success' => true,
            'result' => $result,
            'submission' => $submission,
            'points_earned' => $totalPoints,
            'bonus_earned' => $bonusEarned,
            'formatted_time' => $formattedTime,
            'completed_in_time' => $completedInTime,
            'time_expired' => $timeExpired
        ]);
    }

    private function updateUserLevel($user)
    {
        $completedChallenges = $user->completedChallenges()->count();
        $newLevel = min(floor($completedChallenges / 5) + 1, 10);
        
        if ($newLevel > $user->level) {
            $user->update(['level' => $newLevel]);
        }
    }

    private function formatTime($seconds)
    {
        $minutes = floor($seconds / 60);
        $seconds = $seconds % 60;
        return sprintf('%d:%02d', $minutes, $seconds);
    }

    private function getTestCasesAsArray($testCases)
    {
        if (is_array($testCases)) {
            return $testCases;
        }
        
        if (is_string($testCases)) {
            $decoded = json_decode($testCases, true);
            return is_array($decoded) ? $decoded : [];
        }
        
        return [];
    }
}