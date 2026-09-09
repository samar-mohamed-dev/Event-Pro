<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers.php';

require_login('admin');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../../available-conferences.php');
}

$id = (int) ($_POST['id'] ?? 0);
if ($id > 0) {
    db_execute('DELETE FROM conferences WHERE id = ?', 'i', [$id]);
}

redirect_to('../../available-conferences.php', ['message' => 'تم حذف المؤتمر']);

