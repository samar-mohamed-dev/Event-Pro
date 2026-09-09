<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers.php';

function get_user_bookings(int $userId): array
{
    return db_fetch_all(
        "SELECT r.*, c.title AS conference_title, t.ticket_name
         FROM registrations r
         JOIN conferences c ON c.id = r.conference_id
         JOIN tickets t ON t.id = r.ticket_id
         WHERE r.user_id = ?
         ORDER BY r.created_at DESC, r.id DESC",
        'i',
        [$userId]
    );
}

function get_all_bookings(): array
{
    return db_fetch_all(
        "SELECT r.*, c.title AS conference_title, t.ticket_name,
                CONCAT(u.first_name, ' ', u.last_name) AS user_name
         FROM registrations r
         JOIN conferences c ON c.id = r.conference_id
         JOIN tickets t ON t.id = r.ticket_id
         JOIN users u ON u.id = r.user_id
         ORDER BY r.created_at DESC, r.id DESC"
    );
}
