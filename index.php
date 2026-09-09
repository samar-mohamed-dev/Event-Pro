<!-- index.php -->
<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Event Pro | المنصة</title>

  <!-- Bootstrap RTL -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

  <!-- Icons (Bootstrap Icons) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <!-- Google Font (Arabic-friendly) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/styles.css" />
</head>

<body class="bg-white">
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark nav-dark sticky-top" dir="rtl">
    <div class="container py-2">
      <a class="navbar-brand d-flex align-items-center gap-2" href="#">
        <span class="brand-badge">
          <img src="img/WhatsApp Image 2026-01-19 at 4.47.22 PM 1.png" width="50" alt="">
        </span>
        <span class="fw-bold">إيفنت برو <span class="opacity-75">| Event Pro</span></span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="topNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-lg-2">
          <li class="nav-item"><a class="nav-link" href="features.php">المميزات</a></li>
          <li class="nav-item"><a class="nav-link" href="platform.php">المنصة</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">تواصل معنا</a></li>
        </ul>

        <div class="d-flex align-items-center gap-2">
          <button class="btn btn-outline-light btn-sm px-3 rounded-pill" id="langToggle">AR/EN</button>
          <a class="btn btn-outline-light btn-sm px-3 rounded-pill" href="login.php">تسجيل دخول</a>
          <a class="btn btn-cta btn-sm px-3 rounded-pill" href="register.php">ابدأ تجربتك</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <header class="hero-wrap">
    <div class="container hero-inner">
      <div class="row align-items-center g-4">
        <!-- LEFT IMAGE -->
        <div class="col-lg-5">
          <div class="hero-image">
            <!-- ضع صورتك هنا -->
            <img
              src="https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=1200&auto=format&fit=crop"
              alt="Platform Visual"
              class="img-fluid rounded-4"
            />
          </div>
        </div>

        <!-- RIGHT TEXT -->
        <div class="col-lg-7">
          <div class="hero-copy" dir="rtl">
            <h1 class="hero-title mb-3">
              ارتقِ بمؤتمراتك إلى<br class="d-none d-md-block"> مستوى المستقبل.
            </h1>

            <div class="hero-subtitle mb-3">
              Smart Platform For Conference Event Management
            </div>

            <p class="hero-desc mb-4">
              المنصة الذكية لإدارة الفعاليات بشكل شامل. ندمج التكنولوجيا بذكاء مع أفضل الممارسات
              لضمان تنظيم احترافي وتجربة حضور استثنائية مدفوعة بالبيانات.
            </p>

            <div class="d-flex flex-wrap gap-2">
              <a class="btn btn-light btn-lg rounded-pill px-4 hero-btn" href="#platform">
                اكتشف مستقبل إدارة الفعاليات
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- SECTION: JOURNEY -->
  <section class="py-5" >
    <div class="container text-center">
      <h2 class="section-title mb-2">رحله متكامله. من الفكره إلى الأثر.</h2>
      <p class="section-desc mx-auto">
        “إيفنت برو” ليست مجرد أداة تسجيل، بل هي شريكك الذكي الذي يقدّم لك حلاً متكاملاً يغطي كافة احتياجاتك.
      </p>
    </div>
  </section>

  <!-- FEATURES -->
  <section class="py-4 pb-5" id="features" dir="rtl">
    <div class="container">
      <div class="row g-4 justify-content-center">
        <div class="col-6 col-lg-3">
          <div class="feature-card text-center">
            <div class="feature-icon">
              <i class="bi bi-display"></i>
            </div>
            <h5 class="feature-title">التحكم المركزي</h5>
            <p class="feature-desc">
              لوحة تحكم موحدة لإدارة رؤيتك، متابعة التسجيلات، وإدارة الحدث بسلاسة.
            </p>
          </div>
        </div>

        <div class="col-6 col-lg-3">
          <div class="feature-card text-center">
            <div class="feature-icon">
              <i class="bi bi-lightning-charge"></i>
            </div>
            <h5 class="feature-title">الكفاءة الرقمية</h5>
            <p class="feature-desc">
              إدارة سلسلة الفعاليات رقمياً، تسجيل ذكي، وتذاكر رقمية وتجارب أسرع.
            </p>
          </div>
        </div>

        <div class="col-6 col-lg-3">
          <div class="feature-card text-center">
            <div class="feature-icon">
              <i class="bi bi-share"></i>
            </div>
            <h5 class="feature-title">تعزيز التفاعل</h5>
            <p class="feature-desc">
              أدوات تفاعل، تصويت مباشر، ربط الحضور بالمحتوى، وتجربة تواصل مثالية.
            </p>
          </div>
        </div>

        <div class="col-6 col-lg-3">
          <div class="feature-card text-center">
            <div class="feature-icon">
              <i class="bi bi-graph-up-arrow"></i>
            </div>
            <h5 class="feature-title">الذكاء التحليلي</h5>
            <p class="feature-desc">
              تقارير تحليلية دقيقة لفهم الأداء، وقياس الأثر، وتحسين القرارات.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PLATFORM PREVIEW -->
  <section class="py-5" id="platform">
    <div class="container text-center">
      <h2 class="section-title mb-2">قوتنا تكمن في تفاصيل لوحتنا</h2>
      <p class="section-desc mx-auto mb-4">
        تجربة بصرية سلسة وحديثة تعتمد على الحلول الرقمية المتكاملة.
      </p>

      <div class="preview-card mx-auto">
        <!-- ضع صورة اللابتوب/الداشبورد هنا -->
        <img
          src="img/Group 865.png"
          alt="Dashboard Preview"
          class="img-fluid"
        />
        <div class="sparkle"></div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer-dark py-4" id="contact">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
      <div class="small opacity-75">Event pro 2026</div>
      <div class="small opacity-75">جميع الحقوق محفوظة</div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="app.js"></script>
</body>
</html>

