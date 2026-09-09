<?php
require_once __DIR__ . '/backend/helpers.php';
require_once __DIR__ . '/backend/conferences/read.php';
$user = current_user();
$conferences = get_all_conferences(true);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>اختار مؤتمرَك | Event Pro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800;900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/choose-conference.css" />
  <link rel="stylesheet" href="css/available-conferences.css">
</head>
<body>
<nav class="navbar navbar-dark nav-dark">
  <div class="container py-2 d-flex align-items-center justify-content-between">
    <a href="index.php" class="back-link">Back</a>
    <div class="d-flex align-items-center gap-2 text-white">
      <span class="fw-bold">إيفنت برو | Event Pro</span>
      <img src="img/WhatsApp Image 2026-01-19 at 4.47.22 PM 1.png" width="50" alt="">
    </div>
  </div>
</nav>

<header class="hero">
  <img class="hero-img" src="img/Pexels Photo by John-Mark Smith.png" alt="hero">
  <div class="hero-pill">اختر مؤتمرك و اصنع مستقبلا يليق بأحلامك حيث تلتقي الأفكار و تولد الفرص</div>
</header>

<main class="py-5" dir="rtl">
  <div class="container">
    <?php if ($user && $user['role'] === 'user'): ?>
      <p class="text-center fw-bold mb-4">مرحبًا <?= e($user['name']) ?>، يمكنك اختيار المؤتمر المناسب لك الآن.</p>
    <?php endif; ?>

    <div id="cardsGrid" class="row g-4 justify-content-center">
      <?php if (!$conferences): ?>
        <div class="empty-state">لا توجد مؤتمرات منشورة حاليا.</div>
      <?php else: ?>
        <?php foreach ($conferences as $conference): ?>
          <div class="col-md-6 col-lg-4 mb-5">
            <div class="conf-card selectable-card" data-conference-id="<?= (int) $conference['id'] ?>">
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
                <span>المقاعد المتبقية: <?= (int) $conference['remaining_tickets'] ?></span>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div class="bottom-buttons mt-5">
      <button id="confirmBtn" class="btn-bottom">تأكيد الاختيار</button>
      <a href="<?= $user && $user['role'] === 'user' ? 'tickets.php' : 'login.php?redirect=choose-conference.php' ?>" class="btn-bottom outline" id="accountLink">
        <?= $user && $user['role'] === 'user' ? 'عرض التذاكر والحجوزات' : 'سجل دخولك لإتمام الحجز' ?>
      </a>
    </div>
  </div>
</main>

<section class="bottom-band">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-lg-4 text-center text-lg-start"><img class="illus" src="img/image.png" alt="illus"></div>
      <div class="col-lg-8" dir="rtl">
        <h2 class="bottom-title">اختر مؤتمرَك الآن</h2>
        <p class="bottom-sub">اكتشف فعاليات تصنع الفارق و تفتح لك آفاق المعرفة و التواصل</p>
        <div class="bottom-row mt-3">
          <div class="yt"><i class="bi bi-youtube"></i><span>YouTube</span></div>
          <div class="social">
            <a href="#" class="soc"><i class="bi bi-facebook"></i></a>
            <a href="#" class="soc"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="soc"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="footer-dark py-2 text-center">
  <small>Event pro 2026</small>
</footer>

<script>
let selectedConferenceId = 0;
document.querySelectorAll(".selectable-card").forEach((card) => {
  card.addEventListener("click", () => {
    document.querySelectorAll(".selectable-card").forEach((item) => item.classList.remove("selected"));
    card.classList.add("selected");
    selectedConferenceId = Number(card.dataset.conferenceId);
    document.getElementById("accountLink").href = "tickets.php?conference_id=" + selectedConferenceId;
  });
});

document.getElementById("confirmBtn")?.addEventListener("click", () => {
  if (!selectedConferenceId) {
    alert("من فضلك اختر مؤتمر أولاً.");
    return;
  }
  window.location.href = "tickets.php?conference_id=" + selectedConferenceId;
});
</script>
<?php if (page_alert() !== ''): ?>
<script>alert(<?= json_encode(page_alert(), JSON_UNESCAPED_UNICODE) ?>);</script>
<?php endif; ?>
</body>
</html>

