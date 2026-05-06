<?php
// routes/web.php
use App\Http\Controllers\GameController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

// مسارات المصادقة
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [GameController::class, 'dashboard'])->name('dashboard');
    Route::get('/challenge/{challenge}', [ChallengeController::class, 'show'])->name('challenge.show');
    Route::post('/challenge/{challenge}/submit', [ChallengeController::class, 'submit'])->name('challenge.submit');
    Route::get('/leaderboard', [GameController::class, 'leaderboard'])->name('leaderboard');
    Route::get('/profile', [GameController::class, 'profile'])->name('profile');
});