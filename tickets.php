<?php
require_once __DIR__ . '/backend/helpers.php';
require_once __DIR__ . '/backend/conferences/read.php';
require_once __DIR__ . '/backend/tickets/read.php';
require_once __DIR__ . '/backend/bookings/read.php';
$user = current_user();
$conferenceId = (int) ($_GET['conference_id'] ?? 0);
$conference = $conferenceId > 0 ? get_conference_by_id($conferenceId, true) : null;
$tickets = $conference ? get_tickets_by_conference((int) $conference['id'], true) : [];
$bookings = ($user && $user['role'] === 'user') ? get_user_bookings((int) $user['id']) : [];
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>شراء التذاكر | Event Pro</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/tickets.css">
</head>
<body>
<nav class="navbar navbar-dark nav-dark">
  <div class="container d-flex justify-content-between align-items-center py-2">
    <div class="d-flex align-items-center gap-2 text-white">
      <img src="img/WhatsApp Image 2026-01-19 at 4.47.22 PM 1.png" width="50" alt="Event Pro Logo">
      <span class="fw-bold">إيفنت برو | Event Pro</span>
    </div>
    <a href="choose-conference.php" class="back-link">Back</a>
  </div>
</nav>

<header class="hero">
  <img src="img/12.png" class="hero-img" alt="Event header">
  <div class="hero-pill">
    <?= $conference ? 'احجز تذكرتك الآن لحضور مؤتمر ' . e((string) $conference['title']) : 'احجز تذكرتك الآن وكن جزءاً من الحدث الذي ينتظره الجميع' ?>
  </div>
</header>

<section class="py-5">
  <div class="container text-center">
    <h2 class="section-title mb-2"><?= $conference ? e((string) $conference['title']) : 'اختر مؤتمرًا أولاً' ?></h2>
    <p class="section-subtitle mb-4"><?= $conference ? e((string) $conference['location']) . ' - ' . e(format_date_label((string) $conference['starts_at'])) . ' - ' . e(format_time_label((string) $conference['starts_at'])) : '' ?></p>

    <div class="row g-4 justify-content-center">
      <?php if (!$tickets): ?>
        <div class="empty-state">لا توجد تذاكر متاحة لهذا المؤتمر حاليا.</div>
      <?php else: ?>
        <?php foreach ($tickets as $ticket): ?>
          <div class="col-md-4">
            <div class="price-card selectable-ticket" data-ticket-id="<?= (int) $ticket['id'] ?>">
              <h3><?= e((string) $ticket['ticket_name']) ?></h3>
              <p>سعر التذكرة</p>
              <div class="price"><?= e(format_money((float) $ticket['price'])) ?></div>
            </div>
            <div class="stock-card p-4">عدد التذاكر المتوفرة <b><?= (int) $ticket['remaining_quantity'] ?> تذكرة</b></div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <hr class="my-5">

    <form id="ticketForm" class="ticket-form" method="post" action="backend/bookings/create.php">
      <input type="hidden" id="selectedTicketId" name="ticket_id">
      <div class="field-row">
        <label for="ticket-name">الاسم</label>
        <input id="ticket-name" name="attendee_name" type="text" value="<?= e((string) ($user['name'] ?? '')) ?>" required>
      </div>
      <div class="field-row">
        <label for="ticket-email">البريد الالكتروني</label>
        <input id="ticket-email" name="attendee_email" type="email" value="<?= e((string) ($user['email'] ?? '')) ?>" required>
      </div>
      <div class="field-row">
        <label for="ticket-phone">رقم الهاتف</label>
        <input id="ticket-phone" name="attendee_phone" type="text" value="<?= e((string) ($user['phone'] ?? '')) ?>" required>
      </div>
      <div class="field-row">
        <label for="ticket-quantity">العدد</label>
        <input id="ticket-quantity" name="quantity" type="number" min="1" value="1" required>
      </div>

      <div class="fielddd">
        <div class="payment">
          <img src="img/Payment Logo.png" class="visa" alt="Visa">
          <img src="img/Group 795.png" class="wallet-pay" alt="Electronic wallet">
        </div>
        <div class="text-center">
          <button class="book-btn" type="submit">احجز الآن</button>
        </div>
      </div>
    </form>

    <section class="bookings-section mt-5">
      <h3 class="bookings-title">حجوزاتي</h3>
      <div class="bookings-list">
        <?php if (!$user || $user['role'] !== 'user'): ?>
          <div class="empty-state">سجل دخولك لعرض حجوزاتك الحالية.</div>
        <?php elseif (!$bookings): ?>
          <div class="empty-state">لا توجد حجوزات مسجلة باسمك حتى الآن.</div>
        <?php else: ?>
          <?php foreach ($bookings as $booking): ?>
            <article class="booking-card">
              <div>
                <strong><?= e((string) $booking['conference_title']) ?></strong>
                <div class="booking-meta"><?= e((string) $booking['ticket_name']) ?> - <?= (int) $booking['quantity'] ?> تذكرة</div>
                <div class="booking-meta"><?= e(format_money((float) $booking['total_amount'])) ?> - <?= e((string) $booking['status']) ?></div>
              </div>
              <div class="booking-actions">
                <form method="post" action="backend/bookings/delete.php">
                  <input type="hidden" name="id" value="<?= (int) $booking['id'] ?>">
                  <input type="hidden" name="conference_id" value="<?= $conference ? (int) $conference['id'] : 0 ?>">
                  <button type="submit" <?= $booking['status'] === 'cancelled' ? 'disabled' : '' ?>>إلغاء</button>
                </form>
              </div>
            </article>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </section>

    <div class="text-center mt-5">
      <img src="img/image.png" alt="Illustration" class="illus">
    </div>
  </div>
</section>

<footer class="footer-dark py-2 text-center">
  <small>Event Pro 2026</small>
</footer>

<script>
document.querySelectorAll(".selectable-ticket").forEach((card) => {
  card.addEventListener("click", () => {
    document.querySelectorAll(".selectable-ticket").forEach((item) => item.classList.remove("selected"));
    card.classList.add("selected");
    document.getElementById("selectedTicketId").value = card.dataset.ticketId;
  });
});

document.getElementById("ticketForm")?.addEventListener("submit", function (e) {
  <?php if (!$user || $user['role'] !== 'user'): ?>
  e.preventDefault();
  window.location.href = "login.php?redirect=<?= e('tickets.php?conference_id=' . $conferenceId) ?>";
  return;
  <?php endif; ?>

  if (!document.getElementById("selectedTicketId").value) {
    e.preventDefault();
    alert("اختر نوع التذكرة أولاً.");
  }
});
</script>
<?php if (page_alert() !== ''): ?>
<script>alert(<?= json_encode(page_alert(), JSON_UNESCAPED_UNICODE) ?>);</script>
<?php endif; ?>
</body>
</html>