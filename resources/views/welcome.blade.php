{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('title', 'مرحباً بك في CodeChallenge - تحديات برمجية تفاعلية')

<style>
    :root {
        --primary: #6366f1;
        --primary-dark: #4f46e5;
        --secondary: #10b981;
        --accent: #f59e0b;
        --dark: #0f172a;
        --darker: #020617;
        --light: #f8fafc;
        --text: #e2e8f0;
        --text-muted: #94a3b8;
    }
    
    .welcome-container {
        min-height: 100vh;
        background: linear-gradient(135deg, var(--darker) 0%, var(--dark) 50%, #1e293b 100%);
        position: relative;
        overflow: hidden;
        font-family: system-ui, -apple-system, sans-serif;
    }
    
    /* تأثيرات الخلفية */
    .bg-animation {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }
    
    .bg-circle {
        position: absolute;
        border-radius: 50%;
        background: radial-gradient(circle, var(--primary) 0%, transparent 70%);
        opacity: 0.1;
        animation: float 20s infinite linear;
    }
    
    .circle-1 {
        width: 300px;
        height: 300px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }
    
    .circle-2 {
        width: 200px;
        height: 200px;
        top: 60%;
        right: 10%;
        animation-delay: 5s;
        background: radial-gradient(circle, var(--secondary) 0%, transparent 70%);
    }
    
    .circle-3 {
        width: 250px;
        height: 250px;
        bottom: 20%;
        left: 20%;
        animation-delay: 10s;
        background: radial-gradient(circle, var(--accent) 0%, transparent 70%);
    }
    
    @keyframes float {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -30px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
    }
    
    /* قسم البطل */
    .hero-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        z-index: 2;
        padding: 2rem 0;
    }
    
    .hero-content {
        text-align: center;
        color: white;
        position: relative;
        z-index: 3;
    }
    
    .hero-title {
        font-size: 4rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        background: linear-gradient(45deg, var(--primary), var(--secondary), var(--accent));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
        color: var(--text);
        margin-bottom: 2.5rem;
        line-height: 1.6;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .cta-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-bottom: 3rem;
        flex-wrap: wrap;
    }
    
    .btn-hero {
        padding: 12px 30px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        cursor: pointer;
    }
    
    .btn-primary-hero {
        background: linear-gradient(45deg, var(--primary), var(--primary-dark));
        color: white;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
    }
    
    .btn-primary-hero:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        color: white;
    }
    
    .btn-outline-hero {
        background: transparent;
        color: var(--text);
        border: 2px solid var(--primary);
    }
    
    .btn-outline-hero:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
    }
    
    .tech-badge {
        background: linear-gradient(45deg, var(--secondary), #34d399);
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 2rem;
    }
    
    /* قسم الميزات */
    .features-section {
        padding: 80px 0;
        background: rgba(15, 23, 42, 0.7);
        position: relative;
        z-index: 2;
    }
    
    .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 3rem;
    }
    
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }
    
    .feature-card {
        background: rgba(30, 41, 59, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        border-color: var(--primary);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    .feature-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(45deg, var(--primary), var(--primary-dark));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 1.8rem;
        color: white;
    }
    
    .feature-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: white;
        margin-bottom: 1rem;
    }
    
    .feature-description {
        color: var(--text-muted);
        line-height: 1.6;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }
    
    .stat-card {
        text-align: center;
        padding: 1.5rem;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        color: var(--text-muted);
        font-size: 0.9rem;
    }
    
    /* قسم التقنية */
    .tech-section {
        padding: 80px 0;
        background: rgba(30, 41, 59, 0.5);
        position: relative;
        z-index: 2;
    }
    
    .tech-content {
        display: flex;
        flex-direction: column;
        gap: 3rem;
    }
    
    @media (min-width: 992px) {
        .tech-content {
            flex-direction: row;
            align-items: center;
        }
    }
    
    .tech-visual {
        flex: 1;
    }
    
    .code-window {
        background: #1e1e1e;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        font-family: 'Courier New', monospace;
    }
    
    .window-header {
        background: #2d2d2d;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        border-bottom: 1px solid #404040;
    }
    
    .window-button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }
    
    .red { background: #ff5f56; }
    .yellow { background: #ffbd2e; }
    .green { background: #27c93f; }
    
    .window-title {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-left: 10px;
    }
    
    .code-content {
        padding: 20px;
        color: #d4d4d4;
        line-height: 1.5;
        font-size: 0.9rem;
    }
    
    .code-keyword { color: #569cd6; }
    .code-function { color: #dcdcaa; }
    .code-string { color: #ce9178; }
    .code-comment { color: #6a9955; }
    
    .tech-info {
        flex: 1;
    }
    
    .tech-features {
        list-style: none;
        padding: 0;
        margin-top: 1.5rem;
    }
    
    .tech-features li {
        color: var(--text);
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .tech-features li i {
        color: var(--secondary);
    }
    
    /* قسم التحديات */
    .challenge-section {
        padding: 80px 0;
        background: rgba(15, 23, 42, 0.7);
        position: relative;
        z-index: 2;
    }
    
    .challenge-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }
    
    .challenge-card {
        background: rgba(30, 41, 59, 0.6);
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }
    
    .challenge-card:hover {
        transform: translateY(-5px);
        border-color: var(--primary);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    
    .challenge-level {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .level-beginner { background: rgba(16, 185, 129, 0.2); color: var(--secondary); }
    .level-intermediate { background: rgba(245, 158, 11, 0.2); color: var(--accent); }
    .level-advanced { background: rgba(239, 68, 68, 0.2); color: #ef4444; }
    
    .challenge-title {
        color: white;
        font-size: 1.2rem;
        margin-bottom: 0.8rem;
    }
    
    .challenge-description {
        color: var(--text-muted);
        line-height: 1.5;
        margin-bottom: 1.2rem;
        font-size: 0.9rem;
    }
    
    .challenge-meta {
        display: flex;
        justify-content: space-between;
        color: var(--text-muted);
        font-size: 0.8rem;
    }
    
    /* قسم عن بوابة التقنية */
    .about-section {
        padding: 80px 0;
        background: rgba(15, 23, 42, 0.8);
        position: relative;
        z-index: 2;
    }
    
    .about-card {
        background: rgba(30, 41, 59, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        padding: 2.5rem;
        text-align: center;
    }
    
    .thg-logo {
        width: 180px;
        margin: 0 auto 2rem;
    }
    
    .thg-logo img {
        max-width: 100%;
        height: auto;
    }
    
    .about-title {
        color: white;
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }
    
    .about-description {
        color: var(--text);
        line-height: 1.6;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .about-features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .about-feature {
        text-align: center;
        padding: 1rem;
    }
    
    .about-feature i {
        font-size: 2rem;
        margin-bottom: 0.8rem;
        color: var(--primary);
    }
    
    .about-feature h4 {
        color: white;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }
    
    .about-feature p {
        color: var(--text-muted);
        font-size: 0.9rem;
    }
    
    /* التكيف مع الشاشات الصغيرة */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.1rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .btn-hero {
            width: 100%;
            max-width: 250px;
            justify-content: center;
        }
        
        .features-grid,
        .challenge-cards {
            grid-template-columns: 1fr;
        }
        
        .about-card {
            padding: 1.5rem;
        }
    }
</style>

@section('content')
<div class="welcome-container">
    <!-- تأثيرات الخلفية -->
    <div class="bg-animation">
        <div class="bg-circle circle-1"></div>
        <div class="bg-circle circle-2"></div>
        <div class="bg-circle circle-3"></div>
    </div>
    
    <!-- قسم البطل -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">CodeChallenge</h1>
                
                <p class="hero-subtitle">
                    منصة تحديات برمجية تفاعلية تختبر مهاراتك في البرمجة بلغة Python
                    <br>
                    تحدٍ، تعلم، تطور - كل ذلك في بيئة تنافسية مشوقة
                    <br>
                    وهي من انتاج بوابة التقنية هنا | THG
                </p>
                
                <div class="cta-buttons">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-hero btn-primary-hero">
                            <i class="fas fa-play-circle"></i>
                            ابدأ التحديات
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn-hero btn-primary-hero">
                            <i class="fas fa-user-plus"></i>
                            انضم إلينا
                        </a>
                        <a href="{{ route('login') }}" class="btn-hero btn-outline-hero">
                            <i class="fas fa-sign-in-alt"></i>
                            تسجيل الدخول
                        </a>
                    @endauth
                </div>
                
                <div class="tech-badge">
                    <i class="fab fa-python"></i>
                    Python 3 - لغة البرمجة المستخدمة
                </div>
            </div>
        </div>
    </section>

    <!-- قسم الميزات -->
    <section id="features" class="features-section">
        <div class="container">
            <h2 class="section-title">ماذا تقدم CodeChallenge؟</h2>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3 class="feature-title">تحديات برمجية متنوعة</h3>
                    <p class="feature-description">
                        20+ تحدي برمجي بمستويات صعوبة مختلفة، من المبتدئ إلى المحترف. 
                        كل تحدي مصمم لاختبار مهارات برمجية محددة.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="feature-title">نظام الوقت والمكافآت</h3>
                    <p class="feature-description">
                        مؤقت تنازلي لكل تحدي مع نقاط مكافأة للإنجاز السريع. 
                        اختبر سرعتك ودقتك تحت الضغط.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3 class="feature-title">لوحة متصدرين تنافسية</h3>
                    <p class="feature-description">
                        تصدر القائمة وتنافس مع المبرمجين الآخرين. 
                        نظام نقاط ومستويات يحفز على التطور المستمر.
                    </p>
                </div>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">20+</div>
                    <div class="stat-label">تحدي برمجي</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">3</div>
                    <div class="stat-label">مستويات صعوبة</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">⏱️</div>
                    <div class="stat-label">نظام الوقت</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">🎯</div>
                    <div class="stat-label">تقييم فوري</div>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم التقنية -->
    <section class="tech-section">
        <div class="container">
            <h2 class="section-title">لغة البرمجة المستخدمة</h2>
            
            <div class="tech-content">
                <div class="tech-visual">
                    <div class="code-window">
                        <div class="window-header">
                            <div class="window-button red"></div>
                            <div class="window-button yellow"></div>
                            <div class="window-button green"></div>
                            <div class="window-title">challenge.py</div>
                        </div>
                        <div class="code-content">
                            <div><span class="code-keyword">def</span> <span class="code-function">find_max</span>(numbers):</div>
                            <div>&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-keyword">if</span> <span class="code-keyword">not</span> numbers:</div>
                            <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-keyword">return</span> <span class="code-keyword">None</span></div>
                            <div>&nbsp;&nbsp;&nbsp;&nbsp;</div>
                            <div>&nbsp;&nbsp;&nbsp;&nbsp;max_num = numbers[0]</div>
                            <div>&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-keyword">for</span> num <span class="code-keyword">in</span> numbers:</div>
                            <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-keyword">if</span> num > max_num:</div>
                            <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;max_num = num</div>
                            <div>&nbsp;&nbsp;&nbsp;&nbsp;</div>
                            <div>&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-keyword">return</span> max_num</div>
                            <div></div>
                            <div><span class="code-comment"># اختبار الدالة</span></div>
                            <div>numbers = [3, 7, 2, 9, 1, 5]</div>
                            <div>result = find_max(numbers)</div>
                            <div>print(<span class="code-string">f"القيمة الأكبر هي: {result}"</span>)</div>
                        </div>
                    </div>
                </div>
                
                <div class="tech-info">
                    <h3 class="text-white mb-3">Python 3 - لغة المستقبل</h3>
                    <p class="text-light mb-3">
                        بايثون هي لغة البرمجة الأكثر شيوعاً في التعليم والتطبيقات العملية، 
                        تجمع بين البساطة والقوة مما يجعلها مثالية للمبتدئين والمحترفين.
                    </p>
                    
                    <ul class="tech-features">
                        <li><i class="fas fa-check"></i> سهلة التعلم للمبتدئين</li>
                        <li><i class="fas fa-check"></i> قوية للمحترفين</li>
                        <li><i class="fas fa-check"></i> تركيب واضح ومفهوم</li>
                        <li><i class="fas fa-check"></i> مجتمع داعم كبير</li>
                        <li><i class="fas fa-check"></i> مناسبة لمشاريع متنوعة</li>
                        <li><i class="fas fa-check"></i> لغة المستقبل في الذكاء الاصطناعي</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم التحديات -->
    <section class="challenge-section">
        <div class="container">
            <h2 class="section-title">أنواع التحديات</h2>
            
            <div class="challenge-cards">
                <div class="challenge-card">
                    <span class="challenge-level level-beginner">مبتدئ</span>
                    <h3 class="challenge-title">أساسيات البرمجة</h3>
                    <p class="challenge-description">
                        تحديات مثالية للمبتدئين لتعلم الأساسيات مثل المتغيرات، 
                        الشروط، الحلقات، والدوال البسيطة.
                    </p>
                </div>
                
                <div class="challenge-card">
                    <span class="challenge-level level-intermediate">متوسط</span>
                    <h3 class="challenge-title">هياكل البيانات</h3>
                    <p class="challenge-description">
                        تحديات متوسطة الصعوبة تركز على هياكل البيانات مثل القوائم، 
                        القواميس، والمجموعات والخوارزميات الأساسية.
                    </p>
                </div>
                
                <div class="challenge-card">
                    <span class="challenge-level level-advanced">متقدم</span>
                    <h3 class="challenge-title">الخوارزميات المعقدة</h3>
                    <p class="challenge-description">
                        تحديات متقدمة للمبرمجين المحترفين تشمل خوارزميات البحث والترتيب 
                        المعقدة وحل المشكلات البرمجية المتقدمة.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم عن بوابة التقنية -->
    <section class="about-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="about-card">
                        <div class="thg-logo">
                            <img src="{{ asset('images/Logo-only.png') }}" alt="بوابة التقنية هنا | Tech Here Gate" onerror="this.style.display='none'">
                        </div>
                        
                        <h3 class="about-title">بوابة التقنية هنا | THG</h3>
                        
                        <p class="about-description">
                            منصة رائدة في مجال التقنية والتعليم البرمجي، تهدف إلى تمكين المبرمجين العرب 
                            وتطوير مهاراتهم من خلال أدوات وتطبيقات مبتكرة.
                        </p>
                        
                        <div class="about-features">
                            <div class="about-feature">
                                <i class="fas fa-rocket"></i>
                                <h4>رؤيتنا</h4>
                                <p>الريادة في التعليم البرمجي التفاعلي</p>
                            </div>
                            
                            <div class="about-feature">
                                <i class="fas fa-bullseye"></i>
                                <h4>هدفنا</h4>
                                <p>تمكين المبرمجين من خلال أدوات عملية</p>
                            </div>
                            
                            <div class="about-feature">
                                <i class="fas fa-users"></i>
                                <h4>مجتمعنا</h4>
                                <p>أكثر من 10,000 مبرمج عربي</p>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="https://techhereit.com" target="_blank" class="btn-hero btn-primary-hero">
                                <i class="fas fa-external-link-alt"></i>
                                زر موقعنا الرسمي
                            </a>
                        </div>
                        
                        <div class="text-center mt-4">
                            <small class="text-muted">
                                CodeQuest هي إحدى الأدوات التعليمية التي تطورها بوابة التقنية هنا 
                                لخدمة المجتمع البرمجي العربي
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // تأثيرات بسيطة عند التمرير
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // تطبيق التأثيرات على العناصر
    document.querySelectorAll('.feature-card, .challenge-card, .stat-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(card);
    });
    
    // تأثيرات الأزرار
    document.querySelectorAll('.btn-hero').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // تأثيرات الكروت
    document.querySelectorAll('.feature-card, .challenge-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>