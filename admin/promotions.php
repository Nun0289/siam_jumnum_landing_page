<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/functions.php';
requireLogin();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create' || $action === 'update') {
        $promo = [
            'title' => trim($_POST['title'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'excerpt' => trim($_POST['excerpt'] ?? ''),
            'content' => trim($_POST['content'] ?? ''),
            'is_active' => isset($_POST['is_active']) ? 1 : 0,
            'image_url' => $_POST['existing_image'] ?? '',
        ];

        if (!empty($_FILES['image']['name'])) {
            $uploaded = uploadImage($_FILES['image'], 'promo');
            if ($uploaded) $promo['image_url'] = $uploaded;
        }
        if (!$promo['image_url'] && $action === 'create') {
            $promo['image_url'] = '/assets/images/bg-diamond.png';
        }

        $id = $action === 'update' ? (int)$_POST['id'] : null;
        savePromotion($promo, $id);
        $message = $action === 'create' ? 'เพิ่มโปรโมชั่นเรียบร้อย' : 'อัปเดตโปรโมชั่นเรียบร้อย';
    }

    if ($action === 'delete') {
        deletePromotion((int)$_POST['id']);
        $message = 'ลบโปรโมชั่นเรียบร้อย';
    }
}

$promotions = getAllPromotions();
$editItem = isset($_GET['edit']) ? getPromotion((int)$_GET['edit']) : null;

$adminPage = 'promotions';
$adminTitle = 'จัดการโปรโมชั่น';
require __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-header">
    <h1>จัดการโปรโมชั่น / ข่าวสาร</h1>
</div>

<?php if ($message): ?>
<div class="alert alert--success"><?= e($message) ?></div>
<?php endif; ?>

<div class="card">
    <h2><?= $editItem ? 'แก้ไขโปรโมชั่น' : 'เพิ่มโปรโมชั่นใหม่' ?></h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="<?= $editItem ? 'update' : 'create' ?>">
        <?php if ($editItem): ?>
        <input type="hidden" name="id" value="<?= $editItem['id'] ?>">
        <input type="hidden" name="existing_image" value="<?= e($editItem['image_url']) ?>">
        <?php endif; ?>

        <div class="form-group">
            <label for="title">หัวข้อ *</label>
            <input type="text" id="title" name="title" required value="<?= e($editItem['title'] ?? '') ?>">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="slug">Slug (URL)</label>
                <input type="text" id="slug" name="slug" value="<?= e($editItem['slug'] ?? '') ?>" placeholder="diamond-cert">
            </div>
            <div class="form-group">
                <label for="image">รูปภาพ</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
        </div>

        <div class="form-group">
            <label for="excerpt">คำโปรย</label>
            <textarea id="excerpt" name="excerpt" rows="2"><?= e($editItem['excerpt'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label for="content">เนื้อหาเต็ม</label>
            <textarea id="content" name="content" rows="4"><?= e($editItem['content'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label><input type="checkbox" name="is_active" <?= ($editItem['is_active'] ?? 1) ? 'checked' : '' ?>> แสดงผล</label>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn--primary btn--sm"><?= $editItem ? 'บันทึก' : 'เพิ่ม' ?></button>
            <?php if ($editItem): ?>
            <a href="/admin/promotions.php" class="btn btn--sm" style="background:#eee;color:#333;text-decoration:none;">ยกเลิก</a>
            <?php endif; ?>
        </div>
    </form>
</div>

<div class="card">
    <h2>โปรโมชั่นทั้งหมด</h2>
    <table>
        <thead>
            <tr>
                <th>รูป</th>
                <th>หัวข้อ</th>
                <th>วันที่</th>
                <th>สถานะ</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($promotions as $pr): ?>
            <tr>
                <td><img src="<?= e(imageUrl($pr['image_url'])) ?>" alt=""></td>
                <td><?= e($pr['title']) ?></td>
                <td><?= date('d/m/Y', strtotime($pr['created_at'])) ?></td>
                <td><span class="badge badge--<?= $pr['is_active'] ? 'active' : 'inactive' ?>"><?= $pr['is_active'] ? 'แสดง' : 'ซ่อน' ?></span></td>
                <td class="actions">
                    <a href="?edit=<?= $pr['id'] ?>" class="btn btn--sm" style="background:#eee;color:#333;text-decoration:none;">แก้ไข</a>
                    <form method="POST" style="display:inline" onsubmit="return confirm('ลบโปรโมชั่นนี้?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $pr['id'] ?>">
                        <button type="submit" class="btn btn--danger btn--sm">ลบ</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/includes/admin-footer.php'; ?>
