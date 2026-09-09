<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers.php';

$admin = require_login('admin');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../../reports.php');
}

$userId = (int) ($_POST['id'] ?? 0);
$status = trim((string) ($_POST['status'] ?? ''));

if ($userId <= 0 || !in_array($status, ['active', 'inactive'], true)) {
    redirect_to('../../reports.php', ['message' => 'بيانات المستخدم غير صحيحة']);
}

if ($userId === (int) $admin['id']) {
    redirect_to('../../reports.php', ['message' => 'لا يمكن تعديل حالة حساب الأدمن الحالي']);
}

db_execute('UPDATE users SET status = ?, updated_at = NOW() WHERE id = ?', 'si', [$status, $userId]);
redirect_to('../../reports.php', ['message' => 'تم تحديث حالة المستخدم']);

