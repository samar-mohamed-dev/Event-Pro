<?php
require_once __DIR__ . '/backend/helpers.php';
require_once __DIR__ . '/backend/dashboard/read.php';
require_once __DIR__ . '/backend/bookings/read.php';
require_once __DIR__ . '/backend/users/read.php';
require_login('admin');
$summary = get_dashboard_summary();
$monthlyUsers = get_monthly_users();
$monthlyBookings = get_monthly_bookings();
$conferenceStatus = get_conference_status_counts();
$topConferences = get_top_conferences();
$bookings = get_all_bookings();
$users = get_all_users();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>التقارير والتحليلات | Event Pro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/reports.css" />
</head>
<body>
<nav class="navbar navbar-dark nav-dark">
  <div class="container py-2 d-flex align-items-center justify-content-between">
    <a href="metrics.php" class="back-link">Back</a>
    <div class="d-flex align-items-center gap-2 text-white">
      <span class="fw-bold">إيفنت برو | Event Pro</span>
      <img src="img/WhatsApp Image 2026-01-19 at 4.47.22 PM 1.png" width="50" alt="">
    </div>
  </div>
</nav>

<header class="hero">
  <img class="hero-img" src="img/unsplash_6vAjp0pscX0.png" alt="hero">
  <div class="hero-pill">هذا التقرير يقدم تحليلات شاملة لدعم التخطيط و إدارة المؤتمرات بكفاءة و وضوح</div>
</header>

