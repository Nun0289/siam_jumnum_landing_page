<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/functions.php';
requireLogin();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create' || $action === 'update') {
        $product = [
            'title' => trim($_POST['title'] ?? ''),
            'category' => $_POST['category'] ?? 'diamond',
            'brand' => trim($_POST['brand'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'price_label' => trim($_POST['price_label'] ?? 'ประเมินราคา'),
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
            'is_active' => isset($_POST['is_active']) ? 1 : 0,
            'image_url' => $_POST['existing_image'] ?? '',
        ];

        if (!empty($_FILES['image']['name'])) {
            $uploaded = uploadImage($_FILES['image'], 'product');
            if ($uploaded) $product['image_url'] = $uploaded;
        }
        if (!$product['image_url'] && $action === 'create') {
            $product['image_url'] = '/assets/images/bg-diamond.png';
        }

        $id = $action === 'update' ? (int)$_POST['id'] : null;
        saveProduct($product, $id);
        $message = $action === 'create' ? 'เพิ่มสินค้าเรียบร้อย' : 'อัปเดตสินค้าเรียบร้อย';
    }

    if ($action === 'delete') {
        deleteProduct((int)$_POST['id']);
        $message = 'ลบสินค้าเรียบร้อย';
    }
}

$products = getAllProducts();
$editItem = isset($_GET['edit']) ? getProduct((int)$_GET['edit']) : null;

$adminPage = 'products';
$adminTitle = 'จัดการสินค้า';
require __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-header">
    <h1>จัดการสินค้า</h1>
</div>

<?php if ($message): ?>
<div class="alert alert--success"><?= e($message) ?></div>
<?php endif; ?>

<div class="card">
    <h2><?= $editItem ? 'แก้ไขสินค้า' : 'เพิ่มสินค้าใหม่' ?></h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="<?= $editItem ? 'update' : 'create' ?>">
        <?php if ($editItem): ?>
        <input type="hidden" name="id" value="<?= $editItem['id'] ?>">
        <input type="hidden" name="existing_image" value="<?= e($editItem['image_url']) ?>">
        <?php endif; ?>

        <div class="form-row">
            <div class="form-group">
                <label for="title">ชื่อสินค้า *</label>
                <input type="text" id="title" name="title" required value="<?= e($editItem['title'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="brand">แบรนด์</label>
                <input type="text" id="brand" name="brand" value="<?= e($editItem['brand'] ?? '') ?>" placeholder="Rolex, Hermès, GIA">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="category">หมวดหมู่</label>
                <select id="category" name="category">
                    <option value="diamond" <?= ($editItem['category'] ?? '') === 'diamond' ? 'selected' : '' ?>>เพชร</option>
                    <option value="watch" <?= ($editItem['category'] ?? '') === 'watch' ? 'selected' : '' ?>>นาฬิกา</option>
                    <option value="bag" <?= ($editItem['category'] ?? '') === 'bag' ? 'selected' : '' ?>>กระเป๋า</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price_label">ป้ายราคา/CTA</label>
                <input type="text" id="price_label" name="price_label" value="<?= e($editItem['price_label'] ?? 'ประเมินราคา') ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="description">รายละเอียด</label>
            <textarea id="description" name="description" rows="2"><?= e($editItem['description'] ?? '') ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="image">รูปภาพ</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <div class="form-group">
                <label for="sort_order">ลำดับ</label>
                <input type="number" id="sort_order" name="sort_order" value="<?= $editItem['sort_order'] ?? 0 ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group" style="display:flex;align-items:center;gap:24px;padding-top:8px;">
                <label><input type="checkbox" name="is_featured" <?= ($editItem['is_featured'] ?? 0) ? 'checked' : '' ?>> สินค้าแนะนำ</label>
                <label><input type="checkbox" name="is_active" <?= ($editItem['is_active'] ?? 1) ? 'checked' : '' ?>> แสดงผล</label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn--primary btn--sm"><?= $editItem ? 'บันทึก' : 'เพิ่ม' ?></button>
            <?php if ($editItem): ?>
            <a href="/admin/products.php" class="btn btn--sm" style="background:#eee;color:#333;text-decoration:none;">ยกเลิก</a>
            <?php endif; ?>
        </div>
    </form>
</div>

<div class="card">
    <h2>สินค้าทั้งหมด</h2>
    <table>
        <thead>
            <tr>
                <th>รูป</th>
                <th>ชื่อ</th>
                <th>หมวด</th>
                <th>แบรนด์</th>
                <th>สถานะ</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $p): ?>
            <tr>
                <td><img src="<?= e(imageUrl($p['image_url'])) ?>" alt=""></td>
                <td><?= e($p['title']) ?></td>
                <td><?= e(categoryLabel($p['category'])) ?></td>
                <td><?= e($p['brand']) ?></td>
                <td>
                    <span class="badge badge--<?= $p['is_active'] ? 'active' : 'inactive' ?>"><?= $p['is_active'] ? 'แสดง' : 'ซ่อน' ?></span>
                    <?php if ($p['is_featured']): ?> ⭐<?php endif; ?>
                </td>
                <td class="actions">
                    <a href="?edit=<?= $p['id'] ?>" class="btn btn--sm" style="background:#eee;color:#333;text-decoration:none;">แก้ไข</a>
                    <form method="POST" style="display:inline" onsubmit="return confirm('ลบสินค้านี้?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                        <button type="submit" class="btn btn--danger btn--sm">ลบ</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/includes/admin-footer.php'; ?>
