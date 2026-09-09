<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../users/read.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../../login.php');
}

$source = basename((string) ($_POST['source'] ?? 'login.php'));
$source = in_array($source, ['login.php', 'organizer-login.php'], true) ? $source : 'login.php';
$scope = (string) ($_POST['login_scope'] ?? 'user');
$email = trim((string) ($_POST['email'] ?? ''));
$password = trim((string) ($_POST['password'] ?? ''));
$nationalId = trim((string) ($_POST['national_id'] ?? ''));
$redirect = trim((string) ($_POST['redirect'] ?? ''));

if ($password === '' || ($email === '' && $nationalId === '')) {
    redirect_to('../../' . $source, ['message' => 'يرجى إدخال بيانات الدخول المطلوبة']);
}

$user = $email !== '' ? find_user_by_email($email) : null;
if ($user === null && $nationalId !== '') {
    $user = find_user_by_national_id($nationalId);
}

if ($user === null) {
    redirect_to('../../' . $source, ['message' => 'بيانات الدخول غير صحيحة']);
}

$validPassword = password_verify($password, $user['password_hash']) || $user['password_hash'] === md5($password);
if (!$validPassword) {
    redirect_to('../../' . $source, ['message' => 'بيانات الدخول غير صحيحة']);
}

if ($user['status'] !== 'active') {
    redirect_to('../../' . $source, ['message' => 'هذا الحساب غير نشط']);
}

if ($scope === 'admin' && $user['role'] !== 'admin') {
    redirect_to('../../' . $source, ['message' => 'هذه الصفحة مخصصة للأدمن فقط']);
}

if ($user['password_hash'] === md5($password)) {
    $newHash = password_hash($password, PASSWORD_DEFAULT);
    db_execute('UPDATE users SET password_hash = ?, updated_at = NOW() WHERE id = ?', 'si', [$newHash, (int) $user['id']]);
    $user['password_hash'] = $newHash;
}

login_user($user);

if ($redirect !== '') {
    redirect_to('../../' . ltrim($redirect, '/'));
}

redirect_to('../../' . ($user['role'] === 'admin' ? 'metrics.php' : 'choose-conference.php'));

