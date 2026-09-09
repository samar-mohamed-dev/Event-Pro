<?php
declare(strict_types=1);

const DB_HOST = 'localhost';
const DB_NAME = 'event_pro';
const DB_USER = 'root';
const DB_PASS = '';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn->set_charset('utf8mb4');

