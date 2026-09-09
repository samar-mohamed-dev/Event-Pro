<?php require_once __DIR__ . '/backend/helpers.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>تسجيل دخول المنظم | Event Pro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/organizer-login.css" />
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
  <img class="hero-img" src="img/unsplash_ID1yWa1Wpx0.png" alt="hero">
  <div class="hero-pill">أهلآ بامدير النظام سجل دخولك لتقود مؤتمراتك نحو النجاح</div>
</header>

<main class="py-5">
  <div class="container">
    <form id="orgForm" class="org-form mx-auto" method="post" action="backend/auth/login.php">
      <div class="field-row">
        <input class="pill-input" type="email" name="email">
        <label class="pill-label">البريد الإلكتروني</label>
      </div>
      <div class="field-row">
        <input class="pill-input" type="password" name="password" required>
        <label class="pill-label">كلمه المرور</label>
      </div>
      <div class="field-row">
        <input class="pill-input" type="text" name="national_id">
        <label class="pill-label">الرقم القومي</label>
      </div>
      <input type="hidden" name="source" value="organizer-login.php">
      <input type="hidden" name="login_scope" value="admin">
      <div class="text-center mt-4">
        <button type="submit" class="confirm-btn">تأكيد</button>
      </div>
    </form>
  </div>
</main>

<section class="illus-band text-center">
  <img class="illus-img" src="img/image.png" alt="illustration">
</section>

<footer class="footer-dark py-2 text-center">
  <small>Event pro 2026</small>
</footer>

<?php if (page_alert() !== ''): ?>
<script>alert(<?= json_encode(page_alert(), JSON_UNESCAPED_UNICODE) ?>);</script>
<?php endif; ?>
</body>
</html>

