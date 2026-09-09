<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/read.php';

require_login('admin');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../../available-conferences.php');
}

$id = (int) ($_POST['id'] ?? 0);
$conferenceId = (int) ($_POST['conference_id'] ?? 0);
$ticketName = trim((string) ($_POST['ticket_name'] ?? ''));
$price = (float) ($_POST['price'] ?? 0);
$quantity = (int) ($_POST['quantity'] ?? 0);
$status = trim((string) ($_POST['status'] ?? 'active'));

if ($conferenceId <= 0 || $ticketName === '' || $quantity <= 0) {
    redirect_to('../../create-conference.php', ['id' => $conferenceId, 'message' => 'بيانات التذكرة غير مكتملة']);
}

if (!in_array($status, ['active', 'inactive', 'archived'], true)) {
    $status = 'active';
}

if ($id > 0) {
    $old = get_ticket_by_id($id);
    if ($old !== null) {
        $sold = (int) $old['quantity'] - (int) $old['remaining_quantity'];
        $remaining = max($quantity - $sold, 0);
        db_execute(
            'UPDATE tickets SET ticket_name = ?, price = ?, quantity = ?, remaining_quantity = ?, status = ?, updated_at = NOW() WHERE id = ?',
            'sdiisi',
            [$ticketName, $price, $quantity, $remaining, $status, $id]
        );
    }
} else {
    db_execute(
        'INSERT INTO tickets (conference_id, ticket_name, price, quantity, remaining_quantity, status, created_at, updated_at)
         VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())',
        'isdiis',
        [$conferenceId, $ticketName, $price, $quantity, $quantity, $status]
    );
}

redirect_to('../../create-conference.php', ['id' => $conferenceId, 'message' => 'تم حفظ التذكرة']);

