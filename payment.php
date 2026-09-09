<?php
// تأكدي من مسار ملف الاتصال أو ضعيه هنا مباشرة كما فعلتِ
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_pro";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) { die("فشل الاتصال: " . mysqli_connect_error()); }
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إتمام الحجز - Event Pro</title>
  <style>
    /* 1. خلفية الصفحة: صورة احترافية مع طبقة تغطية (Overlay) لضبط التباين */
    body {
        background-image: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.85)), 
                          url('https://images.unsplash.com/photo-1505373877841-8d25f7d46678?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Cairo', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }

    /* 2. الكارت: تأثير الزجاج الشفاف (Glassmorphism) ليتناسب مع الصورة الخلفية */
    .payment-card {
        background: rgba(255, 255, 255, 0.1); /* شفافية خفيفة */
        backdrop-filter: blur(15px); /* تأثير ضبابي يبرز الكارت فوق الصورة */
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 50px;
        border-radius: 30px;
        width: 100%;
        max-width: 450px;
        box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        text-align: center;
        color: white; /* تغيير لون النصوص للأبيض لتناسب الخلفية */
    }

    .payment-card h2 { color: #ffffff; }

    /* 3. الخيارات: تنسيق أنيق ومميز */
    .option {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 18px 20px;
        border-radius: 16px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: 0.3s;
        color: white;
    }

    .option:hover { background: rgba(255, 255, 255, 0.2); border-color: #3b82f6; }

    /* 4. الزر: تباين قوي ومحترف */
    .confirm-btn {
        width: 100%;
        padding: 18px;
        background: #3b82f6; /* أزرق مشرق يبرز وسط الخلفية الغامقة */
        color: white;
        border: none;
        border-radius: 16px;
        font-size: 18px;
        font-weight: bold;
        margin-top: 20px;
        cursor: pointer;
    }
</style>
</head>
<body>

<div class="payment-card">
    <div class="header-logo">
        <h1>Event Pro</h1>
        <p>بوابة الدفع الآمنة</p>
    </div>

    <form action="process_payment.php" method="POST">
        <input type="hidden" name="conference_id" value="<?php echo $_POST['conference_id'] ?? 1; ?>">
        
        <div class="payment-options">
            <label class="option">
                <span>💳 فيزا / ماستركارد</span>
                <input type="radio" name="payment_method" value="visa" required>
            </label>
            <label class="option">
                <span>📱 إنستا باي (InstaPay)</span>
                <input type="radio" name="payment_method" value="instapay" required>
            </label>
            <label class="option">
                <span>💸 فودافون كاش</span>
                <input type="radio" name="payment_method" value="vodafone_cash" required>
            </label>
        </div>

        <button type="submit" class="confirm-btn">تأكيد الحجز</button>
    </form>
</div>

</body>
</html>