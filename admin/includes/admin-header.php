<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/functions.php';

$adminPage = $adminPage ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($adminTitle ?? 'Admin') ?> | สยามจำนำ CMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/admin.css">
</head>
<body>
<div class="admin-layout">
    <aside class="sidebar">
        <div class="sidebar__brand">
            <h2>สยามจำนำ</h2>
            <span>Content Management</span>
        </div>
        <nav>
            <a href="/admin/dashboard.php" class="<?= $adminPage === 'dashboard' ? 'active' : '' ?>">Dashboard</a>
            <a href="/admin/banners.php" class="<?= $adminPage === 'banners' ? 'active' : '' ?>">แบนเนอร์</a>
            <a href="/admin/products.php" class="<?= $adminPage === 'products' ? 'active' : '' ?>">สินค้า</a>
            <a href="/admin/promotions.php" class="<?= $adminPage === 'promotions' ? 'active' : '' ?>">โปรโมชั่น</a>
            <a href="/" target="_blank">ดูเว็บไซต์ →</a>
            <a href="/admin/logout.php">ออกจากระบบ</a>
        </nav>
    </aside>
    <main class="admin-main">
