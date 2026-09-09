<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers.php';

require_login('admin');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../../reports.php');
}

$id = (int) ($_POST['id'] ?? 0);
$status = trim((string) ($_POST['status'] ?? ''));

if ($id <= 0 || !in_array($status, ['pending', 'confirmed', 'cancelled'], true)) {
    redirect_to('../../reports.php', ['message' => 'بيانات الحجز غير صحيحة']);
}

$booking = db_fetch_one('SELECT * FROM registrations WHERE id = ? LIMIT 1', 'i', [$id]);
if ($booking === null) {
    redirect_to('../../reports.php', ['message' => 'الحجز غير موجود']);
}

if ($booking['status'] !== $status) {
    if ($booking['status'] !== 'cancelled' && $status === 'cancelled') {
        db_execute('UPDATE tickets SET remaining_quantity = remaining_quantity + ?, updated_at = NOW() WHERE id = ?', 'ii', [(int) $booking['quantity'], (int) $booking['ticket_id']]);
    }

    if ($booking['status'] === 'cancelled' && $status !== 'cancelled') {
        db_execute('UPDATE tickets SET remaining_quantity = remaining_quantity - ?, updated_at = NOW() WHERE id = ?', 'ii', [(int) $booking['quantity'], (int) $booking['ticket_id']]);
    }

    db_execute('UPDATE registrations SET status = ?, updated_at = NOW() WHERE id = ?', 'si', [$status, $id]);
}

redirect_to('../../reports.php', ['message' => 'تم تحديث حالة الحجز']);

