<?php
// تعديل المسار ليدخل إلى مجلد backend أولاً
require_once __DIR__ . '/backend/helpers.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $conference_id = $_POST['conference_id'] ?? 1;
    $payment_method = $_POST['payment_method'] ?? '';

    // تنفيذ أمر الإدخال باستخدام دالة مشروعك db_execute
    // نستخدم (is) لأن conference_id رقم (integer) و payment_method نص (string)
    $sql = "INSERT INTO bookings (conference_id, payment_method, status) VALUES (?, ?, 'pending')";
    
    db_execute($sql, 'is', [(int)$conference_id, $payment_method]);

    // التحويل لصفحة النجاح (تأكدي من وجود success.php في المجلد الرئيسي)
    redirect_to('success.php?method=' . urlencode($payment_method));
    exit();
}
?>