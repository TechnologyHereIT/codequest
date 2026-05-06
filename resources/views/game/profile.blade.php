{{-- resources/views/game/profile.blade.php --}}
@extends('layouts.app')

@section('title', 'ملفي - CodeChallenge')

<style>
    .profile-container {
        min-height: 100vh;
        padding: 100px 0 50px;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    }
    
    .profile-header {
        background: rgba(30, 41, 59, 0.8);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 40px;
        text-align: center;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }
    
    .stat-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.08);
    }
    
    .progress-ring {
        width: 120px;
        height: 120px;
        margin: 0 auto 20px;
    }
    
    .submission-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 15px;
        border-left: 4px solid;
        transition: all 0.3s ease;
    }
    
    .submission-card:hover {
        transform: translateX(5px);
    }
    
    .submission-success {
        border-left-color: #10b981;
        background: rgba(16, 185, 129, 0.1);
    }
    
    .submission-partial {
        border-left-color: #f59e0b;
        background: rgba(245, 158, 11, 0.1);
    }
    
    .submission-failed {
        border-left-color: #ef4444;
        background: rgba(239, 68, 68, 0.1);
    }
</style>


@section('content')
<div class="profile-container">
    <div class="container">
        {{-- Profile Header --}}
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="profile-header" data-aos="fade-down">
                    <div class="profile-avatar mb-4">
                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px;">
                            <i class="fas fa-user fa-3x text-white"></i>
                        </div>
                    </div>
                    <h1 class="text-white fw-bold mb-2">{{ $user->name }}</h1>
                    <p class="text-mut1ed mb-4">انضم في {{ $user->created_at->format('d M Y') }}</p>
                    
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="text-warning mb-2">
                                <i class="fas fa-trophy fa-2x"></i>
                            </div>
                            <h3 class="text-white fw-bold">{{ $user->points }}</h3>
                            <p class="text-mut1ed mb-0">النقاط</p>
                        </div>
                        
                        <div class="stat-card">
                            <div class="text-info mb-2">
                                <i class="fas fa-chart-line fa-2x"></i>
                            </div>
                            <h3 class="text-white fw-bold">{{ $user->level }}</h3>
                            <p class="text-mut1ed mb-0">المستوى</p>
                        </div>
                        
                        <div class="stat-card">
                            <div class="text-success mb-2">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                            <h3 class="text-white fw-bold">{{ $completedCount }}</h3>
                            <p class="text-mut1ed mb-0">تحديات مكتملة</p>
                        </div>
                        
                        <div class="stat-card">
                            <div class="text-primary mb-2">
                                <i class="fas fa-code fa-2x"></i>
                            </div>
                            <h3 class="text-white fw-bold">{{ $totalSubmissions }}</h3>
                            <p class="text-mute1d mb-0">محاولات</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Activity --}}
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="leaderboard-card p-4" data-aos="fade-up">
                    <h4 class="text-white mb-4">
                        <i class="fas fa-history me-2"></i>آخر النشاطات
                    </h4>
                    
                    @if($submissions->count() > 0)
                        @foreach($submissions as $submission)
                        <div class="submission-card 
                            @if($submission->passed_tests == $submission->total_tests) submission-success
                            @elseif($submission->passed_tests > 0) submission-partial
                            @else submission-failed @endif">
                            
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h6 class="text-white mb-1">{{ $submission->challenge->title }}</h6>
                                    <small class="text-muted">
                                        {{ $submission->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <div class="col-md-4">
                                    <div class="progress" style="height: 8px; background: rgba(255,255,255,0.1);">
                                        <div class="progress-bar progress-bar-custom" 
                                             style="width: {{ ($submission->passed_tests / $submission->total_tests) * 100 }}%">
                                        </div>
                                    </div>
                                    <small class="text-white">
                                        {{ $submission->passed_tests }}/{{ $submission->total_tests }}
                                    </small>
                                </div>
                                <div class="col-md-2 text-end">
                                    @if($submission->passed_tests == $submission->total_tests)
                                    <span class="badge bg-success">مكتمل</span>
                                    @elseif($submission->passed_tests > 0)
                                    <span class="badge bg-warning">جزئي</span>
                                    @else
                                    <span class="badge bg-danger">فاشل</span>
                                    @endif
                                </div>
                                &nbsp;&nbsp;&nbsp;
                                @if($submission->time_taken)
                                <div class="text-mute1d small">
                                    <i class="fas fa-clock me-1"></i>
                                    الوقت: {{ $submission->formatted_time_taken }}
                                     &nbsp;&nbsp;&nbsp;
                                    @if($submission->bonus_earned > 0)
                                    <span class="text-warning ms-2">
                                        +{{ $submission->bonus_earned }} 🎁
                                    </span>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">لا توجد نشاطات سابقة</p>
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                ابدأ أول تحدي لك
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection