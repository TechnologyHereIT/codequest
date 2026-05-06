{{-- resources/views/game/leaderboard.blade.php --}}
@extends('layouts.app')

@section('title', 'لوحة المتصدرين - CodeChallenge')

@push('styles')
<style>
    .leaderboard-container {
        min-height: 100vh;
        padding: 100px 0 50px;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    }
    
    .leaderboard-card {
        background: rgba(30, 41, 59, 0.8);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }
    
    .rank-1 {
        background: linear-gradient(45deg, rgba(245, 158, 11, 0.2), rgba(251, 191, 36, 0.1));
        border: 2px solid #f59e0b;
    }
    
    .rank-2 {
        background: linear-gradient(45deg, rgba(156, 163, 175, 0.2), rgba(209, 213, 219, 0.1));
        border: 2px solid #9ca3af;
    }
    
    .rank-3 {
        background: linear-gradient(45deg, rgba(180, 83, 9, 0.2), rgba(194, 65, 12, 0.1));
        border: 2px solid #b45309;
    }
    
    .rank-badge {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.1rem;
    }
    
    .rank-1 .rank-badge {
        background: linear-gradient(45deg, #f59e0b, #fbbf24);
        color: #000;
    }
    
    .rank-2 .rank-badge {
        background: linear-gradient(45deg, #9ca3af, #d1d5db);
        color: #000;
    }
    
    .rank-3 .rank-badge {
        background: linear-gradient(45deg, #b45309, #d97706);
        color: #fff;
    }
    
    .user-card {
        transition: all 0.3s ease;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 15px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .user-card:hover {
        transform: translateX(10px);
        background: rgba(255, 255, 255, 0.05);
    }
    
    .current-user {
        background: linear-gradient(45deg, rgba(99, 102, 241, 0.2), rgba(79, 70, 229, 0.1));
        border: 2px solid #6366f1;
    }
    
    .level-badge {
        background: linear-gradient(45deg, #6366f1, #8b5cf6);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="leaderboard-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                {{-- Header --}}
                <div class="text-center mb-5" data-aos="fade-down">
                    <div class="floating-animation mb-4">
                        <i class="fas fa-trophy fa-4x text-warning"></i>
                    </div>
                    <h1 class="text-white fw-bold mb-3">لوحة المتصدرين 🏆</h1>
                    <p class="text-muted fs-5">تصدر القائمة وأثبت مهاراتك البرمجية</p>
                </div>
                
                {{-- Top 3 --}}
                <div class="row mb-5" data-aos="fade-up">
                    @foreach($topUsers->take(3) as $index => $user)
                    <div class="col-md-4 mb-4">
                        <div class="leaderboard-card p-4 text-center rank-{{ $index + 1 }} h-100">
                            <div class="rank-badge mx-auto mb-3">
                                {{ $index + 1 }}
                            </div>
                            <div class="user-avatar mb-3">
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                                     style="width: 80px; height: 80px;">
                                    <i class="fas fa-user fa-2x text-white"></i>
                                </div>
                            </div>
                            <h5 class="text-white mb-2">{{ $user->name }}</h5>
                            <div class="level-badge d-inline-block mb-2">
                                المستوى {{ $user->level }}
                            </div>
                            <div class="points-display">
                                <h3 class="text-warning fw-bold mb-0">{{ $user->points }}</h3>
                                <small class="text-muted">نقطة</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                {{-- Rest of Leaderboard --}}
                <div class="leaderboard-card p-4" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="text-white mb-4">
                        <i class="fas fa-list-ol me-2"></i>تصنيف اللاعبين
                    </h4>
                    
                    @foreach($topUsers->slice(3) as $index => $user)
                    <div class="user-card {{ $user->id === auth()->id() ? 'current-user' : '' }}">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="rank-badge bg-dark text-white">
                                    {{ $index + 4 }}
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white mb-1">
                                            {{ $user->name }}
                                            @if($user->id === auth()->id())
                                            <span class="badge bg-primary ms-2">أنت</span>
                                            @endif
                                        </h6>
                                        <span class="level-badge">المستوى {{ $user->level }}</span>
                                    </div>
                                    <div class="text-end">
                                        <div class="h5 text-warning mb-0">{{ $user->points }}</div>
                                        <small class="text-muted">نقطة</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                {{-- User Stats --}}
                @php
                    $currentUserRank = $topUsers->search(function($user) {
                        return $user->id === auth()->id();
                    }) + 1;
                @endphp
                
                @if($currentUserRank)
                <div class="leaderboard-card p-4 mt-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="text-white mb-2">تصنيفك الحالي</h5>
                            <p class="text-muted mb-0">استمر في الحل لتصعد في التصنيف</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="d-inline-block text-center">
                                <div class="h1 text-primary fw-bold mb-0">{{ $currentUserRank }}</div>
                                <small class="text-muted">من أصل {{ $totalUsers }} لاعب</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection