<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/functions.php';
requireLogin();

$adminPage = 'dashboard';
$adminTitle = 'Dashboard';
require __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-header">
    <h1>Dashboard</h1>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card__number"><?= countItems('banners') ?></div>
        <div class="stat-card__label">แบนเนอร์</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__number"><?= countItems('products') ?></div>
        <div class="stat-card__label">สินค้า</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__number"><?= countItems('promotions') ?></div>
        <div class="stat-card__label">โปรโมชั่น</div>
    </div>
</div>

<div class="card">
    <h2>ยินดีต้อนรับสู่ระบบจัดการเนื้อหา</h2>
    <p>ใช้เมนูด้านซ้ายเพื่อจัดการแบนเนอร์ สินค้า และโปรโมชั่นบนเว็บไซต์สยามจำนำ</p>
    <p style="margin-top: 12px;"><a href="/" target="_blank">ดูเว็บไซต์ →</a></p>
</div>

<?php require __DIR__ . '/includes/admin-footer.php'; ?>
