@extends('layouts.app')

@section('title', $challenge->title . ' - CodeChallenge')


<style>
    .challenge-container {
        min-height: 100vh;
        padding: 100px 0 50px;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        position: relative;
        overflow: hidden;
    }
    
    .challenge-container::before {
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
    
    .timer-container {
        background: linear-gradient(45deg, rgba(30, 41, 59, 0.9), rgba(51, 65, 85, 0.9));
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 25px;
        border: 2px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    .timer-display {
        font-size: 3.5rem;
        font-weight: 800;
        font-family: 'Courier New', monospace;
        color: #10b981;
        text-shadow: 0 0 15px rgba(16, 185, 129, 0.5);
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }
    
    .timer-warning {
        color: #f59e0b !important;
        text-shadow: 0 0 15px rgba(245, 158, 11, 0.5) !important;
        animation: pulse 1s infinite;
    }
    
    .timer-danger {
        color: #ef4444 !important;
        text-shadow: 0 0 15px rgba(239, 68, 68, 0.5) !important;
        animation: pulse 0.5s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.05); }
    }
    
    .timer-info {
        display: flex;
        justify-content: space-around;
        color: #94a3b8;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }
    
    .bonus-indicator {
        background: linear-gradient(45deg, #f59e0b, #fbbf24);
        color: #000;
        padding: 8px 20px;
        border-radius: 25px;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }
    
    .time-bonus-card {
        background: rgba(245, 158, 11, 0.1);
        border: 1px solid rgba(245, 158, 11, 0.3);
        border-radius: 15px;
        padding: 15px;
        margin-top: 15px;
    }
    
    .challenge-header {
        background: rgba(30, 41, 59, 0.8);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 30px;
        backdrop-filter: blur(10px);
    }
    
    .editor-container {
        background: #1a1a1a;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        border: 1px solid #333;
        backdrop-filter: blur(10px);
    }
    
    .editor-header {
        background: #2d2d2d;
        padding: 20px;
        border-bottom: 1px solid #444;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .code-textarea {
        width: 100%;
        height: 500px;
        font-family: 'Courier New', monospace;
        font-size: 16px;
        background: #1e1e1e;
        color: #d4d4d4;
        border: none;
        padding: 25px;
        resize: none;
        line-height: 1.6;
        border-radius: 0;
        tab-size: 4;
    }
    
    .code-textarea:focus {
        outline: none;
        background: #1e1e1e;
        color: #d4d4d4;
    }
    
    .run-button {
        background: linear-gradient(45deg, #10b981, #34d399);
        border: none;
        border-radius: 12px;
        padding: 18px 30px;
        font-weight: 700;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        color: white;
        cursor: pointer;
        width: 100%;
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
    }
    
    .run-button:hover:not(:disabled) {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(16, 185, 129, 0.4);
    }
    
    .run-button:disabled {
        opacity: 0.7;
        transform: none;
        cursor: not-allowed;
    }
    
    .result-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        overflow: hidden;
        backdrop-filter: blur(10px);
    }
    
    .test-case {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 15px;
        border-left: 4px solid var(--primary);
        transition: all 0.3s ease;
    }
    
    .test-case:hover {
        transform: translateX(5px);
        background: rgba(255, 255, 255, 0.08);
    }
    
    .test-passed {
        border-left-color: #10b981;
        background: rgba(16, 185, 129, 0.1);
    }
    
    .test-failed {
        border-left-color: #ef4444;
        background: rgba(239, 68, 68, 0.1);
    }
    
    .success-animation {
        animation: success-pulse 2s ease-in-out;
    }
    
    @keyframes success-pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.02); }
        100% { transform: scale(1); }
    }
    
    .difficulty-badge {
        padding: 8px 20px;
        border-radius: 25px;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
    }
    
    .difficulty-easy {
        background: linear-gradient(45deg, #10b981, #34d399);
        color: white;
    }
    
    .difficulty-medium {
        background: linear-gradient(45deg, #f59e0b, #fbbf24);
        color: black;
    }
    
    .difficulty-hard {
        background: linear-gradient(45deg, #ef4444, #f87171);
        color: white;
    }
    
    .floating-element {
        position: absolute;
        font-family: 'Courier New', monospace;
        color: rgba(255, 255, 255, 0.03);
        font-size: 1.4rem;
        pointer-events: none;
        z-index: 0;
    }
    
    .time-up-alert {
        animation: shake 0.5s ease-in-out;
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-10px); }
        75% { transform: translateX(10px); }
    }

    @media (max-width: 768px) {
        .timer-display {
            font-size: 2.5rem;
        }
        
        .timer-info {
            flex-direction: column;
            gap: 10px;
        }
        
        .code-textarea {
            height: 400px;
            font-size: 14px;
            padding: 20px;
        }
        
        .editor-header {
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }
    }
</style>

@section('content')
<div class="challenge-container">
    {{-- عناصر عائمة في الخلفية --}}
    <div class="floating-element" style="top: 10%; left: 5%;">def solution():</div>
    <div class="floating-element" style="top: 20%; right: 8%;">return result</div>
    <div class="floating-element" style="bottom: 30%; left: 10%;">if success:</div>
    <div class="floating-element" style="bottom: 20%; right: 7%;">print("Code")</div>
    <div class="floating-element" style="top: 60%; left: 50%;">class Challenge:</div>
    
    <div class="container">
        <div class="row">
            {{-- Sidebar: Challenge Description --}}
            <div class="col-lg-5 mb-4">
                {{-- مؤقت التحدي --}}
                <div class="timer-container" data-aos="fade-down">
                    <div class="timer-display" id="timer">&nbsp;
                        {{ $challenge->getFormattedTimeLimitAttribute() }}
                    </div>
                    
                    <div class="timer-info">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clock me-2 text-primary"></i>&nbsp;
                            <span>الوقت المحدد</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-hourglass-half me-2 text-info"></i>&nbsp;
                            <span id="time-used">0:00</span>&nbsp;مستخدم
                        </div>
                        @if($challenge->bonus_points > 0)
                        <div class="d-flex align-items-center">
                            <i class="fas fa-bolt me-2 text-warning"></i>&nbsp;
                            <span id="bonus-status">+{{ $challenge->bonus_points }} مكافأة</span>
                        </div>
                        @endif
                    </div>
                    
                    @if($challenge->bonus_points > 0)
                    <div class="time-bonus-card">
                        <div class="text-center">
                            <span class="bonus-indicator">
                                <i class="fas fa-gift"></i>
                                +<span id="bonus-points">{{ $challenge->bonus_points }}</span> نقطة مكافأة
                            </span>
                        </div>
                        <small class="text-warning d-block text-center mt-2">
                            <i class="fas fa-lightbulb me-1"></i>
                            أنجز التحدي في النصف الأول من الوقت لتربح المكافأة!
                        </small>
                    </div>
                    @endif
                </div>

                <div class="challenge-header p-4" data-aos="fade-right">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h1 class="text-white fw-bold mb-2">{{ $challenge->title }}</h1>
                            <span class="difficulty-badge difficulty-{{ $challenge->difficulty }}">
                                @if($challenge->difficulty == 'easy')
                                <i class="fas fa-seedling me-1"></i> مبتدئ
                                @elseif($challenge->difficulty == 'medium')
                                <i class="fas fa-rocket me-1"></i> متوسط
                                @else
                                <i class="fas fa-fire me-1"></i> متقدم
                                @endif
                                • {{ $challenge->points }} نقاط
                            </span>
                        </div>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-arrow-right me-1"></i> العودة
                        </a>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="text-white mb-3">
                            <i class="fas fa-file-alt me-2"></i>الوصف
                        </h5>
                        <p class="text-light" style="line-height: 1.8;">{{ $challenge->description }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="text-white mb-3">
                            <i class="fas fa-tasks me-2"></i>التعليمات
                        </h5>
                        <pre class="bg-dark text-light p-3 rounded" style="white-space: pre-wrap; line-height: 1.6;">{{ $challenge->instructions }}</pre>
                    </div>
                    
                    <div>
                        <h5 class="text-white mb-3">
                            <i class="fas fa-vial me-2"></i>اختبارات المثال
                        </h5>
                        <div class="test-cases">
                            @foreach($testCases as $index => $test)
                            <div class="test-case">
                                <div class="text-primary mb-2">
                                    <small><i class="fas fa-sign-in-alt me-1"></i>الإدخال:</small>
                                </div>
                                <code class="text-light d-block mb-3 p-2 bg-dark rounded">{{ $test['input'] }}</code>
                                <div class="text-success">
                                    <small><i class="fas fa-sign-out-alt me-1"></i>المخرجات المتوقعة:</small>
                                </div>
                                <code class="text-light d-block p-2 bg-dark rounded">{{ $test['expected_output'] }}</code>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Main: Code Editor --}}
            <div class="col-lg-7">
                <div class="editor-container" data-aos="fade-left" data-aos-delay="200">
                    <div class="editor-header">
                        <div class="d-flex align-items-center">
                            <i class="fab fa-python text-success me-2 fa-lg"></i>
                            <span class="text-light fw-bold">محرر Python</span>
                            <span class="badge bg-dark ms-2">v3.0</span>
                        </div>
                        <div class="text-muted">
                            <small><i class="fas fa-lightbulb me-1"></i> اكتب الحل واضغط تشغيل</small>
                        </div>
                    </div>
                    
                    {{-- محرر نصي بسيط --}}
                    <textarea id="code-editor" class="code-textarea" 
                              placeholder="# اكتب كود Python هنا...
