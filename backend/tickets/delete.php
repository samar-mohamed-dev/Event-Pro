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

if ($id > 0) {
    $activeBookings = db_fetch_one(
        "SELECT COUNT(*) AS total FROM registrations WHERE ticket_id = ? AND status <> 'cancelled'",
        'i',
        [$id]
    );

    if ((int) ($activeBookings['total'] ?? 0) === 0) {
        global $conn;

        mysqli_begin_transaction($conn);

        try {
            db_execute('DELETE FROM registrations WHERE ticket_id = ?', 'i', [$id]);
            db_execute('DELETE FROM tickets WHERE id = ?', 'i', [$id]);
            mysqli_commit($conn);
        } catch (Throwable $exception) {
            mysqli_rollback($conn);
            throw $exception;
        }

        redirect_to('../../create-conference.php', ['id' => $conferenceId, 'message' => 'تم حذف التذكرة']);
    }
}

redirect_to('../../create-conference.php', ['id' => $conferenceId, 'message' => 'لا يمكن حذف تذكرة مرتبطة بحجوزات']);

