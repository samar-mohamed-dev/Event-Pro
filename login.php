<?php require_once __DIR__ . '/backend/helpers.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>تسجيل دخول | Event Pro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/login.css" />
</head>
<body>
<nav class="navbar navbar-dark nav-dark">
  <div class="container d-flex justify-content-between align-items-center py-2">
    <a href="index.php" class="back-link">Back</a>
    <div class="d-flex align-items-center gap-2 text-white">
      <span>إيفنت برو | Event Pro</span>
      <div><img src="img/WhatsApp Image 2026-01-19 at 4.47.22 PM 1.png" width="50" alt=""></div>
    </div>
  </div>
</nav>

<main class="py-5 text-center">
  <div class="logo-wrap mb-3">
    <img src="img/WhatsApp Image 2026-01-19 at 4.47.22 PM 1.png" alt="logo">
  </div>

  <h1 class="brand-title">Event pro</h1>
  <h2 class="arabic-title mb-4">مرحبا بك في بوابه المؤتمرات</h2>
  <div class="info-pill mb-5">ادخل بياناتك الشخصيه</div>

  <form class="login-form mx-auto" method="post" action="backend/auth/login.php">
    <div class="field-group">
      <input type="email" name="email" required>
      <label>البريد الإلكتروني</label>
    </div>
    <div class="field-group">
      <input type="password" name="password" required>
      <label>كلمة المرور</label>
    </div>
    <input type="hidden" name="redirect" value="<?= e((string) ($_GET['redirect'] ?? '')) ?>">
    <input type="hidden" name="source" value="login.php">
    <input type="hidden" name="login_scope" value="user">

    <div class="row g-4 mt-4">
      <div class="col-md-6">
        <a href="register.php" class="action-btn w-100 d-block text-center" style="text-decoration:none">إنشاء حساب جديد</a>
      </div>
      <div class="col-md-6">
        <button type="submit" class="action-btn w-100">تسجيل دخول</button>
      </div>
    </div>

    <div class="social-login">
      <p class="social-login-title">أو التسجيل بواسطة</p>
      <div class="social-icons">
    <a href="https://www.facebook.com/" class="social-icon" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
    <a href="https://www.instagram.com/" class="social-icon" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
    <a href="https://twitter.com/" class="social-icon" aria-label="X"><i class="bi bi-twitter-x"></i></a>
    <a href="https://www.linkedin.com/" class="social-icon" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
</div>
<div class="qr-section" style="margin-top: 15px;">
    <p>سجّل دخولك أسرع باستخدام هاتفك!</p>
    <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=http://192.168.1.15/event_pro/register.php" alt="QR Code"></div>
    </div>
  </form>
</main>

<div class="bottom-illustration text-center">
  <img src="img/image.png" alt="illustration">
</div>

<footer class="footer-dark py-2 text-center">
  <small>Event pro 2026</small>
</footer>

<?php if (page_alert() !== ''): ?>
<script>alert(<?= json_encode(page_alert(), JSON_UNESCAPED_UNICODE) ?>);</script>
<?php endif; ?>
</body>
</html>

