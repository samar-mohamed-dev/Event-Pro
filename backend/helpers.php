<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';



if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function db_query(string $sql, string $types = '', array $params = []): mysqli_stmt
{
    global $conn;
    $stmt = mysqli_prepare($conn, $sql);
    if ($types !== '' && $params !== []) {
        $refs = [];
        foreach ($params as $index => $param) {
            $params[$index] = $param;
            $refs[$index] = &$params[$index];
        }
        array_unshift($refs, $types);
        call_user_func_array('mysqli_stmt_bind_param', array_merge([$stmt], $refs));
    }
    mysqli_stmt_execute($stmt);
    return $stmt;
}

function db_fetch_one(string $sql, string $types = '', array $params = []): ?array
{
    $stmt = db_query($sql, $types, $params);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result) ?: null;
    mysqli_stmt_close($stmt);
    return $row;
}

function db_fetch_all(string $sql, string $types = '', array $params = []): array
{
    $stmt = db_query($sql, $types, $params);
    $result = mysqli_stmt_get_result($stmt);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}

function db_execute(string $sql, string $types = '', array $params = []): int
{
    $stmt = db_query($sql, $types, $params);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $affected;
}

function db_insert_id(): int
{
    global $conn;
    return (int) mysqli_insert_id($conn);
}

function redirect_to(string $path, array $params = []): never
{
    $query = http_build_query(array_filter($params, static fn($value) => $value !== null && $value !== ''));
    header('Location: ' . $path . ($query !== '' ? '?' . $query : ''));
    exit;
}

function e(string $value = ''): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function login_user(array $user): void
{
    $_SESSION['user'] = [
        'id' => (int) $user['id'],
        'first_name' => $user['first_name'],
        'last_name' => $user['last_name'],
        'name' => trim($user['first_name'] . ' ' . $user['last_name']),
        'email' => $user['email'],
        'phone' => $user['phone'],
        'role' => $user['role'],
        'status' => $user['status'],
    ];
}

function logout_user(): void
{
    $_SESSION = [];
    session_destroy();
}

function require_login(?string $role = null): array
{
    $user = current_user();
    if ($user === null) {
        redirect_to($role === 'admin' ? 'organizer-login.php' : 'login.php');
    }

    if ($role !== null && $user['role'] !== $role) {
        redirect_to($user['role'] === 'admin' ? 'metrics.php' : 'choose-conference.php');
    }

    return $user;
}

function page_alert(): string
{
    return (string) ($_GET['message'] ?? '');
}

function format_money(float $value): string
{
    return number_format($value, 2) . ' جنيه';
}

function format_date_label(?string $value): string
{
    if ($value === null || $value === '') {
        return 'غير محدد';
    }
    $time = strtotime($value);
    return $time ? date('Y / n / j', $time) : $value;
}

function format_time_label(?string $value): string
{
    if ($value === null || $value === '') {
        return 'غير محدد';
    }
    $time = strtotime($value);
    return $time ? date('g:i A', $time) : $value;
}

function normalize_datetime(?string $value): ?string
{
    $value = trim((string) $value);
    if ($value === '') {
        return null;
    }

    $value = str_replace('T', ' ', $value);
    if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}$/', $value) === 1) {
        $value .= ':00';
    }

    $time = strtotime($value);
    return $time ? date('Y-m-d H:i:s', $time) : null;
}

