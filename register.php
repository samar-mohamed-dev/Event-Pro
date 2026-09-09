<?php require_once __DIR__ . '/backend/helpers.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>إنشاء حساب جديد | Event Pro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/register.css">
</head>
<body>
<nav class="navbar navbar-dark nav-dark" dir="rtl">
  <div class="container d-flex justify-content-between align-items-center py-2">
    <div class="d-flex align-items-center gap-2 text-white">
      <img src="img/WhatsApp Image 2026-01-19 at 4.47.22 PM 1.png" width="50" alt="Event Pro logo">
      <span class="fw-bold">إيفنت برو <span class="opacity-75">| Event Pro</span></span>
    </div>
    <a href="index.php" class="back-link">Back</a>
  </div>
</nav>

<section class="text-center py-5">
  <div class="logo-wrap mb-3">
    <img src="img/WhatsApp Image 2026-01-19 at 4.47.22 PM 1.png" alt="logo">
  </div>
  <h1 class="brand-title">Event pro</h1>
  <div class="main-pill mt-4">إنشاء حساب جديد</div>
</section>

<section class="pb-5">
  <div class="container">
    <form id="registerForm" class="register-form mx-auto" method="post" action="backend/auth/register.php">
      <div class="row g-4">
        <div class="col-md-6">
          <div class="field"><input type="password" name="password" required><label>كلمه المرور</label></div>
          <div class="field"><input type="password" name="repassword" required><label>تأكيد كلمه المرور</label></div>
          <div class="field"><input type="text" name="specialty" required><label>المسمي الوظيفي</label></div>
          <div class="field"><input type="text" name="address" required><label>الدوله / المنطقه</label></div>
          <div class="field"><input type="email" name="email" required><label>البريد الالكتروني</label></div>
        </div>
        <div class="col-md-6">
          <div class="field"><input type="text" name="first_name" required><label>الاسم الاول</label></div>
          <div class="field"><input type="text" name="last_name" required><label>الاسم الاخير</label></div>
          <div class="field"><input type="text" name="national_id" required><label>رقم القومي</label></div>
          <div class="field"><input type="text" name="phone" required><label>رقم الهاتف</label></div>
          <div class="field"><input type="date" name="birth_date" required><label>تاريخ الميلاد</label></div>
        </div>
      </div>
      <div class="text-center mt-4">
        <button type="submit" class="confirm-btn">تأكيد</button>
      </div>
    </form>
  </div>
</section>

<section class="bottom-section text-center">
  <h2 class="bottom-title">سجل الآن وابدأ رحلتك في متابعة الجلسات و التفاعل مع الخبراء</h2>
  <div class="bottom-image mt-4">
    <img src="img/image.png" alt="">
  </div>
</section>

<footer class="footer-dark py-2 text-center">
  <small>Event pro 2026</small>
</footer>

<?php if (page_alert() !== ''): ?>
<script>alert(<?= json_encode(page_alert(), JSON_UNESCAPED_UNICODE) ?>);</script>
<?php endif; ?>
<script>
document.getElementById("registerForm").addEventListener("submit", function (e) {
  const password = document.querySelector('input[name="password"]').value;
  const repassword = document.querySelector('input[name="repassword"]').value;
  if (password !== repassword) {
    e.preventDefault();
    alert("كلمات المرور غير متطابقة ❌");
  }
});
</script>
</body>
</html>

