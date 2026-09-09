<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../tickets/read.php';

$user = require_login('user');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../../choose-conference.php');
}

$ticketId = (int) ($_POST['ticket_id'] ?? 0);
$quantity = max(1, (int) ($_POST['quantity'] ?? 1));
$attendeeName = trim((string) ($_POST['attendee_name'] ?? ''));
$attendeeEmail = trim((string) ($_POST['attendee_email'] ?? ''));
$attendeePhone = trim((string) ($_POST['attendee_phone'] ?? ''));

$ticket = get_ticket_by_id($ticketId);
if ($ticket === null || $ticket['status'] !== 'active') {
    redirect_to('../../tickets.php', ['conference_id' => (int) ($ticket['conference_id'] ?? 0), 'message' => 'نوع التذكرة غير متاح']);
}

if ($attendeeName === '' || $attendeeEmail === '' || $attendeePhone === '' || $quantity <= 0) {
    redirect_to('../../tickets.php', ['conference_id' => (int) $ticket['conference_id'], 'message' => 'يرجى إدخال بيانات الحجز كاملة']);
}

if ((int) $ticket['remaining_quantity'] < $quantity) {
    redirect_to('../../tickets.php', ['conference_id' => (int) $ticket['conference_id'], 'message' => 'الكمية المطلوبة غير متاحة']);
}

$totalAmount = (float) $ticket['price'] * $quantity;

db_execute(
    'INSERT INTO registrations (user_id, conference_id, ticket_id, attendee_name, attendee_email, attendee_phone, quantity, total_amount, status, created_at, updated_at)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, "pending", NOW(), NOW())',
    'iiisssid',
    [(int) $user['id'], (int) $ticket['conference_id'], $ticketId, $attendeeName, $attendeeEmail, $attendeePhone, $quantity, $totalAmount]
);

db_execute(
    'UPDATE tickets SET remaining_quantity = remaining_quantity - ?, updated_at = NOW() WHERE id = ?',
    'ii',
    [$quantity, $ticketId]
);

redirect_to('../../tickets.php', ['conference_id' => (int) $ticket['conference_id'], 'message' => 'تم حجز التذكرة بنجاح']);

