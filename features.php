<!-- features.php -->
<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>مميزات | Event Pro</title>

  <!-- Bootstrap RTL -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/features.css" />
</head>

<body>
  <!-- NAV -->
  <nav class="navbar navbar-dark nav-dark">
    <div class="container py-2 d-flex align-items-center justify-content-between">
      <a href="index.php" class="back-link">Back</a>

      <div class="d-flex align-items-center gap-2 text-white">
        <span class="fw-bold">إيفنت برو <span class="opacity-75">| Event Pro</span></span>
        <span class="brand-badge">
          <!-- small logo placeholder -->
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <img src="img/WhatsApp Image 2026-01-19 at 4.47.22 PM 1.png" width="50" alt="">
          </svg>
        </span>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <header class="hero-wrap">
    <div class="container py-4 py-lg-5">
      <h1 class="hero-title  mb-4" style="text-align: right;">مميزات منصة المؤتمرات الذكية</h1>

      <div class="row align-items-center g-4 hero-row">
        <div class="col-lg-5">
          <div class="hero-image">
            <!-- بدّلها بصورتك -->
            <img
              src="img/image 26.png"
              class="img-fluid"
              alt="Feature Visual"
            />
          </div>
        </div>

        <div class="col-lg-7">
          <div class="hero-copy">
            <p class="hero-desc"  style="text-align: right; font-size: 30px;">
              منصتنا توفر تجربة متكاملة لإدارة الفعاليات من التخطيط حتى التقييم عبر لوحة تحكم موحدة وتحليلات فورية،
              بفضل أدوات التفاعل الذكية وأتمتة المهام؛ نضمن لك تنظيم فعاليات أكثر كفاءة وتأثيراً.
            </p>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- FEATURES GRID -->
  <section class="py-5" dir="rtl">
    <div class="container">
      <div class="row g-4 justify-content-center feature-grid">

        <div class="col-6 col-lg-3 text-center">
          <div class="icon-wrap">
            <!-- analytics -->
      
              <svg width="86" height="86" viewBox="0 0 96 96" fill="none" aria-hidden="true">
              <img src="img/Union.png" width="70" alt="">
            </svg>
          
          </div>
          <h5 class="f-title">تحليلات الاداء</h5>
          <p class="f-desc">عرض بيانات النمو والنتائج عبر الرسوم البيانية لتقييم نجاح الندوات.</p>
        </div>

        <div class="col-6 col-lg-3 text-center">
          <div class="icon-wrap">
            <!-- support -->
            <svg width="86" height="86" viewBox="0 0 96 96" fill="none" aria-hidden="true">
              <img src="img/Union (2).png" width="70" alt="">
            </svg>
          </div>
          <h5 class="f-title">دعم و تواصل مباشر</h5>
          <p class="f-desc">تسهيل التواصل مع الحضور من خلال الرسائل التفاعلية والتغذية الراجعة.</p>
        </div>

        <div class="col-6 col-lg-3 text-center">
          <div class="icon-wrap">
            <!-- schedule -->
              <svg width="86" height="86" viewBox="0 0 96 96" fill="none" aria-hidden="true">
              <img src="img/Union (1).png" width="70" alt="">
            </svg>
          </div>
          <h5 class="f-title">جدوله و تنظيم</h5>
          <p class="f-desc">تنظيم المواعيد والجلسات عبر الهاتف والتقويم مع تخصيص حسب المستخدمين.</p>
        </div>

        <div class="col-6 col-lg-3 text-center">
          <div class="icon-wrap">
            <!-- settings -->
            <svg width="86" height="86" viewBox="0 0 96 96" fill="none" aria-hidden="true">
              <img src="img/Settings.png" width="70" alt="">
            </svg>
          </div>
          <h5 class="f-title">الاعدادات الذكيه</h5>
          <p class="f-desc">إدارة إعدادات النظام والموافقة على العمليات بسهولة وفعالية.</p>
        </div>

      </div>
    </div>
  </section>

  <!-- BIG PREVIEW -->
  <section class="py-5">
    <div class="container text-center">
      <h2 class="big-title mb-4">تحكم كامل في مؤتمراتك من مكان واحد</h2>

      <div class="preview-card mx-auto">
        <img
          src="img/Group 866.png"
          alt="Dashboard"
          class="img-fluid"
        />
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer-dark py-3">
    <div class="container d-flex justify-content-center">
      <div class="small opacity-75">Event pro 2026</div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script >
    // features.js
// رجوع للخلف (اختياري): لو ما عندك صفحة index.php
// خلي زر Back يرجع للصفحة السابقة
const back = document.querySelector(".back-link");
back?.addEventListener("click", (e) => {
  // لو عندك index.php سيشتغل الرابط عادي
  // لو تبي يرجع history بدل الرابط، فعّل هذا:
  // e.preventDefault();
  // history.back();
});
  </script>
</body>
</html>