# مثال:
# def solution():
#     return 'Hello World'
                              
{{ $challenge->starter_code }}"></textarea>
                    
                    <div class="p-3 border-top border-dark">
                        <button id="run-btn" class="run-button">
                            <i class="fas fa-play-circle me-2"></i>
                            تشغيل الكود
                        </button>
                    </div>
                </div>
                
                {{-- Results Section --}}
                <div id="results" class="mt-4"></div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
class ChallengeTimer {
    constructor(timeLimit, bonusPoints, challengeId) {
        this.timeLimit = timeLimit;
        this.bonusPoints = bonusPoints;
        this.challengeId = challengeId;
        this.storageKey = `challenge_timer_${challengeId}`;
        this.timeUsed = 0;
        this.timerInterval = null;
        this.startTime = null;
        this.isRunning = false;
        this.isCompleted = false;
        this.timeExpired = false;
        
        this.loadTimeUsed();
    }
    
    loadTimeUsed() {
        try {
            const saved = localStorage.getItem(this.storageKey);
            if (saved) {
                const data = JSON.parse(saved);
                this.timeUsed = data.timeUsed || 0;
                this.isCompleted = data.isCompleted || false;
                this.timeExpired = data.timeExpired || false;
                
                if (this.timeUsed >= this.timeLimit) {
                    this.timeExpired = true;
                    this.isCompleted = true;
                }
            }
        } catch (e) {
            console.log('لا توجد بيانات محفوظة مسبقاً');
        }
    }
    
