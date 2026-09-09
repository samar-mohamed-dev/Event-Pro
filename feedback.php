<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>آراء المستخدمين | Event Pro</title>

  <!-- Bootstrap RTL -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/feedback.css" />
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
  <img class="hero-img"
       src="img/Pexels Photo by ICSA.png"
       alt="hero">

  <div class="hero-pill">
    هنا نشارككم الآراء و التجارب لنصنع معاً مؤتمرات افضل
  </div>
</header>

<!-- FORM -->
<main class="py-5">
  <div class="container">
    <form id="feedbackForm" class="feedback-form mx-auto">

      <div class="field-row">
        <input type="text" class="pill-input" name="username" required>
        <label class="pill-label">اسم المستخدم</label>
      </div>

      <div class="field-row">
        <input type="text" class="pill-input" name="jobTitle" required>
        <label class="pill-label"> التخصص</label>
      </div>

      <div class="field-row">
        <input type="text" class="pill-input" name="confName" required>
        <label class="pill-label">اسم المؤتمر </label>
      </div>
        <div class="field-row">
        <input type="date" class="pill-input" name="confDate" required>
        <label class="pill-label"> التاريخ</label>
      </div>

      <h2 class="section-title mt-4">شاركنا رأيك</h2>

      <textarea class="big-textarea" name="feedback" required></textarea>

      <div class="text-center mt-4">
        <button type="submit" class="send-btn">إرسال</button>
      </div>

    </form>
  </div>
</main>

<!-- THANK YOU SECTION -->
<section class="bottom-band">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-lg-4 text-center text-lg-start">
        <img class="illus"
             src="img/image.png"
             alt="illus">
      </div>

      <div class="col-lg-8" dir="rtl">
        <h2 class="thank-title">
          شكراً لمساهمتكم آراؤكم تدعم تطوير مؤتمراتنا المستقبلية
        </h2>
      </div>

    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="footer-dark py-2 text-center">
  <small>Event pro 2026</small>
</footer>

<script >
document.getElementById("feedbackForm").addEventListener("submit", function(e){
  e.preventDefault();

  alert("تم إرسال رأيك بنجاح ✅ شكراً لمشاركتك!");

  this.reset();
});

</script>
</body>
</html>

