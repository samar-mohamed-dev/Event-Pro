<?php
require_once __DIR__ . '/backend/helpers.php';
require_once __DIR__ . '/backend/dashboard/read.php';
$admin = require_login('admin');
$summary = get_dashboard_summary();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ملخص الإحصائيات | Event Pro</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/metrics.css">
</head>
<body>
<nav class="navbar navbar-dark nav-dark">
  <div class="container d-flex justify-content-between align-items-center py-2">
    <div class="d-flex align-items-center gap-2 text-white">
      <img src="img/WhatsApp Image 2026-01-19 at 4.47.22 PM 1.png" width="50" alt="Event Pro logo">
      <span class="fw-bold">إيفنت برو <span class="opacity-75">| Event Pro</span></span>
    </div>
    <div class="d-flex align-items-center gap-3">
      <span class="text-white fw-bold small"><?= e($admin['name']) ?></span>
      <a href="backend/auth/logout.php" class="back-link">خروج</a>
    </div>
  </div>
</nav>

<header class="metrics-header text-center">
  <h1>ملخص الإحصائيات</h1>
  <h2>Quick Metrics</h2>
</header>

<section class="py-5">
  <div class="container">
    <div class="metrics-list">
      <div class="metric-row">
        <div class="metric-number"><?= (int) $summary['active_conferences'] ?></div>
        <div class="metric-icon"><img src="img/Nira.png" alt="أيقونة الفعاليات"></div>
        <div class="metric-label">عدد الفعاليات النشطة</div>
      </div>
      <div class="metric-row">
        <div class="metric-number"><?= (int) $summary['tickets_sold'] ?></div>
        <div class="metric-icon"><img src="img/emojione-v1_admission-tickets.png" alt="أيقونة التذاكر"></div>
        <div class="metric-label">إجمالي التذاكر المباعة</div>
      </div>
      <div class="metric-row">
        <div class="metric-number"><?= number_format((float) $summary['total_revenue']) ?></div>
        <div class="metric-icon"><img src="img/emojione_money-with-wings.png" alt="أيقونة الإيرادات"></div>
        <div class="metric-label">إجمالي الإيرادات</div>
      </div>
      <div class="metric-row">
        <div class="metric-number"><?= (int) $summary['new_users'] ?></div>
        <div class="metric-icon"><img src="img/fluent-color_people-16.png" alt="أيقونة المسجلين الجدد"></div>
        <div class="metric-label">عدد المستخدمين الجدد خلال 30 يوم</div>
      </div>
    </div>

    <div class="text-center mt-5 d-flex flex-wrap justify-content-center gap-3">
      <a class="create-btn text-decoration-none" href="create-conference.php">إنشاء فعالية جديدة</a>
      <a class="create-btn text-decoration-none" href="available-conferences.php">إدارة المؤتمرات</a>
      <a class="create-btn text-decoration-none" href="reports.php">التقارير والحجوزات</a>
    </div>

    <div class="text-center mt-5">
      <img src="img/image.png" alt="Illustration" class="illus">
    </div>
  </div>
</section>

<footer class="footer-dark py-2 text-center">
  <small>Event Pro 2026</small>
</footer>

<?php if (page_alert() !== ''): ?>
<script>alert(<?= json_encode(page_alert(), JSON_UNESCAPED_UNICODE) ?>);</script>
<?php endif; ?>
</body>
</html>

