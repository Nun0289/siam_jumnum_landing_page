<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/functions.php';
requireLogin();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create' || $action === 'update') {
        $banner = [
            'title' => trim($_POST['title'] ?? ''),
            'subtitle' => trim($_POST['subtitle'] ?? ''),
            'link_url' => trim($_POST['link_url'] ?? ''),
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
            'is_active' => isset($_POST['is_active']) ? 1 : 0,
            'image_url' => $_POST['existing_image'] ?? '',
        ];

        if (!empty($_FILES['image']['name'])) {
            $uploaded = uploadImage($_FILES['image'], 'banner');
            if ($uploaded) $banner['image_url'] = $uploaded;
        }
        if (!$banner['image_url'] && $action === 'create') {
            $banner['image_url'] = '/assets/images/banner-store-collage.png';
        }

        $id = $action === 'update' ? (int)$_POST['id'] : null;
        saveBanner($banner, $id);
        $message = $action === 'create' ? 'เพิ่มแบนเนอร์เรียบร้อย' : 'อัปเดตแบนเนอร์เรียบร้อย';
    }

    if ($action === 'delete') {
        deleteBanner((int)$_POST['id']);
        $message = 'ลบแบนเนอร์เรียบร้อย';
    }
}

$banners = getAllBanners();
$editItem = isset($_GET['edit']) ? getBanner((int)$_GET['edit']) : null;

$adminPage = 'banners';
$adminTitle = 'จัดการแบนเนอร์';
require __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-header">
    <h1>จัดการแบนเนอร์</h1>
</div>

<?php if ($message): ?>
<div class="alert alert--success"><?= e($message) ?></div>
<?php endif; ?>

<div class="card">
    <h2><?= $editItem ? 'แก้ไขแบนเนอร์' : 'เพิ่มแบนเนอร์ใหม่' ?></h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="<?= $editItem ? 'update' : 'create' ?>">
        <?php if ($editItem): ?>
        <input type="hidden" name="id" value="<?= $editItem['id'] ?>">
        <input type="hidden" name="existing_image" value="<?= e($editItem['image_url']) ?>">
        <?php endif; ?>

        <div class="form-row">
            <div class="form-group">
                <label for="title">หัวข้อ *</label>
                <input type="text" id="title" name="title" required value="<?= e($editItem['title'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="subtitle">คำบรรยาย</label>
                <input type="text" id="subtitle" name="subtitle" value="<?= e($editItem['subtitle'] ?? '') ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="image">รูปภาพ <?= $editItem ? '(เว้นว่างเพื่อใช้รูปเดิม)' : '' ?></label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <div class="form-group">
                <label for="link_url">ลิงก์</label>
                <input type="text" id="link_url" name="link_url" value="<?= e($editItem['link_url'] ?? '') ?>" placeholder="#products">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="sort_order">ลำดับ</label>
                <input type="number" id="sort_order" name="sort_order" value="<?= $editItem['sort_order'] ?? 0 ?>">
            </div>
            <div class="form-group" style="display:flex;align-items:center;padding-top:24px;">
                <label><input type="checkbox" name="is_active" <?= ($editItem['is_active'] ?? 1) ? 'checked' : '' ?>> แสดงผล</label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn--primary btn--sm"><?= $editItem ? 'บันทึก' : 'เพิ่ม' ?></button>
            <?php if ($editItem): ?>
            <a href="/admin/banners.php" class="btn btn--sm" style="background:#eee;color:#333;text-decoration:none;">ยกเลิก</a>
            <?php endif; ?>
        </div>
    </form>
</div>

<div class="card">
    <h2>แบนเนอร์ทั้งหมด</h2>
    <table>
        <thead>
            <tr>
                <th>รูป</th>
                <th>หัวข้อ</th>
                <th>ลำดับ</th>
                <th>สถานะ</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($banners as $b): ?>
            <tr>
                <td><img src="<?= e(imageUrl($b['image_url'])) ?>" alt=""></td>
                <td><?= e($b['title']) ?></td>
                <td><?= $b['sort_order'] ?></td>
                <td><span class="badge badge--<?= $b['is_active'] ? 'active' : 'inactive' ?>"><?= $b['is_active'] ? 'แสดง' : 'ซ่อน' ?></span></td>
                <td class="actions">
                    <a href="?edit=<?= $b['id'] ?>" class="btn btn--sm" style="background:#eee;color:#333;text-decoration:none;">แก้ไข</a>
                    <form method="POST" style="display:inline" onsubmit="return confirm('ลบแบนเนอร์นี้?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $b['id'] ?>">
                        <button type="submit" class="btn btn--danger btn--sm">ลบ</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/includes/admin-footer.php'; ?>
