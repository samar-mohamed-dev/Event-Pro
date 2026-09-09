<!-- contact.php -->
<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>تواصل معنا | Event Pro</title>

  <!-- Bootstrap RTL -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/contact.css" />
</head>

<body>
  <!-- NAV -->
  <nav class="navbar navbar-dark nav-dark">
    <div class="container py-2 d-flex align-items-center justify-content-between">
      <a href="index.php" class="back-link">Back</a>

      <div class="d-flex align-items-center gap-2 text-white">
        <span class="fw-bold">إيفنت برو <span class="opacity-75">| Event Pro</span></span>
        <span class="brand-badge" aria-hidden="true">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
            <img src="img/WhatsApp Image 2026-01-19 at 4.47.22 PM 1.png" width="50" alt="">
          </svg>
        </span>
      </div>
    </div>
  </nav>

  <!-- CONTENT -->
  <main class="py-5">
    <div class="container " style="text-align: right;">

      <!-- Title -->
      <div class="text-center mb-3">
        <h1 class="page-title">هل لديك استفسار؟</h1>
        <p class="page-subtitle">نحن هنا للمساعده في جعل مؤتمرك القادم تجربه استثنائيه</p>
      </div>

      <!-- Big Capsule Text -->
      <div class="capsule mx-auto mb-4">
        <p class="m-0">
          سواء كنت تبحث عن تفاصيل حول جدول الاعمال فرص الشراكه والرعايه او تحتاج الي
          مساعده تقنيه و فريقنا متاح الاجابه على جميع استفساراتك
        </p>
      </div>

      <!-- Inquiry Type -->
      <h2 class="section-title text-center mb-3">نوع الاستفسار</h2>

      <div class="inquiry-box mx-auto mb-4">
        <textarea class="inquiry-textarea" placeholder=""></textarea>
      </div>

      <!-- Form Fields -->
      <form id="contactForm" class="mx-auto form-wrap"  >
        <div class=" g-3  "  >
          <div class="col-lg-7 order-2 order-lg-1">
            <div class="stack-fields">
              <div class="field-row">
                <input class="pill-input" type="text" name="fullName" required />
                <label class="pill-label">الاسم كامل</label>
              </div>

              <div class="field-row">
                <input class="pill-input" type="email" name="email" required />
                <label class="pill-label">البريد الإلكتروني</label>
              </div>

              <div class="field-row">
                <input class="pill-input" type="tel" name="phone" required />
                <label class="pill-label">رقم الهاتف</label>
              </div>
            </div>
          </div>

          <!-- <div class="col-lg-5 order-1 order-lg-2"></div> -->
        </div>

        <!-- Submit -->
        <div class="text-center mt-4">
          <button class="btn send-btn" type="submit">ارسل الآن</button>
          <p class="note mt-3">سيتم الرد على استفسارك خلال 24 ساعه عمل كحد أقصى .</p>
        </div>
      </form>

      <!-- Image Card -->



    </div>
            <div class="img-center-screen">
          <!-- بدّلها بصورتك -->
          <img
            src="img/unsplash_eS72kLFS6s0.png"
            alt="Contact Us"
            class="img-fluid"
          />
        </div>
  </main>

  <!-- FOOTER -->
  <footer class="footer-dark py-3">
    <div class="container d-flex justify-content-center">
      <div class="small opacity-75">Event pro 2026</div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script >
    // contact.js
document.getElementById("contactForm")?.addEventListener("submit", (e) => {
  e.preventDefault();

  const form = e.currentTarget;
  const data = {
    inquiry: document.querySelector(".inquiry-textarea")?.value?.trim(),
    fullName: form.fullName.value.trim(),
    email: form.email.value.trim(),
    phone: form.phone.value.trim(),
  };

  // Demo behavior (بدون backend)
  if (!data.inquiry) {
    alert("من فضلك اكتب نوع الاستفسار.");
    return;
  }

  // هنا تقدر تربطه ب API لاحقاً
  console.log("Contact payload:", data);
  alert("تم إرسال استفسارك بنجاح ✅");

  form.reset();
  const ta = document.querySelector(".inquiry-textarea");
  if (ta) ta.value = "";
});
  </script>
</body>
</html>

