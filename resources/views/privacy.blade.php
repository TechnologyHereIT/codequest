@extends('layouts.app')

@section('title', 'سياسة الخصوصية - CodeChallenge')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- رأس الصفحة -->
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold text-primary mb-3">سياسة الخصوصية</h1>
                <p class="lead text-muted">آخر تحديث: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
            </div>

            <!-- محتوى السياسة -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <!-- مقدمة -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">مقدمة</h2>
                        <p class="text-muted">
                            في CodeChallenge، نعتبر خصوصيتك أمراً بالغ الأهمية. تشرح سياسة الخصوصية هذه كيفية جمعنا 
                            واستخدامنا وحماية معلوماتك الشخصية عند استخدامك لمنصتنا.
                        </p>
                    </section>

                    <!-- المعلومات التي نجمعها -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">المعلومات التي نجمعها</h2>
                        <div class="ps-3">
                            <h5 class="h6 text-dark mb-2">المعلومات الشخصية</h5>
                            <ul class="text-muted mb-3">
                                <li>الاسم الكامل</li>
                                <li>عنوان البريد الإلكتروني</li>
                                <li>كلمة المرور (مشفرة)</li>
                                <li>معلومات الملف الشخصي (اختياري)</li>
                            </ul>

                            <h5 class="h6 text-dark mb-2">معلومات الاستخدام</h5>
                            <ul class="text-muted">
                                <li>سجل التحديات المكتملة</li>
                                <li>نتائج التقييم</li>
                                <li>وقت الاستخدام</li>
                                <li>الأخطاء البرمجية</li>
                                <li>التفاعلات مع المنصة</li>
                            </ul>
                        </div>
                    </section>

                    <!-- كيفية استخدام المعلومات -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">كيفية استخدام المعلومات</h2>
                        <p class="text-muted mb-3">نستخدم معلوماتك للأغراض التالية:</p>
                        <ul class="text-muted">
                            <li>توفير وتحسين الخدمات</li>
                            <li>تخصيص تجربة المستخدم</li>
                            <li>تحليل أداء التحديات</li>
                            <li>إرسال إشعارات مهمة</li>
                            <li>تحسين المحتوى التعليمي</li>
                            <li>الأبحاث والتطوير</li>
                        </ul>
                    </section>

                    <!-- مشاركة المعلومات -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">مشاركة المعلومات</h2>
                        <p class="text-muted">
                            نحن لا نبيع أو نؤجر أو نشارك معلوماتك الشخصية مع أطراف ثالثة لأغراض تسويقية. 
                            قد نشارك معلومات مجمعة وغير شخصية لأغراض إحصائية وتحليلية.
                        </p>
                    </section>

                    <!-- حماية المعلومات -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">حماية المعلومات</h2>
                        <div class="ps-3">
                            <h5 class="h6 text-dark mb-2">التدابير الأمنية</h5>
                            <ul class="text-muted">
                                <li>تشفير البيانات الحساسة</li>
                                <li>جدران حماية وأنظمة كشف</li>
                                <li>مراجعات أمنية منتظمة</li>
                                <li>وصول محدود للمعلومات</li>
                            </ul>
                        </div>
                    </section>

                    <!-- ملفات تعريف الارتباط -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">ملفات تعريف الارتباط (Cookies)</h2>
                        <p class="text-muted">
                            نستخدم ملفات تعريف الارتباط لتحسين تجربة المستخدم وتذكر تفضيلاتك. 
                            يمكنك إدارة إعدادات ملفات تعريف الارتباط عبر متصفحك.
                        </p>
                    </section>

                    <!-- حقوق المستخدم -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">حقوق المستخدم</h2>
                        <p class="text-muted mb-3">لديك الحق في:</p>
                        <ul class="text-muted">
                            <li>الوصول إلى معلوماتك الشخصية</li>
                            <li>تصحيح المعلومات غير الدقيقة</li>
                            <li>حذف حسابك ومعلوماتك</li>
                            <li>سحب الموافقة على معالجة البيانات</li>
                            <li>تصدير بياناتك الشخصية</li>
                        </ul>
                    </section>

                    <!-- بيانات القاصرين -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">بيانات القاصرين</h2>
                        <p class="text-muted">
                            لا نقوم بجمع معلومات عن قاصرين دون موافقة الوالدين. 
                            إذا اكتشفنا أننا جمعنا معلومات عن قاصر دون موافقة، سنقوم بحذف هذه المعلومات فوراً.
                        </section>

                    <!-- الاحتفاظ بالبيانات -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">فترة الاحتفاظ بالبيانات</h2>
                        <p class="text-muted">
                            نحتفظ ببياناتك طالما كان حسابك نشطاً أو حسبما تقتضي الضرورة لتقديم الخدمات. 
                            يمكنك طلب حذف حسابك في أي وقت، وسنقوم بحذف معلوماتك الشخصية خلال 30 يوماً.
                        </p>
                    </section>

                    <!-- النقل الدولي للبيانات -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">النقل الدولي للبيانات</h2>
                        <p class="text-muted">
                            قد يتم تخزين ومعالجة بياناتك في مراكز بيانات خارج بلد إقامتك. 
                            نضمن تطبيق معايير الحماية المناسبة وفقاً للقوانين المعمول بها.
                        </p>
                    </section>

                    <!-- التغييرات على السياسة -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">التغييرات على سياسة الخصوصية</h2>
                        <p class="text-muted">
                            قد نقوم بتحديث سياسة الخصوصية هذه من وقت لآخر. 
                            سنقوم بإشعارك بأي تغييرات جوهرية عبر البريد الإلكتروني أو عبر المنصة.
                        </p>
                    </section>

                    <!-- الامتثال القانوني -->
                    <section class="mb-5">
                        <h2 class="h4 text-dark mb-3">الامتثال القانوني</h2>
                        <p class="text-muted">
                            نحن نلتزم بالقوانين واللوائح ذات الصلة بحماية البيانات والخصوصية، 
                            بما في ذلك نظام حماية البيانات الشخصية في المملكة العربية السعودية.
                        </p>
                    </section>

                    <!-- الاتصال -->
                    <section class="mt-5 pt-4 border-top">
                        <h2 class="h4 text-dark mb-3">الاتصال بنا</h2>
                        <p class="text-muted mb-0">
                            لأي استفسارات حول سياسة الخصوصية أو لممارسة حقوقك، يرجى الاتصال بنا عبر:
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