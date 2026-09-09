<?php
require_once __DIR__ . '/backend/helpers.php';
require_once __DIR__ . '/backend/conferences/read.php';
require_once __DIR__ . '/backend/tickets/read.php';
$admin = require_login('admin');
$conferenceId = (int) ($_GET['id'] ?? 0);
$editTicketId = (int) ($_GET['edit_ticket'] ?? 0);
$conference = $conferenceId > 0 ? get_conference_by_id($conferenceId) : null;
$tickets = $conferenceId > 0 ? get_tickets_by_conference($conferenceId) : [];
$editTicket = $editTicketId > 0 ? get_ticket_by_id($editTicketId) : null;
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>إنشاء مؤتمر جديد | Event Pro</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/create-conference.css">
</head>
<body>
<nav class="navbar navbar-dark nav-dark">
  <div class="container d-flex justify-content-between align-items-center py-2">
    <a href="metrics.php" class="back-link">Back</a>
    <a class="navbar-brand d-flex align-items-center gap-2" href="#">
      <span class="fw-bold">إيفنت برو <span class="opacity-75">| Event Pro</span></span>
      <span class="brand-badge"><img src="img/WhatsApp Image 2026-01-19 at 4.47.22 PM 1.png" width="50" alt=""></span>
    </a>
  </div>
</nav>

<header class="hero">
  <img src="img/unsplash_phlc0v-lcvw (1).png" class="hero-img" alt="">
  <div class="hero-pill"><?= $conference ? 'تعديل المؤتمر' : 'إنشاء مؤتمر جديد' ?></div>
</header>

<section class="py-5">
  <div class="container">
    <form action="backend/conferences/save.php" method="post" class="create-form mx-auto">
      <input type="hidden" name="id" value="<?= $conference ? (int) $conference['id'] : 0 ?>">

      <div class="form-row">
        <input name="title" type="text" value="<?= e((string) ($conference['title'] ?? '')) ?>" required>
        <div class="form-label">اسم المؤتمر</div>
      </div>

      <div class="form-row">
        <input name="location" type="text" value="<?= e((string) ($conference['location'] ?? '')) ?>" required>
        <div class="form-label">مكان المؤتمر</div>
      </div>

      <div class="form-row">
        <input name="starts_at" type="datetime-local" value="<?= e(isset($conference['starts_at']) ? str_replace(' ', 'T', substr((string) $conference['starts_at'], 0, 16)) : '') ?>" required>
        <div class="form-label">بداية المؤتمر</div>
      </div>

      <div class="form-row">
        <input name="ends_at" type="datetime-local" value="<?= e(isset($conference['ends_at']) && $conference['ends_at'] ? str_replace(' ', 'T', substr((string) $conference['ends_at'], 0, 16)) : '') ?>">
        <div class="form-label">نهاية المؤتمر</div>
      </div>

      <div class="form-row">
        <select name="status">
          <?php $status = (string) ($conference['status'] ?? 'published'); ?>
          <option value="published" <?= $status === 'published' ? 'selected' : '' ?>>منشور</option>
          <option value="draft" <?= $status === 'draft' ? 'selected' : '' ?>>مسودة</option>
          <option value="archived" <?= $status === 'archived' ? 'selected' : '' ?>>مؤرشف</option>
        </select>
        <div class="form-label">الحالة</div>
      </div>

      <div class="form-row form-row-large">
        <textarea name="description" rows="4" placeholder="وصف قصير للمؤتمر"><?= e((string) ($conference['description'] ?? '')) ?></textarea>
        <div class="form-label">الوصف</div>
      </div>

      <div class="buttons-row mt-5">
        <a href="available-conferences.php" class="btn-turq text-decoration-none">المؤتمرات الحالية</a>
        <a href="reports.php" class="btn-turq text-decoration-none">التقارير و التحليلات</a>
        <button type="submit" class="btn-turq">حفظ المؤتمر</button>
      </div>
    </form>

    <?php if ($conferenceId > 0): ?>
    <section class="ticket-panel mt-5">
      <div class="panel-head">
        <h2 class="panel-title">إدارة أنواع التذاكر</h2>
        <p class="panel-subtitle">يمكنك إضافة أو تعديل أنواع التذاكر الخاصة بهذا المؤتمر.</p>
      </div>

      <form action="backend/tickets/save.php" method="post" class="ticket-form-grid">
        <input type="hidden" name="id" value="<?= (int) ($editTicket['id'] ?? 0) ?>">
        <input type="hidden" name="conference_id" value="<?= $conferenceId ?>">
        <input name="ticket_name" type="text" placeholder="اسم التذكرة" value="<?= e((string) ($editTicket['ticket_name'] ?? '')) ?>" required>
        <input name="price" type="number" min="0" step="0.01" placeholder="السعر" value="<?= e((string) ($editTicket['price'] ?? '')) ?>" required>
        <input name="quantity" type="number" min="1" placeholder="الكمية" value="<?= e((string) ($editTicket['quantity'] ?? '')) ?>" required>
        <?php $ticketStatus = (string) ($editTicket['status'] ?? 'active'); ?>
        <select name="status">
          <option value="active" <?= $ticketStatus === 'active' ? 'selected' : '' ?>>نشطة</option>
          <option value="inactive" <?= $ticketStatus === 'inactive' ? 'selected' : '' ?>>غير نشطة</option>
          <option value="archived" <?= $ticketStatus === 'archived' ? 'selected' : '' ?>>مؤرشفة</option>
        </select>
        <button type="submit" class="btn-turq"><?= $editTicket ? 'تحديث التذكرة' : 'إضافة تذكرة' ?></button>
      </form>

      <div class="ticket-grid">
        <?php if (!$tickets): ?>
          <div class="empty-state">لا توجد تذاكر بعد.</div>
        <?php else: ?>
          <?php foreach ($tickets as $ticket): ?>
            <article class="ticket-item">
              <div class="ticket-item-head">
                <strong><?= e((string) $ticket['ticket_name']) ?></strong>
                <span class="status-pill status-<?= e((string) $ticket['status']) ?>"><?= e((string) $ticket['status']) ?></span>
              </div>
              <div class="ticket-meta">السعر: <?= e(format_money((float) $ticket['price'])) ?></div>
              <div class="ticket-meta">الكمية الكلية: <?= (int) $ticket['quantity'] ?></div>
              <div class="ticket-meta">المتبقي: <?= (int) $ticket['remaining_quantity'] ?></div>
              <div class="ticket-meta">المباع: <?= (int) $ticket['sold_count'] ?></div>
              <div class="ticket-actions">
                <a href="create-conference.php?id=<?= $conferenceId ?>&edit_ticket=<?= (int) $ticket['id'] ?>" class="btn-turq small-action text-decoration-none">تعديل</a>
                <form method="post" action="backend/tickets/delete.php" onsubmit="return confirm('هل تريد حذف هذا النوع من التذاكر؟');">
                  <input type="hidden" name="id" value="<?= (int) $ticket['id'] ?>">
                  <input type="hidden" name="conference_id" value="<?= $conferenceId ?>">
                  <button type="submit" class="btn-turq small-action danger-action">حذف</button>
                </form>
              </div>
            </article>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </section>
    <?php endif; ?>

    <div class="text-center mt-5">
      <img src="img/image.png" class="illus" alt="">
    </div>
  </div>
</section>

<footer class="footer-dark py-2 text-center">
  <small>Event pro 2026</small>
</footer>

<?php if (page_alert() !== ''): ?>
<script>alert(<?= json_encode(page_alert(), JSON_UNESCAPED_UNICODE) ?>);</script>
<?php endif; ?>
</body>
</html>

