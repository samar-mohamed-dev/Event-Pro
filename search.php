<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>بحث | Event Pro</title>

  <!-- Bootstrap RTL -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800;900&display=swap" rel="stylesheet">

  <!-- Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <link rel="stylesheet" href="css/search.css" />
</head>

<body>

<!-- NAV -->
<nav class="navbar navbar-dark nav-dark">
  <div class="container py-2 d-flex align-items-center justify-content-between">
    <a href="index.php" class="back-link">Back</a>

    <div class="d-flex align-items-center gap-2 text-white">
      <span class="fw-bold">إيفنت برو | Event Pro</span>
      <img src="img/WhatsApp Image 2026-01-19 at 4.47.22 PM 1.png" width="50" alt="Event Pro Logo">
    </div>
  </div>
</nav>

<main class="py-5">
  <div class="container text-center">

    <!-- Logo -->
    <div class="logo-wrap mb-3">
      <img src="img/WhatsApp Image 2026-01-19 at 4.47.22 PM 1.png" alt="logo">
    </div>

    <h1 class="brand-title mb-4">Event pro</h1>

    <!-- Search Box -->
    <section class="search-box mx-auto mb-5">

      <div class="tabs-row" dir="rtl">
        <button class="tab-btn active" data-tab="advanced">بحث متقدم</button>
        <button class="tab-btn" data-tab="quick">بحث سريع</button>
      </div>

      <div class="divider"></div>

      <div class="search-input-wrap">
        <input id="searchInput" type="text" class="search-input"
               placeholder="... ابحث بالاسم او الموضوع او الموقع">
      </div>

    </section>

    <!-- Social Box -->
    <section class="social-box mx-auto mb-4">
      <div class="social-icons">
        <a class="soc facebook" href="#" title="Facebook"><i class="bi bi-facebook"></i></a>
        <a class="soc tiktok" href="#" title="TikTok"><i class="bi bi-tiktok"></i></a>
        <a class="soc insta" href="#" title="Instagram"><i class="bi bi-instagram"></i></a>
        <a class="soc telegram" href="#" title="Telegram"><i class="bi bi-telegram"></i></a>
        <a class="soc whatsapp" href="#" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
      </div>

      <div class="actions mt-4">
        <button class="pill-action" type="button">
          <span class="icon-circle"><i class="bi bi-envelope"></i></span>
          <span>مشاركه</span>
        </button>

        <button class="pill-action" type="button">
          <span class="icon-circle"><i class="bi bi-plus"></i></span>
          <span>متابعه</span>
        </button>
      </div>
    </section>

    <div class="country-title mt-5">Event Pro &nbsp; / &nbsp; Egypt</div>
  </div>
</main>

<!-- FOOTER -->
<footer class="footer-dark py-2 text-center">
  <small>Event pro 2026</small>
</footer>

<script >
  // Tabs UI فقط (بدون API)
document.querySelectorAll(".tab-btn").forEach(btn => {
  btn.addEventListener("click", () => {
    document.querySelectorAll(".tab-btn").forEach(b => b.classList.remove("active"));
    btn.classList.add("active");

    const input = document.getElementById("searchInput");
    if (btn.dataset.tab === "advanced") {
      input.placeholder = "... ابحث بالاسم او الموضوع او الموقع";
    } else {
      input.placeholder = "... اكتب كلمة سريعة للبحث";
    }
  });
});

// Demo submit on Enter
document.getElementById("searchInput")?.addEventListener("keydown", (e) => {
  if (e.key === "Enter") {
    e.preventDefault();
    alert("بحث: " + e.target.value);
  }
});
</script>
</body>
</html>