<section class="py-5">
  <div class="container">
    <div class="row g-4 justify-content-center kpi-row mb-4">
      <div class="col-6 col-lg-3"><div class="kpi-card"><div class="kpi-top"><span class="kpi-num"><?= (int) $summary['total_users'] ?></span><span class="kpi-delta">Users</span></div><div class="kpi-title">إجمالي المستخدمين</div></div></div>
      <div class="col-6 col-lg-3"><div class="kpi-card kpi-blue"><div class="kpi-top"><span class="kpi-num"><?= (int) $summary['total_bookings'] ?></span><span class="kpi-delta">Bookings</span></div><div class="kpi-title">الحجوزات</div></div></div>
      <div class="col-6 col-lg-3"><div class="kpi-card"><div class="kpi-top"><span class="kpi-num"><?= number_format((float) $summary['total_revenue']) ?></span><span class="kpi-delta">EGP</span></div><div class="kpi-title">الإيرادات</div></div></div>
      <div class="col-6 col-lg-3"><div class="kpi-card"><div class="kpi-top"><span class="kpi-num"><?= (int) $summary['active_conferences'] ?></span><span class="kpi-delta">Events</span></div><div class="kpi-title">المؤتمرات النشطة</div></div></div>
    </div>

    <div class="row g-4 align-items-stretch">
      <div class="col-lg-8">
        <div class="dash-card h-100">
          <div class="dash-header">
            <span class="dash-tab active">المستخدمون</span>
            <span class="dash-tab">الحجوزات الشهرية</span>
          </div>
          <div class="canvas-wrap"><canvas id="usersChart"></canvas></div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="dash-card mb-4">
          <div class="dash-small-title">حالة المؤتمرات</div>
          <div class="canvas-wrap small"><canvas id="statusChart"></canvas></div>
        </div>
        <div class="dash-card">
          <div class="dash-small-title">أعلى المؤتمرات حجزاً</div>
          <div class="canvas-wrap small"><canvas id="conferenceChart"></canvas></div>
        </div>
      </div>
    </div>

    <div class="dash-card mt-4">
      <div class="dash-small-title red">إدارة الحجوزات</div>
      <div class="table-wrap">
        <table class="data-table">
          <thead>
            <tr>
              <th>المؤتمر</th>
              <th>المشارك</th>
              <th>التذكرة</th>
              <th>الكمية</th>
              <th>الإجمالي</th>
              <th>البريد</th>
              <th>الحالة</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($bookings as $booking): ?>
              <tr>
                <td><?= e((string) $booking['conference_title']) ?></td>
                <td><?= e((string) $booking['user_name']) ?></td>
                <td><?= e((string) $booking['ticket_name']) ?></td>
                <td><?= (int) $booking['quantity'] ?></td>
                <td><?= e(format_money((float) $booking['total_amount'])) ?></td>
                <td><?= e((string) $booking['attendee_email']) ?></td>
                <td>
                  <form method="post" action="backend/bookings/update.php" class="d-flex gap-2">
                    <input type="hidden" name="id" value="<?= (int) $booking['id'] ?>">
                    <select class="table-select" name="status">
                      <option value="pending" <?= $booking['status'] === 'pending' ? 'selected' : '' ?>>pending</option>
                      <option value="confirmed" <?= $booking['status'] === 'confirmed' ? 'selected' : '' ?>>confirmed</option>
                      <option value="cancelled" <?= $booking['status'] === 'cancelled' ? 'selected' : '' ?>>cancelled</option>
                    </select>
                    <button class="table-btn" type="submit">حفظ</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="dash-card mt-4">
      <div class="dash-small-title">إدارة المستخدمين</div>
      <div class="table-wrap">
        <table class="data-table">
          <thead>
            <tr>
              <th>الاسم</th>
              <th>البريد</th>
              <th>الدور</th>
              <th>الهاتف</th>
              <th>الحالة</th>
              <th>تاريخ الإنشاء</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user): ?>
              <tr>
                <td><?= e(trim($user['first_name'] . ' ' . $user['last_name'])) ?></td>
                <td><?= e((string) $user['email']) ?></td>
                <td><?= e((string) $user['role']) ?></td>
                <td><?= e((string) $user['phone']) ?></td>
                <td>
                  <form method="post" action="backend/users/update.php" class="d-flex gap-2">
                    <input type="hidden" name="id" value="<?= (int) $user['id'] ?>">
                    <select class="table-select" name="status" <?= $user['role'] === 'admin' ? 'disabled' : '' ?>>
                      <option value="active" <?= $user['status'] === 'active' ? 'selected' : '' ?>>active</option>
                      <option value="inactive" <?= $user['status'] === 'inactive' ? 'selected' : '' ?>>inactive</option>
                    </select>
                    <button class="table-btn" type="submit" <?= $user['role'] === 'admin' ? 'disabled' : '' ?>>حفظ</button>
                  </form>
                </td>
                <td><?= e((string) $user['created_at']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="text-center mt-5">
      <img class="illus" src="img/image.png" alt="illustration">
    </div>
  </div>
</section>

<footer class="footer-dark py-2 text-center">
  <small>Event pro 2026</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
new Chart(document.getElementById("usersChart"), {
  type: "line",
  data: {
    labels: <?= json_encode(array_column($monthlyUsers, 'label'), JSON_UNESCAPED_UNICODE) ?>,
    datasets: [
      { label: "المستخدمون", data: <?= json_encode(array_map('intval', array_column($monthlyUsers, 'total'))) ?>, borderWidth: 2, tension: 0.35, fill: true },
      { label: "الحجوزات", data: <?= json_encode(array_map('intval', array_column($monthlyBookings, 'total'))) ?>, borderWidth: 2, tension: 0.35 }
    ]
  },
  options: { responsive: true, maintainAspectRatio: false }
});

new Chart(document.getElementById("statusChart"), {
  type: "doughnut",
  data: {
    labels: <?= json_encode(array_column($conferenceStatus, 'status'), JSON_UNESCAPED_UNICODE) ?>,
    datasets: [{ data: <?= json_encode(array_map('intval', array_column($conferenceStatus, 'total'))) ?>, borderWidth: 0 }]
  },
  options: { responsive: true, maintainAspectRatio: false }
});

new Chart(document.getElementById("conferenceChart"), {
  type: "bar",
  data: {
    labels: <?= json_encode(array_column($topConferences, 'title'), JSON_UNESCAPED_UNICODE) ?>,
    datasets: [{ data: <?= json_encode(array_map('intval', array_column($topConferences, 'total'))) ?>, borderRadius: 8 }]
  },
  options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
});
</script>
<?php if (page_alert() !== ''): ?>
<script>alert(<?= json_encode(page_alert(), JSON_UNESCAPED_UNICODE) ?>);</script>
<?php endif; ?>
</body>
</html>

