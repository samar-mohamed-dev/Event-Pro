<?php
require_once __DIR__ . '/backend/helpers.php';
// جلب طريقة الدفع من الرابط
$method = $_GET['method'] ?? 'غير معروف';

// ترجمة الأسماء للعربية
$method_names = [
    'visa' => 'بطاقة فيزا / ماستركارد',
    'instapay' => 'إنستا باي (InstaPay)',
    'vodafone_cash' => 'فودافون كاش'
];
$display_method = $method_names[$method] ?? $method;
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تم الحجز بنجاح - Event Pro</title>
    <style>
        /* استخدام نفس الستايل الأنيق والزجاجي */
        body {
            background-image: linear-gradient(rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.4)), 
                              url('https://images.unsplash.com/photo-1540575467063-a75a00a12000?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            font-family: 'Cairo', sans-serif;
            display: flex; justify-content: center; align-items: center; min-height: 100vh;
        }
        .success-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px; border-radius: 30px; text-align: center;
            max-width: 450px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .btn-home {
            display: block; width: 100%; padding: 15px; margin-top: 20px;
            background: #3b82f6; color: white; text-decoration: none; border-radius: 12px;
        }
    </style>
</head>
<body>

<div class="success-card">
    <h2 style="color: #27ae60;">تم تسجيل طلبك بنجاح! 🎉</h2>
    <p>شكراً لاختيارك Event Pro.</p>
    
    <div style="background: #f1f5f9; padding: 20px; border-radius: 15px; margin: 20px 0;">
        <p>طريقة الدفع المختارة: <strong><?php echo $display_method; ?></strong></p>
        <p>يرجى إتمام عملية التحويل لتأكيد الحجز.</p>
        <h3 style="color: #1e293b;">رقم المحفظة / البيانات: 01012345678</h3>
    </div>

    <a href="index.php" class="btn-home">العودة للرئيسية</a>
</div>

</body>
</html>