<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CodeChallenge - تحديات برمجية')</title>
    
    {{-- الخطوط والمكتبات --}}
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/theme/dracula.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/theme/material-darker.min.css">
    
    {{-- الأنيميشن --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #10b981;
            --accent: #f59e0b;
            --dark: #1e293b;
            --darker: #0f172a;
            --light: #f8fafc;
            --gray: #64748b;
        }
        
        [data-theme="dark"] {
            --bg-primary: var(--darker);
            --bg-secondary: var(--dark);
            --text-primary: var(--light);
            --text-secondary: var(--gray);
        }
        
        [data-theme="light"] {
            --bg-primary: #ffffff;
            --bg-secondary: #f1f5f9;
            --text-primary: var(--dark);
            --text-secondary: var(--gray);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Tajawal', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, var(--darker) 0%, var(--dark) 100%);
            color: var(--light);
            min-height: 100vh;
            transition: all 0.3s ease;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
        }
        
        .neon-border {
            border: 2px solid transparent;
            background: linear-gradient(45deg, var(--primary), var(--secondary)) border-box;
            -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, var(--primary), var(--primary-dark));
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }
        
        .challenge-card {
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .challenge-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border-color: var(--primary);
        }
        
        .difficulty-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        
        .difficulty-easy {
            background: linear-gradient(45deg, #10b981, #34d399);
        }
        
        .difficulty-medium {
            background: linear-gradient(45deg, #f59e0b, #fbbf24);
        }
        
        .difficulty-hard {
            background: linear-gradient(45deg, #ef4444, #f87171);
        }
        
        .progress-bar-custom {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            border-radius: 10px;
            height: 8px;
        }
        
        .nav-glass {
            background: rgba(15, 23, 42, 0.8) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .code-editor-container {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }
        
        @keyframes pulse-glow {
            from { box-shadow: 0 0 20px rgba(99, 102, 241, 0.4); }
            to { box-shadow: 0 0 30px rgba(99, 102, 241, 0.8); }
        }
        
        .typewriter {
            overflow: hidden;
            border-right: 2px solid var(--primary);
            white-space: nowrap;
            animation: typing 3s steps(40, end), blink-caret 0.75s step-end infinite;
        }
        
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        
        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: var(--primary) }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    {{-- شريط التنقل --}}
    <nav class="navbar navbar-expand-lg navbar-dark nav-glass fixed-top">
        <div class="container">
         <a class="navbar-brand d-flex align-items-center fw-bold fs-3" href="{{ url('/') }}">
            <div class="pulse-glow rounded-circle bg-primary d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                <i class="fas fa-code text-white"></i>
            </div>
            Challenge<span class="text-warning">Code</span>
        </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                @auth
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('dashboard') }}">
                            <i class="fas fa-gamepad me-2"></i>&nbsp;
                            التحديات
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('leaderboard') }}">
                            <i class="fas fa-trophy me-2"></i>&nbsp;
                            المتصدرين
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('profile') }}">
                            <i class="fas fa-user me-2"></i>&nbsp;
                            ملفي
                        </a>
                    </li>
                </ul>
                
                <div class="navbar-nav ms-auto">
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                <i class="fas fa-user text-white"></i>
                            </div>&nbsp;
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><span class="dropdown-item-text">
                                <small>النقاط: <span class="text-warning">{{ auth()->user()->points }}</span></small>
                            </span></li>
                            <li><span class="dropdown-item-text">
                                <small>المستوى: <span class="text-info">{{ auth()->user()->level }}</span></small>
                            </span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>تسجيل الخروج
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    {{-- المحتوى الرئيسي --}}
    <main class="pt-5">
        @yield('content')
    </main>

    {{-- الفوتر --}}
    <footer class="bg-dark border-top border-secondary mt-5 py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center ">
                    <p class="mb-1 text-mute1d">
                        &copy; 2025 CodeChallenge. جميع الحقوق محفوظة لـ
                        <a href="https://techhereit.com" target="_blank" class="text-white text-decoration-none fw-semibold">
                            بوابة التقنية هنا | THG
                        </a>
                    </p>
                </div>
                <br><br>
                <div class="col-lg-12 text-center">
                    <p class="mb-0 text-mut1ed">
                        صنع بحب ❤️ للمبرمجين العرب
                        <span class="mx-2">|</span>
                        <a href="{{ route('terms') }}" class="text-mu1ted text-white text-decoration-none small">الشروط والأحكام</a>
                        <span class="mx-1">•</span>
                        <a href="{{ route('privacy') }}" class="text-mut1ed text-white text-decoration-none small">سياسة الخصوصية</a>
                    </p>
                </div>
            </div>
            <div class="text-center mt-3">
                <small class="text-mu1ted">
                    CodeChallenge إحدى المبادرات التعليمية المقدمة من بوابة التقنية هنا لتمكين المبرمجين العرب
                </small>
            </div>
        </div>
</footer>

    {{-- السكريبتات --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/mode/python/python.min.js"></script>
    
    <script>
        // تهيئة الأنيميشن
        AOS.init({
            duration: 1000,
            once: true
        });
        
        // إدارة الثيم
        function toggleTheme() {
            const currentTheme = document.body.getAttribute('data-theme') || 'dark';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            document.body.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        }
        
        // تحميل الثيم المحفوظ
        const savedTheme = localStorage.getItem('theme') || 'dark';
        document.body.setAttribute('data-theme', savedTheme);
    </script>
    
    @stack('scripts')
</body>
</html>