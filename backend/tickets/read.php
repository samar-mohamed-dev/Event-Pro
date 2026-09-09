<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers.php';

function get_tickets_by_conference(int $conferenceId, bool $activeOnly = false): array
{
    $where = $activeOnly ? "AND t.status = 'active'" : '';
    return db_fetch_all(
        "SELECT t.id, t.conference_id, t.ticket_name, t.price, t.quantity, t.remaining_quantity, t.status,
                COALESCE(r.sold_count, 0) AS sold_count
         FROM tickets t
         LEFT JOIN (
             SELECT ticket_id, SUM(quantity) AS sold_count
             FROM registrations
             WHERE status <> 'cancelled'
             GROUP BY ticket_id
         ) r ON r.ticket_id = t.id
         WHERE t.conference_id = ? {$where}
         ORDER BY t.price ASC, t.id ASC",
        'i',
        [$conferenceId]
    );
}

function get_ticket_by_id(int $id): ?array
{
    return db_fetch_one('SELECT * FROM tickets WHERE id = ? LIMIT 1', 'i', [$id]);
}