    saveTimeUsed() {
        const data = {
            timeUsed: this.timeUsed,
            isCompleted: this.isCompleted,
            timeExpired: this.timeExpired,
            savedAt: Date.now()
        };
        localStorage.setItem(this.storageKey, JSON.stringify(data));
    }
    
    clearSavedTime() {
        localStorage.removeItem(this.storageKey);
    }
    
    start() {
        if (this.isRunning || this.isCompleted || this.timeExpired) return;
        
        this.startTime = Date.now() - (this.timeUsed * 1000);
        this.isRunning = true;
        
        this.timerInterval = setInterval(() => {
            this.timeUsed = Math.floor((Date.now() - this.startTime) / 1000);
            this.updateDisplay();
            this.saveTimeUsed();
            
            if (this.timeUsed >= this.timeLimit) {
                this.timeUp();
            }
        }, 1000);
    }
    
    stop() {
        if (this.timerInterval) {
            clearInterval(this.timerInterval);
            this.isRunning = false;
            this.saveTimeUsed();
        }
        return this.timeUsed;
    }
    
    updateDisplay() {
        const timeLeft = this.timeLimit - this.timeUsed;
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        
        const timerElement = document.getElementById('timer');
        timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
        
        const timeUsedMinutes = Math.floor(this.timeUsed / 60);
        const timeUsedSeconds = this.timeUsed % 60;
        document.getElementById('time-used').textContent = 
            `${timeUsedMinutes}:${timeUsedSeconds.toString().padStart(2, '0')}`;
        
        this.updateBonusStatus();
        
        if (timeLeft <= 30) {
            timerElement.className = 'timer-display timer-danger';
        } else if (timeLeft <= 60) {
            timerElement.className = 'timer-display timer-warning';
        } else {
            timerElement.className = 'timer-display';
        }
    }
    
