<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../users/read.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../../register.php');
}

$firstName = trim((string) ($_POST['first_name'] ?? ''));
$lastName = trim((string) ($_POST['last_name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$phone = trim((string) ($_POST['phone'] ?? ''));
$password = trim((string) ($_POST['password'] ?? ''));
$repassword = trim((string) ($_POST['repassword'] ?? ''));
$specialty = trim((string) ($_POST['specialty'] ?? ''));
$address = trim((string) ($_POST['address'] ?? ''));
$nationalId = trim((string) ($_POST['national_id'] ?? ''));
$birthDate = trim((string) ($_POST['birth_date'] ?? ''));

// --- التعديل يبدأ من هنا ---
// تحديد بريد الأدمن الخاص بك
$admin_email = 'admin@eventpro.local'; 

// تحديد الـ role تلقائياً بناءً على البريد
$role = ($email === $admin_email) ? 'admin' : 'user';
// --- التعديل ينتهي هنا ---

if ($firstName === '' || $lastName === '' || $email === '' || $phone === '' || $password === '' || $repassword === '' || $specialty === '' || $address === '' || $nationalId === '' || $birthDate === '') {
    redirect_to('../../register.php', ['message' => 'يرجى ملء جميع الحقول المطلوبة']);
}

if ($password !== $repassword) {
    redirect_to('../../register.php', ['message' => 'كلمات المرور غير متطابقة']);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirect_to('../../register.php', ['message' => 'صيغة البريد الإلكتروني غير صحيحة']);
}

if (find_user_by_email($email) || find_user_by_national_id($nationalId) || find_user_by_phone($phone)) {
    redirect_to('../../register.php', ['message' => 'البريد أو الرقم القومي أو الهاتف مستخدم بالفعل']);
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// تم تحديث الاستعلام ليستخدم المتغير $role بدلاً من الكلمة الثابتة "user"
db_execute(
    'INSERT INTO users (first_name, last_name, specialty, email, address, national_id, phone, birth_date, password_hash, role, status, created_at, updated_at)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, "active", NOW(), NOW())',
    'ssssssssss', // تم تغيير النوع إلى 10 حروف لأننا أضفنا $role
    [$firstName, $lastName, $specialty, $email, $address, $nationalId, $phone, $birthDate, $passwordHash, $role]
);

redirect_to('../../login.php', ['message' => 'تم إنشاء الحساب بنجاح، يمكنك تسجيل الدخول الآن']);