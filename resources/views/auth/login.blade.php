@extends('layouts.app')

@section('title', 'تسجيل الدخول - CodeChallenge')

<style>
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
        position: relative;
        overflow: hidden;
    }
    
    .login-container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .login-card {
        background: rgba(30, 41, 59, 0.9);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 40px;
        width: 100%;
        max-width: 450px;
        position: relative;
        z-index: 1;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
    }
    
    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .login-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(45deg, #6366f1, #10b981);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2rem;
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
    }
    
    .form-control-custom {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: white;
        padding: 15px 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    
    .form-control-custom:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        color: white;
    }
    
    .floating-code {
        position: absolute;
        font-family: 'Courier New', monospace;
        color: rgba(223, 223, 223, 0.94);
        font-size: 1.2rem;
        pointer-events: none;
    }
</style>

@section('content')
<div class="login-container">
    {{-- عناصر عائمة للخلفية --}}
    <div class="floating-code" style="top: 10%; left: 10%;">def challenge():</div>
    <div class="floating-code" style="top: 20%; right: 15%;">print("Hello")</div>
    <div class="floating-code" style="bottom: 30%; left: 20%;">return result</div>
    <div class="floating-code" style="bottom: 20%; right: 10%;">if success:</div>
    
    <div class="login-card" data-aos="zoom-in">
        <div class="login-header">
            <div class="login-icon">
                <i class="fas fa-lock text-white"></i>
            </div>
            <h2 class="text-white fw-bold">مرحباً بعودتك! 👋</h2>
            <p class="text-muted">سجل الدخول لمواصلة رحلتك البرمجية</p>
        </div>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label text-white">البريد الإلكتروني</label>
                <input type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                       placeholder="ادخل بريدك الإلكتروني">
                @error('email')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label text-white">كلمة المرور</label>
                <input type="password" class="form-control form-control-custom @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="current-password"
                       placeholder="ادخل كلمة المرور">
                @error('password')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold fs-5">
                <i class="fas fa-sign-in-alt me-2"></i>
                تسجيل الدخول
            </button>

            <div class="text-center mt-4">
                <p class="text-muted">
                    ليس لديك حساب؟ 
                    <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold">
                        أنشئ حساب جديد
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection