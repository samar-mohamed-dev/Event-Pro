<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers.php';

$admin = require_login('admin');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../../create-conference.php');
}

$id = (int) ($_POST['id'] ?? 0);
$title = trim((string) ($_POST['title'] ?? ''));
$description = trim((string) ($_POST['description'] ?? ''));
$location = trim((string) ($_POST['location'] ?? ''));
$startsAt = normalize_datetime($_POST['starts_at'] ?? '');
$endsAt = normalize_datetime($_POST['ends_at'] ?? '');
$status = trim((string) ($_POST['status'] ?? 'published'));

if ($title === '' || $location === '' || $startsAt === null) {
    redirect_to('../../create-conference.php', ['message' => 'يرجى إدخال بيانات المؤتمر الأساسية']);
}

if (!in_array($status, ['draft', 'published', 'archived'], true)) {
    $status = 'published';
}

if ($id > 0) {
    db_execute(
        'UPDATE conferences SET title = ?, description = ?, location = ?, starts_at = ?, ends_at = ?, status = ?, updated_at = NOW() WHERE id = ?',
        'ssssssi',
        [$title, $description, $location, $startsAt, $endsAt, $status, $id]
    );
} else {
    db_execute(
        'INSERT INTO conferences (title, description, location, starts_at, ends_at, status, created_by, created_at, updated_at)
         VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())',
        'ssssssi',
        [$title, $description, $location, $startsAt, $endsAt, $status, (int) $admin['id']]
    );
    $id = db_insert_id();
}

redirect_to('../../create-conference.php', ['id' => $id, 'message' => 'تم حفظ المؤتمر بنجاح']);