    updateBonusStatus() {
        if (this.bonusPoints > 0) {
            const bonusTimeThreshold = Math.floor(this.timeLimit * 0.5);
            const remainingBonus = this.timeUsed <= bonusTimeThreshold ? this.bonusPoints : 0;
            
            document.getElementById('bonus-points').textContent = remainingBonus;
            
            if (remainingBonus > 0) {
                document.getElementById('bonus-status').innerHTML = 
                    `<span class="text-warning">+${remainingBonus} مكافأة</span>`;
            } else {
                document.getElementById('bonus-status').innerHTML = 
                    `<span class="text-muted">انتهت المكافأة</span>`;
            }
        }
    }
    
    timeUp() {
        this.stop();
        this.timeExpired = true;
        this.isCompleted = true;
        this.saveTimeUsed();
        
        document.getElementById('timer').textContent = '00:00';
        document.getElementById('timer').className = 'timer-display timer-danger';
        
        // تعطيل زر التشغيل
        document.getElementById('run-btn').disabled = true;
        document.getElementById('run-btn').innerHTML = '<i class="fas fa-ban me-2"></i>انتهى الوقت';
        
        // إظهار رسالة انتهاء الوقت
        if (!document.querySelector('.time-up-alert')) {
            const alert = document.createElement('div');
            alert.className = 'alert alert-danger time-up-alert mt-3';
            alert.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-hourglass-end fa-2x me-3"></i>
                    <div>
                        <h5 class="mb-1">⏰ انتهى الوقت!</h5>
                        <p class="mb-0">لقد انتهى وقت هذا التحدي. لا يمكنك إرسال حلول جديدة.</p>
                    </div>
                </div>
                <div class="mt-2">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> العودة إلى القائمة
                    </a>
                </div>
            `;
            document.getElementById('results').prepend(alert);
        }
    }
    
    getBonusEarned() {
        if (this.bonusPoints === 0) return 0;
        const bonusTimeThreshold = Math.floor(this.timeLimit * 0.5);
        return this.timeUsed <= bonusTimeThreshold ? this.bonusPoints : 0;
    }
    
    getCompletedInTime() {
        return this.timeUsed <= this.timeLimit;
    }
    
    getTimeExpired() {
        return this.timeExpired;
    }
}

// تهيئة المؤقت
const timer = new ChallengeTimer({{ $challenge->time_limit }}, {{ $challenge->bonus_points }}, {{ $challenge->id }});

// تعريف دالة submitCode
function submitCode() {
    // التحقق إذا انتهى الوقت
    if (timer.getTimeExpired()) {
        document.getElementById('results').innerHTML = `
            <div class="alert alert-danger">
                <div class="d-flex align-items-center">
                    <i class="fas fa-ban fa-2x me-3"></i>
                    <div>
                        <h5 class="mb-1">غير مسموح</h5>
                        <p class="mb-0">لقد انتهى وقت هذا التحدي. لا يمكنك إرسال حلول جديدة.</p>
                    </div>
                </div>
            </div>
        `;
        return;
    }

    const timeUsed = timer.stop();
    const bonusEarned = timer.getBonusEarned();
    const completedInTime = timer.getCompletedInTime();
    const timeExpired = timer.getTimeExpired();
    
    const code = document.getElementById('code-editor').value;
    const button = document.getElementById('run-btn');
    const originalText = button.innerHTML;
    
    button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> جاري التشغيل...';
    button.disabled = true;

    document.getElementById('results').innerHTML = `
        <div class="alert alert-info">
            <div class="d-flex align-items-center">
                <i class="fas fa-spinner fa-spin me-3 fa-lg"></i>
                <div>
                    <h5 class="mb-1">جاري تشغيل الكود...</h5>
                    <p class="mb-0">يتم الآن تحليل الحل واختباره</p>
                </div>
            </div>
        </div>
    `;
    
    fetch('{{ route("challenge.submit", $challenge) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ 
            code: code,
            time_used: timeUsed,
            bonus_earned: bonusEarned,
            completed_in_time: completedInTime,
            time_expired: timeExpired
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('فشل في الاتصال بالخادم');
        }
        return response.json();
    })
    .then(data => {
        if (!data.success) {
            throw new Error(data.error || 'حدث خطأ غير معروف');
        }
        
        // إذا انتهى الوقت، لا نمسح البيانات المحفوظة
        if (!data.time_expired) {
            timer.clearSavedTime();
        }
        
        const result = data.result;
        const success = result.passed === result.total;
        
        let html = `
            <div class="result-card p-4 ${success ? 'success-animation' : ''}">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="text-white mb-0">
                        <i class="fas fa-chart-bar me-2"></i>نتائج الاختبار
                    </h4>
                    <div class="d-flex gap-2">
                        <span class="badge ${success ? 'bg-success' : 'bg-warning'} fs-6">
                            ${result.passed}/${result.total} نجحت
                        </span>
                        <span class="badge bg-info fs-6">
                            <i class="fas fa-clock me-1"></i>${data.formatted_time}
                        </span>
                    </div>
                </div>
        `;
        
        if (data.time_expired) {
            html += `
                <div class="alert alert-danger">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-ban fa-2x me-3"></i>
                        <div>
                            <h5 class="mb-1">انتهى الوقت!</h5>
                            <p class="mb-0">لقد انتهى وقت التحدي. الحل لم يتم تقييمه.</p>
                        </div>
                    </div>
                </div>
            `;
        } else if (success) {
            let pointsHtml = `
                <div class="row align-items-center">
                    <div class="col">
                        <strong>النقاط الأساسية:</strong> {{ $challenge->points }} نقطة
                    </div>
            `;
            
            if (data.bonus_earned > 0) {
                pointsHtml += `
                    <div class="col">
                        <strong class="text-warning">المكافأة:</strong> +${data.bonus_earned} نقطة 🎁
                    </div>
                    <div class="col">
                        <strong>المجموع:</strong> <span class="text-success">${data.points_earned} نقطة</span>
                    </div>
                `;
            }
            
            pointsHtml += `</div>`;
            
            html += `
                <div class="alert alert-success">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-trophy fa-2x me-3 text-warning"></i>
                        <div class="flex-grow-1">
                            <h5 class="mb-2">🎉 مبروك! لقد أكملت التحدي بنجاح!</h5>
                            ${pointsHtml}
                        </div>
                    </div>
                </div>
            `;
        } else {
            html += `
                <div class="alert alert-warning">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle fa-2x me-3"></i>
                        <div>
                            <h5 class="mb-1">⚠️ تحتاج إلى إصلاح بعض الأخطاء</h5>
                            <p class="mb-0">تحتاج إلى إصلاح ${result.total - result.passed} اختبار إضافي</p>
                        </div>
                    </div>
                </div>
            `;
        }
        
        if (result.details && Array.isArray(result.details)) {
            html += `<div class="mt-4">`;
            result.details.forEach((test, index) => {
                html += `
                    <div class="test-case ${test.passed ? 'test-passed' : 'test-failed'} mb-3">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h6 class="text-white mb-0">
                                <i class="fas fa-vial me-2"></i>اختبار #${index + 1}
                            </h6>
                            <span class="badge ${test.passed ? 'bg-success' : 'bg-danger'}">
                                ${test.passed ? '✅ نجح' : '❌ فشل'}
                            </span>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-1">الإدخال:</small>
                                <code class="text-light d-block p-2 bg-dark rounded">${test.input}</code>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-1">المتوقع:</small>
                                <code class="text-success d-block p-2 bg-dark rounded">${test.expected}</code>
                            </div>
                        </div>
                        <div class="mt-3">
                            <small class="text-muted d-block mb-1">النتيجة:</small>
                            <code class="${test.passed ? 'text-success' : 'text-danger'} d-block p-2 bg-dark rounded">${test.actual || 'لا يوجد output'}</code>
                        </div>
                    </div>
                `;
            });
            html += `</div>`;
        }
        
        html += `</div>`;
        
        document.getElementById('results').innerHTML = html;
        
        if (success && !data.time_expired) {
            setTimeout(() => {
                window.location.href = '{{ route("dashboard") }}';
            }, 4000);
        }
    })
    .catch(error => {
        document.getElementById('results').innerHTML = `
            <div class="alert alert-danger">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                    <div>
                        <h5 class="mb-1">حدث خطأ</h5>
                        <p class="mb-0">${error.message}</p>
                    </div>
                </div>
            </div>
        `;
    })
    .finally(() => {
        if (!timer.getTimeExpired()) {
            button.innerHTML = originalText;
            button.disabled = false;
        }
    });
}

// إضافة event listener للزر
document.addEventListener('DOMContentLoaded', function() {
    const runButton = document.getElementById('run-btn');
    
    // إذا انتهى الوقت، نعطل الزر مباشرة
    if (timer.getTimeExpired()) {
        runButton.disabled = true;
        runButton.innerHTML = '<i class="fas fa-ban me-2"></i>انتهى الوقت';
        
        document.getElementById('results').innerHTML = `
            <div class="alert alert-danger">
                <div class="d-flex align-items-center">
                    <i class="fas fa-hourglass-end fa-2x me-3"></i>
                    <div>
                        <h5 class="mb-1">انتهى الوقت!</h5>
                        <p class="mb-0">لقد انتهى وقت هذا التحدي. لا يمكنك إرسال حلول جديدة.</p>
                    </div>
                </div>
                <div class="mt-2">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> العودة إلى القائمة
                    </a>
                </div>
            </div>
        `;
    } else {
        runButton.addEventListener('click', submitCode);
    }
    
    // بدء المؤقت بعد تحميل الصفحة (فقط إذا لم ينتهِ الوقت)
    if (!timer.getTimeExpired()) {
        setTimeout(() => {
            timer.start();
            
            const alert = document.createElement('div');
            alert.className = 'alert alert-info alert-dismissible fade show';
            alert.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-hourglass-start fa-2x me-3"></i>
                    <div>
                        <h5 class="mb-1">بدأ التحدي! ⏱️</h5>
                        <p class="mb-0">المؤثر يعمل الآن، حاول إنهاء التحدي قبل انتهاء الوقت</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.getElementById('results').appendChild(alert);
        }, 1000);
    }
    
    window.submitCode = submitCode;
    AOS.init({ duration: 1000, once: true });
});
</script>

