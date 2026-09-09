<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers.php';

function find_user_by_email(string $email): ?array
{
    return db_fetch_one('SELECT * FROM users WHERE email = ? LIMIT 1', 's', [$email]);
}

function find_user_by_national_id(string $nationalId): ?array
{
    return db_fetch_one('SELECT * FROM users WHERE national_id = ? LIMIT 1', 's', [$nationalId]);
}

function find_user_by_phone(string $phone): ?array
{
    return db_fetch_one('SELECT * FROM users WHERE phone = ? LIMIT 1', 's', [$phone]);
}

function get_all_users(): array
{
    return db_fetch_all('SELECT id, first_name, last_name, email, role, status, phone, created_at FROM users ORDER BY created_at DESC, id DESC');
}
