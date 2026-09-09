<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>حدد الموعد الأنسب لك | Event Pro</title>

  <!-- Bootstrap RTL -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/schedule.css" />
</head>

<body>

<!-- NAV -->
<nav class="navbar navbar-dark nav-dark">
  <div class="container py-2 d-flex align-items-center justify-content-between">
    <a href="index.php" class="back-link">Back</a>

    <div class="d-flex align-items-center gap-2 text-white">
      <span class="fw-bold">إيفنت برو | Event Pro</span>
      <img src="img/WhatsApp Image 2026-01-19 at 4.47.22 PM 1.png" width="50" alt="">
    </div>
  </div>
</nav>

<!-- HERO -->
<header class="hero">
  <!-- بدّلها بالصورة الأصلية -->
  <img
    class="hero-img"
    src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=2000&auto=format&fit=crop"
    alt="hero"
  />

  <div class="hero-pill">
    قم بتسجيل مؤتمرَك ليظهر ضمن قائمة الفعاليات القادمة
  </div>
</header>

<!-- FORM AREA -->
<main class="py-5">
  <div class="container">

    <form id="confForm" class="conf-form mx-auto">

      <div class="field-row">
        <input class="pill-input" type="text" name="confName" required />
        <label class="pill-label">اسم المؤتمر</label>
      </div>

      <div class="field-row">
        <input class="pill-input" type="text" name="confType" required />
        <label class="pill-label">محاور المؤتمر</label>
      </div>

      <div class="field-row">
        <input class="pill-input" type="text" name="dateTime" placeholder="مثال: 2026-06-10 05:00 PM" required />
        <label class="pill-label">التاريخ و الوقت</label>
      </div>

      <div class="field-row">
        <input class="pill-input" type="text" name="location" required />
        <label class="pill-label">مكان المؤتمر</label>
      </div>

      <div class="text-center mt-4">
        <button class="confirm-btn" type="submit">تأكيد</button>
      </div>

    </form>

  </div>
</main>

<!-- ILLUSTRATION SECTION -->
<section class="illus-band text-center">
  <!-- بدّلها بالـ illustration الأصلية -->
  <img
    class="illus-img"
    src="img/image.png"
    alt="illustration"
  />
</section>

<!-- FOOTER -->
<footer class="footer-dark py-2 text-center">
  <small>Event pro 2026</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script >
  document.getElementById("confForm")?.addEventListener("submit", (e) => {
  e.preventDefault();

  const form = e.currentTarget;
  const payload = {
    confName: form.confName.value.trim(),
    confType: form.confType.value.trim(),
    dateTime: form.dateTime.value.trim(),
    location: form.location.value.trim(),
  };

  console.log("Conference:", payload);
  alert("تم تأكيد تسجيل المؤتمر ✅");
  form.reset();
});
</script>
</body>
</html>

