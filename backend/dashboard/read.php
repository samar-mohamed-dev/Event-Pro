<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers.php';

function get_dashboard_summary(): array
{
    return [
        'active_conferences' => (int) (db_fetch_one("SELECT COUNT(*) AS total FROM conferences WHERE status = 'published'")['total'] ?? 0),
        'tickets_sold' => (int) (db_fetch_one("SELECT COALESCE(SUM(quantity - remaining_quantity), 0) AS total FROM tickets WHERE status <> 'archived'")['total'] ?? 0),
        'total_revenue' => (float) (db_fetch_one("SELECT COALESCE(SUM(total_amount), 0) AS total FROM registrations WHERE status <> 'cancelled'")['total'] ?? 0),
        'new_users' => (int) (db_fetch_one("SELECT COUNT(*) AS total FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)")['total'] ?? 0),
        'total_users' => (int) (db_fetch_one("SELECT COUNT(*) AS total FROM users")['total'] ?? 0),
        'total_bookings' => (int) (db_fetch_one("SELECT COUNT(*) AS total FROM registrations WHERE status <> 'cancelled'")['total'] ?? 0),
    ];
}

function get_monthly_users(): array
{
    return db_fetch_all(
        "SELECT DATE_FORMAT(MIN(created_at), '%b') AS label, COUNT(*) AS total
         FROM users
         WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 11 MONTH)
         GROUP BY YEAR(created_at), MONTH(created_at)
         ORDER BY YEAR(created_at), MONTH(created_at)"
    );
}

function get_monthly_bookings(): array
{
    return db_fetch_all(
        "SELECT DATE_FORMAT(MIN(created_at), '%b') AS label, COUNT(*) AS total
         FROM registrations
         WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 11 MONTH) AND status <> 'cancelled'
         GROUP BY YEAR(created_at), MONTH(created_at)
         ORDER BY YEAR(created_at), MONTH(created_at)"
    );
}

function get_conference_status_counts(): array
{
    return db_fetch_all("SELECT status, COUNT(*) AS total FROM conferences GROUP BY status ORDER BY status ASC");
}

function get_top_conferences(): array
{
    return db_fetch_all(
        "SELECT c.title, COALESCE(r.total, 0) AS total
         FROM conferences c
         LEFT JOIN (
             SELECT conference_id, COUNT(id) AS total
             FROM registrations
             WHERE status <> 'cancelled'
             GROUP BY conference_id
         ) r ON r.conference_id = c.id
         ORDER BY total DESC, c.title ASC
         LIMIT 6"
    );
}
