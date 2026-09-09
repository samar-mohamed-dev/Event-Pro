<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers.php';

$user = require_login('user');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../../tickets.php');
}

$id = (int) ($_POST['id'] ?? 0);
$conferenceId = (int) ($_POST['conference_id'] ?? 0);
$booking = db_fetch_one('SELECT * FROM registrations WHERE id = ? AND user_id = ? LIMIT 1', 'ii', [$id, (int) $user['id']]);

if ($booking !== null && $booking['status'] !== 'cancelled') {
    db_execute('UPDATE registrations SET status = "cancelled", updated_at = NOW() WHERE id = ?', 'i', [$id]);
    db_execute('UPDATE tickets SET remaining_quantity = remaining_quantity + ?, updated_at = NOW() WHERE id = ?', 'ii', [(int) $booking['quantity'], (int) $booking['ticket_id']]);
}

redirect_to('../../tickets.php', ['conference_id' => $conferenceId, 'message' => 'تم إلغاء الحجز']);

