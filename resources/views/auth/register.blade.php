{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('title', 'إنشاء حساب - CodeChallenge')

<style>
    .register-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
        position: relative;
        overflow: hidden;
    }
    
    .register-container::before {
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
        animation: rotate 20s linear infinite;
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .register-card {
        background: rgba(30, 41, 59, 0.9);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 40px;
        width: 100%;
        max-width: 500px;
        position: relative;
        z-index: 1;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
    }
    
    .register-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .register-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(45deg, #6366f1, #8b5cf6);
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
        font-size: 1rem;
    }
    
    .form-control-custom:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        color: white;
    }
    
    .form-control-custom::placeholder {
        color: #94a3b8;
    }
    
    .password-strength {
        height: 4px;
        background: #374151;
        border-radius: 2px;
        margin-top: -15px;
        margin-bottom: 15px;
        overflow: hidden;
    }
    
    .password-strength-bar {
        height: 100%;
        width: 0%;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
    
    .strength-weak { background: #ef4444; width: 25%; }
    .strength-fair { background: #f59e0b; width: 50%; }
    .strength-good { background: #10b981; width: 75%; }
    .strength-strong { background: #10b981; width: 100%; }
    
    .password-requirements {
        font-size: 0.8rem;
        color: #94a3b8;
        margin-top: -10px;
        margin-bottom: 15px;
    }
    
    .requirement {
        display: flex;
        align-items: center;
        margin-bottom: 5px;
    }
    
    .requirement.valid {
        color: #10b981;
    }
    
    .requirement.invalid {
        color: #94a3b8;
    }
    
    .floating-code {
        position: absolute;
        font-family: 'Courier New', monospace;
        color: rgba(216, 216, 216, 0.87);
        font-size: 1.2rem;
        pointer-events: none;
        z-index: 0;
    }
    
    .register-btn {
        background: linear-gradient(45deg, #6366f1, #8b5cf6);
        border: none;
        border-radius: 12px;
        padding: 15px 30px;
        font-weight: 600;
        font-size: 1.1rem;
        color: white;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 10px;
    }
    
    .register-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
    }
    
    .register-btn:disabled {
        opacity: 0.7;
        transform: none;
        cursor: not-allowed;
    }
    
    .login-link {
        text-align: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .feature-list {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        padding: 20px;
        margin-top: 25px;
    }
    
    .feature-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        color: #94a3b8;
        font-size: 0.9rem;
    }
    
    .feature-item:last-child {
        margin-bottom: 0;
    }
    
    .feature-item i {
        color: #10b981;
        margin-left: 10px;
        font-size: 1rem;
    }
    
    @media (max-width: 576px) {
        .register-card {
            padding: 30px 20px;
            margin: 10px;
        }
        
        .register-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
    }
</style>

@section('content')
<div class="register-container">
    {{-- عناصر عائمة للخلفية --}}
    <div class="floating-code" style="top: 10%; left: 5%;">def challenge():</div>
    <div class="floating-code" style="top: 20%; right: 10%;">print("Hello World")</div>
    <div class="floating-code" style="bottom: 30%; left: 15%;">return solution</div>
    <div class="floating-code" style="bottom: 20%; right: 5%;">if success:</div>
    <div class="floating-code" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">class CodeChallenge:</div>
    
    <div class="register-card" data-aos="zoom-in">
        <div class="register-header">
            <div class="register-icon">
                <i class="fas fa-user-plus text-white"></i>
            </div>
            <h2 class="text-white fw-bold">انضم إلينا! 🚀</h2>
            <p class="text-muted">ابدأ رحلتك البرمجية مع CodeChallenge</p>
        </div>
        
        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div class="mb-3">
                <label class="form-label text-white">الاسم الكامل</label>
                <input type="text" class="form-control form-control-custom @error('name') is-invalid @enderror" 
                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                       placeholder="ادخل اسمك الكامل">
                @error('name')
                    <div class="invalid-feedback d-block">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-white">البريد الإلكتروني</label>
                <input type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autocomplete="email"
                       placeholder="ادخل بريدك الإلكتروني">
                @error('email')
                    <div class="invalid-feedback d-block">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-white">كلمة المرور</label>
                <input type="password" class="form-control form-control-custom @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="new-password" id="password"
                       placeholder="اختر كلمة مرور قوية">
                <div class="password-strength">
                    <div class="password-strength-bar" id="passwordStrengthBar"></div>
                </div>
                <div class="password-requirements">
                    <div class="requirement invalid" id="lengthReq">
                        <i class="fas fa-circle me-2" style="font-size: 0.5rem;"></i>
                        8 أحرف على الأقل
                    </div>
                    <div class="requirement invalid" id="numberReq">
                        <i class="fas fa-circle me-2" style="font-size: 0.5rem;"></i>
                        تحتوي على رقم
                    </div>
                    <div class="requirement invalid" id="specialReq">
                        <i class="fas fa-circle me-2" style="font-size: 0.5rem;"></i>
                        تحتوي على رمز خاص
                    </div>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label text-white">تأكيد كلمة المرور</label>
                <input type="password" class="form-control form-control-custom" 
                       name="password_confirmation" required autocomplete="new-password" id="confirmPassword"
                       placeholder="أعد إدخال كلمة المرور">
                <div class="text-muted mt-1" id="passwordMatch" style="font-size: 0.8rem; display: none;">
                    <i class="fas fa-check-circle me-1"></i>
                    كلمة المرور متطابقة
                </div>
            </div>

            <button type="submit" class="register-btn" id="submitBtn">
                <i class="fas fa-user-plus me-2"></i>
                إنشاء الحساب
            </button>

            <div class="feature-list">
                <div class="feature-item">
                    <i class="fas fa-rocket"></i>
                    <span>تحديات برمجية متنوعة المستويات</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-trophy"></i>
                    <span>نظام نقاط وتصنيف تنافسي</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-clock"></i>
                    <span>مؤقت تحدي مع مكافآت السرعة</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-users"></i>
                    <span>انضم إلى مجتمع المبرمجين</span>
                </div>
            </div>

            <div class="login-link">
                <p class="text-muted mb-0">
                    لديك حساب بالفعل؟ 
                    <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">
                        سجل الدخول الآن
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const passwordStrengthBar = document.getElementById('passwordStrengthBar');
    const passwordMatch = document.getElementById('passwordMatch');
    const submitBtn = document.getElementById('submitBtn');
    
    const lengthReq = document.getElementById('lengthReq');
    const numberReq = document.getElementById('numberReq');
    const specialReq = document.getElementById('specialReq');

    function checkPasswordStrength(password) {
        let strength = 0;
        
        // طول كلمة المرور
        if (password.length >= 8) {
            strength += 1;
            lengthReq.classList.replace('invalid', 'valid');
        } else {
            lengthReq.classList.replace('valid', 'invalid');
        }
        
        // تحتوي على أرقام
        if (/\d/.test(password)) {
            strength += 1;
            numberReq.classList.replace('invalid', 'valid');
        } else {
            numberReq.classList.replace('valid', 'invalid');
        }
        
        // تحتوي على رموز خاصة
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            strength += 1;
            specialReq.classList.replace('invalid', 'valid');
        } else {
            specialReq.classList.replace('valid', 'invalid');
        }
        
        // تحديث شريط القوة
        updateStrengthBar(strength);
        
        return strength;
    }
    
    function updateStrengthBar(strength) {
        passwordStrengthBar.className = 'password-strength-bar';
        
        if (strength === 0) {
            passwordStrengthBar.style.width = '0%';
        } else if (strength === 1) {
            passwordStrengthBar.classList.add('strength-weak');
        } else if (strength === 2) {
            passwordStrengthBar.classList.add('strength-fair');
        } else if (strength === 3) {
            passwordStrengthBar.classList.add('strength-good');
        }
    }
    
    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (confirmPassword === '') {
            passwordMatch.style.display = 'none';
            return false;
        }
        
        if (password === confirmPassword && password !== '') {
            passwordMatch.style.display = 'block';
            passwordMatch.innerHTML = '<i class="fas fa-check-circle me-1 text-success"></i> كلمة المرور متطابقة';
            return true;
        } else {
            passwordMatch.style.display = 'block';
            passwordMatch.innerHTML = '<i class="fas fa-times-circle me-1 text-danger"></i> كلمة المرور غير متطابقة';
            return false;
        }
    }
    
    function validateForm() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        const name = document.querySelector('input[name="name"]').value;
        const email = document.querySelector('input[name="email"]').value;
        
        const isPasswordStrong = checkPasswordStrength(password) >= 2;
        const isPasswordMatch = checkPasswordMatch();
        const isNameValid = name.length >= 2;
        const isEmailValid = email.includes('@') && email.includes('.');
        
        submitBtn.disabled = !(isPasswordStrong && isPasswordMatch && isNameValid && isEmailValid);
    }
    
    // event listeners
    passwordInput.addEventListener('input', function() {
        checkPasswordStrength(this.value);
        checkPasswordMatch();
        validateForm();
    });
    
    confirmPasswordInput.addEventListener('input', function() {
        checkPasswordMatch();
        validateForm();
    });
    
    document.querySelector('input[name="name"]').addEventListener('input', validateForm);
    document.querySelector('input[name="email"]').addEventListener('input', validateForm);
    
    // التحقق الأولي
    validateForm();
    
    // تأثيرات عند التحميل
    AOS.init({
        duration: 1000,
        once: true
    });
});

// منع إرسال النموذج إذا كان الزر معطل
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn.disabled) {
        e.preventDefault();
        alert('يرجى ملء جميع الحقول بشكل صحيح');
    } else {
        // إظهار رسالة تحميل
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> جاري إنشاء الحساب...';
        submitBtn.disabled = true;
    }
});
</script>
