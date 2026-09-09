<?php
require_once __DIR__ . '/backend/helpers.php';
require_once __DIR__ . '/backend/conferences/read.php';
require_login('admin');
$conferences = get_all_conferences(false);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>المؤتمرات المتاحة | Event Pro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/available-conferences.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark nav-dark">
  <div class="container py-2 d-flex align-items-center justify-content-between">
    <a href="metrics.php" class="back-link">Back</a>
    <div class="d-flex align-items-center gap-2 text-white fw-bold">
      <span>إيفنت برو | Event Pro</span>
      <span class="brand-badge"><img src="img/WhatsApp Image 2026-01-19 at 4.47.22 PM 1.png" width="50" alt=""></span>
    </div>
  </div>
</nav>

<header class="hero">
  <img class="hero-img" src="img/unsplash_YrJ99TBRQvI.png" alt="hero">
  <div class="hero-pill">المؤتمرات المتاحه حاليا علي المنصه</div>
</header>

<main class="py-5" dir="rtl">
  <div class="container">
    <div class="row g-4 justify-content-center">
      <?php if (!$conferences): ?>
        <div class="empty-state">لا توجد مؤتمرات مضافة حتى الآن.</div>
      <?php else: ?>
        <?php foreach ($conferences as $conference): ?>
          <div class="col-md-6 col-lg-4 mb-5">
            <div class="conf-card">
              <div class="card-head">
                <span class="status-pill status-<?= e((string) $conference['status']) ?>"><?= e((string) $conference['status']) ?></span>
                <h3 class="conf-title"><?= e((string) $conference['title']) ?></h3>
              </div>
              <p class="conf-desc"><?= e((string) ($conference['description'] ?: 'لا يوجد وصف مضاف لهذا المؤتمر.')) ?></p>
              <div class="conf-meta">
                <span class="meta-item"><i class="bi bi-clock"></i> <?= e(format_time_label((string) $conference['starts_at'])) ?></span>
                <span class="meta-item"><i class="bi bi-geo-alt"></i> <?= e((string) $conference['location']) ?></span>
                <span class="meta-item"><i class="bi bi-calendar"></i> <?= e(format_date_label((string) $conference['starts_at'])) ?></span>
              </div>
              <div class="stats-row">
                <span>أنواع التذاكر: <?= (int) $conference['ticket_types'] ?></span>
                <span>الحجوزات: <?= (int) $conference['bookings_count'] ?></span>
                <span>المتبقي: <?= (int) $conference['remaining_tickets'] ?></span>
              </div>
            </div>

            <div class="actions-row">
              <form method="post" action="backend/conferences/delete.php" onsubmit="return confirm('هل تريد حذف هذا المؤتمر وكل التذاكر التابعة له؟');">
                <input type="hidden" name="id" value="<?= (int) $conference['id'] ?>">
                <button class="small-btn delete-btn" type="submit">حذف</button>
              </form>
              <a class="small-btn edit-btn text-decoration-none" href="create-conference.php?id=<?= (int) $conference['id'] ?>">تعديل</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div class="bottom-buttons mt-5">
      <a href="metrics.php" class="btn-bottom">لوحة الإحصائيات</a>
      <a href="create-conference.php" class="btn-bottom outline">إنشاء مؤتمر جديد</a>
    </div>
  </div>
</main>

<footer class="footer-dark py-2 text-center">
  <small>Event pro 2026</small>
</footer>

<?php if (page_alert() !== ''): ?>
<script>alert(<?= json_encode(page_alert(), JSON_UNESCAPED_UNICODE) ?>);</script>
<?php endif; ?>
</body>
</html>

