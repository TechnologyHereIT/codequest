@extends('layouts.app')

@section('title', 'الشروط والأحكام - CodeChallenge')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- رأس الصفحة -->
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold text-primary mb-3">الشروط والأحكام</h1>
                <p class="lead text-muted">آخر تحديث: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
            </div>

            <!-- محتوى الشروط -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <!-- مقدمة -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">مقدمة</h2>
                        <p class="text-muted">
                            مرحباً بك في منصة CodeChallenge. يرجى قراءة هذه الشروط والأحكام بعناية قبل استخدام المنصة. 
                            باستخدامك للمنصة، فإنك توافق على الالتزام بهذه الشروط والأحكام.
                        </p>
                    </section>

                    <!-- القبول -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">القبول بالشروط</h2>
                        <p class="text-muted">
                            بالوصول إلى منصة CodeChallenge واستخدامها، فإنك تقر بأنك قد قرأت وفهمت ووافقت على الالتزام 
                            بهذه الشروط والأحكام وجميع القوانين واللوائح المعمول بها.
                        </p>
                    </section>

                    <!-- الحسابات -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">الحسابات والمستخدمين</h2>
                        <div class="ps-3">
                            <h5 class="h6 text-dark mb-2">إنشاء الحساب</h5>
                            <ul class="text-muted mb-3">
                                <li>يجب أن تكون بالغاً (18 سنة فأكثر) أو لديك موافقة الوالدين</li>
                                <li>تقديم معلومات دقيقة وكاملة عند التسجيل</li>
                                <li>الحفاظ على سرية معلومات الحساب</li>
                                <li>الإبلاغ فوراً عن أي استخدام غير مصرح للحساب</li>
                            </ul>

                            <h5 class="h6 text-dark mb-2">المسؤوليات</h5>
                            <ul class="text-muted">
                                <li>أنت المسؤول الوحيد عن النشاط الذي يحدث تحت حسابك</li>
                                <li>عدم مشاركة الحساب مع أشخاص آخرين</li>
                                <li>عدم استخدام المنصة لأغراض غير قانونية</li>
                            </ul>
                        </div>
                    </section>

                    <!-- الاستخدام المقبول -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">الاستخدام المقبول</h2>
                        <p class="text-muted mb-3">يجب أن يكون استخدامك للمنصة متوافقاً مع:</p>
                        <ul class="text-muted">
                            <li>القوانين واللوائح المحلية والدولية</li>
                            <li>حقوق الملكية الفكرية</li>
                            <li>سياسات الخصوصية</li>
                            <li>المعايير الأخلاقية والمجتمعية</li>
                        </ul>
                    </section>

                    <!-- المحظورات -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">المحظورات</h2>
                        <p class="text-muted mb-3">يمنع المستخدم من:</p>
                        <ul class="text-muted">
                            <li>انتحال شخصية الآخرين أو الكيانات</li>
                            <li>نشر محتوى مسيء أو غير أخلاقي</li>
                            <li>محاولة اختراق الأنظمة أو تعطيل الخدمة</li>
                            <li>استخدام البرامج الضارة أو الروبوتات</li>
                            <li>انتهاك حقوق الملكية الفكرية</li>
                            <li>التلاعب بنتائج التحديات أو التصنيفات</li>
                        </ul>
                    </section>

                    <!-- الملكية الفكرية -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">الملكية الفكرية</h2>
                        <p class="text-muted">
                            جميع الحقوق المتعلقة بمنصة CodeChallenge بما في ذلك التصميم، الشعار، 
                            المحتوى، والتحديات البرمجية مملوكة لـ "بوابة التقنية هنا" ومحمية بموجب قوانين الملكية الفكرية.
                        </p>
                    </section>

                    <!-- التحديات البرمجية -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">التحديات البرمجية</h2>
                        <div class="ps-3">
                            <h5 class="h6 text-dark mb-2">حقوق الحلول</h5>
                            <p class="text-muted mb-3">
                                تحتفظ CodeChallenge بالحق في استخدام الحلول المقدمة من المستخدمين لأغراض تحسين الخدمة 
                                والبحث والتطوير، مع الحفاظ على خصوصية المستخدم.
                            </p>

                            <h5 class="h6 text-dark mb-2">التقييم</h5>
                            <p class="text-muted">
                                تقييم الحلول يتم تلقائياً عبر النظام، وقرارات النظام نهائية. 
                                تحتفظ CodeChallenge بالحق في مراجعة وإعادة تقييم الحلول عند الضرورة.
                            </p>
                        </div>
                    </section>

                    <!-- الإنهاء -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">إنهاء الخدمة</h2>
                        <p class="text-muted">
                            تحتفظ CodeChallenge بالحق في إنهاء أو تعليق حساب أي مستخدم ينتهك هذه الشروط 
                            دون إشعار مسبق. كما يحق للمستخدم إلغاء حسابه في أي وقت.
                        </p>
                    </section>

                    <!-- التعديلات -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">تعديل الشروط</h2>
                        <p class="text-muted">
                            تحتفظ CodeChallenge بالحق في تعديل هذه الشروط في أي وقت. 
                            سيتم إشعار المستخدمين بالتغييرات عبر البريد الإلكتروني أو عبر المنصة.
                        </p>
                    </section>

                    <!-- الإعفاء من المسؤولية -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">الإعفاء من المسؤولية</h2>
                        <p class="text-muted">
                            تقدم CodeChallenge الخدمة "كما هي" دون أي ضمانات صريحة أو ضمنية. 
                            لا تتحمل المنصة مسؤولية أي أضرار ناتجة عن استخدام الخدمة.
                        </p>
                    </section>

                    <!-- القانون المطبق -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">القانون المطبق</h2>
                        <p class="text-muted">
                            تخضع هذه الشروط والأحكام لقوانين المملكة العربية السعودية. 
                            أي نزاعات تنشأ عن هذه الشروط يتم حلها في محاكم الرياض.
                        </p>
                    </section>

                    <!-- الاتصال -->
                    <section class="mt-5 pt-4 border-top">
                        <h2 class="h4 text-dark mb-3">الاتصال بنا</h2>
                        <p class="text-muted mb-0">
                            لأي استفسارات حول هذه الشروط والأحكام، يرجى الاتصال بنا عبر:
                            <a href="mailto:info@techhereit.com" class="text-primary text-decoration-none">info@techhereit.com</a>
                        </p>
                    </section>
                </div>
            </div>

            <!-- زر العودة -->
            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-right me-2"></i>
                    العودة للرئيسية
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
    }
    
    h2, h5 {
        color: #2c3e50;
    }
    
    ul {
        padding-right: 1.5rem;
    }
    
    li {
        margin-bottom: 0.5rem;
    }
</style>
@endsection