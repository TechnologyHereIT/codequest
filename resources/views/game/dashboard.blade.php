@extends('layouts.app')

@section('title', 'لوحة التحكم - CodeChallenge')

<style>
    .dashboard-container {
        min-height: 100vh;
        padding: 100px 0 50px;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: 
            radial-gradient(circle at 20% 80%, rgba(99, 102, 241, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(16, 185, 129, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(245, 158, 11, 0.05) 0%, transparent 50%);
        animation: floatBackground 20s ease-in-out infinite;
    }
    
    @keyframes floatBackground {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        33% { transform: translate(30px, -30px) rotate(120deg); }
        66% { transform: translate(-20px, 20px) rotate(240deg); }
    }
    
    .hero-section {
        text-align: center;
        margin-bottom: 60px;
        position: relative;
        z-index: 2;
    }
    
    .welcome-text {
        font-size: 3.5rem;
        font-weight: 800;
        background: linear-gradient(45deg, #6366f1, #10b981, #f59e0b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 10px;
    }
    
    .subtitle {
        font-size: 1.3rem;
        color: #94a3b8;
        margin-bottom: 30px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 50px;
    }
    
    .stat-card {
        background: rgba(30, 41, 59, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 30px;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(45deg, #6366f1, #10b981);
    }
    
    .stat-card:hover {
        transform: translateY(-10px);
        border-color: #6366f1;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }
    
    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 1.8rem;
    }
    
    .stat-points { background: linear-gradient(45deg, #f59e0b, #fbbf24); }
    .stat-level { background: linear-gradient(45deg, #6366f1, #8b5cf6); }
    .stat-completed { background: linear-gradient(45deg, #10b981, #34d399); }
    .stat-progress { background: linear-gradient(45deg, #ef4444, #f87171); }
    
    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 5px;
    }
    
    .stat-label {
        color: #94a3b8;
        font-size: 1rem;
        font-weight: 500;
    }
    
    .challenges-section {
        position: relative;
        z-index: 2;
    }
    
    .section-header {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 30px;
        padding: 0 10px;
    }
    
    .section-title {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        display: flex;
        align-items: center;
    }
    
    .section-title i {
        margin-left: 15px;
        font-size: 1.5rem;
    }
    
    .difficulty-tabs {
        display: flex;
        gap: 10px;
        background: rgba(30, 41, 59, 0.7);
        padding: 8px;
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .difficulty-tab {
        padding: 10px 20px;
        border-radius: 12px;
        border: none;
        background: transparent;
        color: #94a3b8;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .difficulty-tab.active {
        background: linear-gradient(45deg, #6366f1, #8b5cf6);
        color: white;
    }
    
    .difficulty-tab:hover:not(.active) {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }
    
    .tab-count {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        padding: 2px 8px;
        font-size: 0.75rem;
        font-weight: 700;
        min-width: 24px;
        text-align: center;
    }
    
    .difficulty-tab.active .tab-count {
        background: rgba(255, 255, 255, 0.3);
    }
    
    .challenges-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 25px;
    }
    
    .challenge-card {
        background: rgba(30, 41, 59, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 25px;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .challenge-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
    }
    
    .challenge-card.easy::before { background: linear-gradient(45deg, #10b981, #34d399); }
    .challenge-card.medium::before { background: linear-gradient(45deg, #f59e0b, #fbbf24); }
    .challenge-card.hard::before { background: linear-gradient(45deg, #ef4444, #f87171); }
    
    .challenge-card:hover {
        transform: translateY(-8px);
        border-color: #6366f1;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
    }
    
    .challenge-header {
        display: flex;
        justify-content: between;
        align-items: flex-start;
        margin-bottom: 15px;
    }
    
    .challenge-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
        margin-bottom: 5px;
    }
    
    .challenge-difficulty {
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
    }
    
    .difficulty-easy { background: rgba(16, 185, 129, 0.2); color: #10b981; }
    .difficulty-medium { background: rgba(245, 158, 11, 0.2); color: #f59e0b; }
    .difficulty-hard { background: rgba(239, 68, 68, 0.2); color: #ef4444; }
    
    .challenge-description {
        color: #94a3b8;
        margin-bottom: 20px;
        line-height: 1.6;
    }
    
    .challenge-footer {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-top: auto;
    }
    
    .challenge-points {
        display: flex;
        align-items: center;
        color: #f59e0b;
        font-weight: 700;
    }
    
    .challenge-points i {
        margin-left: 5px;
    }
    
    .start-btn {
        background: linear-gradient(45deg, #6366f1, #8b5cf6);
        border: none;
        border-radius: 12px;
        padding: 10px 20px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .start-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
        color: white;
    }
    
    .completed-badge {
        background: linear-gradient(45deg, #10b981, #34d399);
        color: white;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .quick-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 40px;
    }
    
    .quick-stat {
        background: rgba(30, 41, 59, 0.5);
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .challenge-count-info {
        background: rgba(30, 41, 59, 0.8);
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .count-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #94a3b8;
        font-size: 0.9rem;
    }
    
    .count-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        color: white;
    }
    
    .count-easy { background: linear-gradient(45deg, #10b981, #34d399); }
    .count-medium { background: linear-gradient(45deg, #f59e0b, #fbbf24); }
    .count-hard { background: linear-gradient(45deg, #ef4444, #f87171); }
    
    @media (max-width: 768px) {
        .welcome-text { font-size: 2.5rem; }
        .stats-grid { grid-template-columns: 1fr; }
        .challenges-grid { grid-template-columns: 1fr; }
        .section-header { flex-direction: column; gap: 20px; }
        .difficulty-tabs { width: 100%; justify-content: center; flex-wrap: wrap; }
        .challenge-count-info { flex-direction: column; align-items: flex-start; }
    }
</style>

@section('content')
<div class="dashboard-container">
    {{-- Hero Section --}}
    <div class="container">
        <div class="hero-section" data-aos="fade-down">
            <h1 class="welcome-text">مرحباً، {{ auth()->user()->name }} 👋</h1>
            <p class="subtitle">استعد لرحلتك البرمجية وتحدى مهاراتك</p>
        </div>

        {{-- Statistics Grid --}}
        <div class="stats-grid" data-aos="fade-up">
            <div class="stat-card">
                <div class="stat-icon stat-points">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="stat-value">{{ auth()->user()->points }}</div>
                <div class="stat-label">إجمالي النقاط</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon stat-level">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-value">{{ auth()->user()->level }}</div>
                <div class="stat-label">المستوى الحالي</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon stat-completed">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value">{{ $completedCount }}</div>
                <div class="stat-label">تحديات مكتملة</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon stat-progress">
                    <i class="fas fa-flag"></i>
                </div>
                <div class="stat-value">{{ $progressPercentage }}%</div>
                <div class="stat-label">معدل الإنجاز</div>
            </div>
        </div>

        {{-- Challenges Section --}}
        <div class="challenges-section">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">
                    <i class="fas fa-gamepad"></i>
                    التحديات البرمجية
                </h2>
                
                <div class="difficulty-tabs">
                    <button class="difficulty-tab active" onclick="filterChallenges('all')">
                        الكل
                        <span class="tab-count">{{ $totalChallenges }}</span>
                    </button>
                    <button class="difficulty-tab" onclick="filterChallenges('easy')">
                        <i class="fas fa-seedling"></i>
                        مبتدئ
                        <span class="tab-count">{{ $easyCount }}</span>
                    </button>
                    <button class="difficulty-tab" onclick="filterChallenges('medium')">
                        <i class="fas fa-rocket"></i>
                        متوسط
                        <span class="tab-count">{{ $mediumCount }}</span>
                    </button>
                    <button class="difficulty-tab" onclick="filterChallenges('hard')">
                        <i class="fas fa-fire"></i>
                        متقدم
                        <span class="tab-count">{{ $hardCount }}</span>
                    </button>
                </div>
            </div>

            {{-- Challenge Count Info --}}
            <div class="challenge-count-info" data-aos="fade-up">
                <div class="count-item">
                    <span class="count-badge count-easy">{{ $easyCount }}</span>
                    <span>تحديات مبتدئ</span>
                </div>
                <div class="count-item">
                    <span class="count-badge count-medium">{{ $mediumCount }}</span>
                    <span>تحديات متوسطة</span>
                </div>
                <div class="count-item">
                    <span class="count-badge count-hard">{{ $hardCount }}</span>
                    <span>تحديات متقدمة</span>
                </div>
                <div class="count-item">
                    <span class="count-badge" style="background: linear-gradient(45deg, #6366f1, #8b5cf6);">
                        {{ $completedCount }}
                    </span>
                    <span>مكتملة من أصل {{ $totalChallenges }}</span>
                </div>
            </div>

            {{-- Challenges Grid --}}
            <div class="challenges-grid">
                @foreach($challenges as $challenge)
                <div class="challenge-card {{ $challenge->difficulty }}" 
                     data-difficulty="{{ $challenge->difficulty }}"
                     data-aos="zoom-in">
                    
                    <div class="challenge-header">
                        <div>
                            <h3 class="challenge-title">{{ $challenge->title }}</h3>
                            <br>
                            <span class="challenge-difficulty difficulty-{{ $challenge->difficulty }}" style="color:#fff">
                                @if($challenge->difficulty == 'easy')
                                <i class="fas fa-seedling me-1"></i> مبتدئ
                                @elseif($challenge->difficulty == 'medium')
                                <i class="fas fa-rocket me-1"></i> متوسط
                                @else
                                <i class="fas fa-fire me-1"></i> متقدم
                                @endif
                            </span>
                        </div>
                        &nbsp;&nbsp;
                        @if($userProgress->contains($challenge->id))
                        <span class="completed-badge">
                            <i class="fas fa-check"></i> مكتمل
                        </span>
                        @endif
                    </div>
                    
                    <p class="challenge-description">
                        {{ Str::limit($challenge->description, 120) }}
                    </p>
                    
                    <div class="challenge-footer">
                        <div class="challenge-points">
                            <i class="fas fa-star"></i>
                            {{ $challenge->points }} نقطة
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ route('challenge.show', $challenge) }}" class="start-btn">
                            @if($userProgress->contains($challenge->id))
                            <i class="fas fa-redo"></i>
                            حاول مرة أخرى
                            @else
                            <i class="fas fa-play"></i>
                            ابدأ التحدي
                            @endif
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Quick Stats --}}
            <div class="quick-stats" data-aos="fade-up">
                <div class="quick-stat">
                    <div class="text-primary mb-2">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                    <h4 class="text-white">{{ $totalChallenges }}</h4>
                    <p class="text-muted mb-0">إجمالي التحديات</p>
                </div>
                
                <div class="quick-stat">
                    <div class="text-success mb-2">
                        <i class="fas fa-bolt fa-2x"></i>
                    </div>
                    <h4 class="text-white">{{ $activeUsers }}</h4>
                    <p class="text-muted mb-0">مستخدم نشط</p>
                </div>
                
                <div class="quick-stat">
                    <div class="text-warning mb-2">
                        <i class="fas fa-code-branch fa-2x"></i>
                    </div>
                    <h4 class="text-white">{{ $totalSubmissions }}</h4>
                    <p class="text-muted mb-0">محاولات اليوم</p>
                </div>
                
                <div class="quick-stat">
                    <div class="text-info mb-2">
                        <i class="fas fa-trending-up fa-2x"></i>
                    </div>
                    <h4 class="text-white">#{{ $userRank }}</h4>
                    <p class="text-muted mb-0">تصنيفك عالمياً</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
// تصفية التحديات حسب الصعوبة
function filterChallenges(difficulty) {
    const cards = document.querySelectorAll('.challenge-card');
    const tabs = document.querySelectorAll('.difficulty-tab');
    
    // تحديث التبويبات النشطة
    tabs.forEach(tab => tab.classList.remove('active'));
    event.target.classList.add('active');
    
    // تصفية البطاقات
    cards.forEach(card => {
        if (difficulty === 'all' || card.dataset.difficulty === difficulty) {
            card.style.display = 'block';
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 50);
        } else {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.display = 'none';
            }, 300);
        }
    });
}

// تأثيرات عند التمرير
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.challenge-card');
    
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
});

// تحديث الإحصائيات في الوقت الحقيقي (محاكاة)
function updateLiveStats() {
    // يمكن إضافة تحديث حقيقي من الخادم هنا
    console.log('Updating live stats...');
}

// تحديث الإحصائيات كل 30 ثانية
setInterval(updateLiveStats, 30000);
</script>