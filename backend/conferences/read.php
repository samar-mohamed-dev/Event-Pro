<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers.php';

function get_all_conferences(bool $publishedOnly = false): array
{
    $where = $publishedOnly ? "WHERE c.status = 'published'" : '';
    return db_fetch_all(
        "SELECT c.*,
                CONCAT(u.first_name, ' ', u.last_name) AS created_by_name,
                COALESCE(t.ticket_types, 0) AS ticket_types,
                COALESCE(t.remaining_tickets, 0) AS remaining_tickets,
                COALESCE(r.bookings_count, 0) AS bookings_count
         FROM conferences c
         JOIN users u ON u.id = c.created_by
         LEFT JOIN (
             SELECT conference_id,
                    COUNT(*) AS ticket_types,
                    COALESCE(SUM(CASE WHEN status <> 'archived' THEN remaining_quantity ELSE 0 END), 0) AS remaining_tickets
             FROM tickets
             GROUP BY conference_id
         ) t ON t.conference_id = c.id
         LEFT JOIN (
             SELECT conference_id, COUNT(*) AS bookings_count
             FROM registrations
             WHERE status <> 'cancelled'
             GROUP BY conference_id
         ) r ON r.conference_id = c.id
         {$where}
         ORDER BY c.id ASC"
    );
}

function get_conference_by_id(int $id, bool $publishedOnly = false): ?array
{
    $where = $publishedOnly ? "AND c.status = 'published'" : '';
    return db_fetch_one(
        "SELECT c.*,
                CONCAT(u.first_name, ' ', u.last_name) AS created_by_name
         FROM conferences c
         JOIN users u ON u.id = c.created_by
         WHERE c.id = ? {$where}
         LIMIT 1",
        'i',
        [$id]
    );
}
