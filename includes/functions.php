<?php
require_once __DIR__ . '/db.php';

function getBanners(): array {
    $data = loadData();
    $banners = array_filter($data['banners'], fn($b) => $b['is_active']);
    usort($banners, fn($a, $b) => $a['sort_order'] <=> $b['sort_order']);
    return array_values($banners);
}

function getAllBanners(): array {
    $data = loadData();
    usort($data['banners'], fn($a, $b) => $a['sort_order'] <=> $b['sort_order']);
    return $data['banners'];
}

function getBanner(int $id): ?array {
    $data = loadData();
    foreach ($data['banners'] as $b) {
        if ($b['id'] === $id) return $b;
    }
    return null;
}

function saveBanner(array $banner, ?int $id = null): bool {
    $data = loadData();
    if ($id === null) {
        $banner['id'] = nextId('banners');
        $data['banners'][] = $banner;
    } else {
        foreach ($data['banners'] as &$b) {
            if ($b['id'] === $id) { $b = array_merge($b, $banner); break; }
        }
    }
    return saveData($data);
}

function deleteBanner(int $id): bool {
    $data = loadData();
    $data['banners'] = array_values(array_filter($data['banners'], fn($b) => $b['id'] !== $id));
    return saveData($data);
}

function getProducts(?string $category = null, bool $featuredOnly = false): array {
    $data = loadData();
    $products = array_filter($data['products'], function($p) use ($category, $featuredOnly) {
        if (!$p['is_active']) return false;
        if ($category && $p['category'] !== $category) return false;
        if ($featuredOnly && !$p['is_featured']) return false;
        return true;
    });
    usort($products, fn($a, $b) => $a['sort_order'] <=> $b['sort_order']);
    return array_values($products);
}

function getAllProducts(): array {
    $data = loadData();
    usort($data['products'], fn($a, $b) => $a['sort_order'] <=> $b['sort_order']);
    return $data['products'];
}

function getProduct(int $id): ?array {
    $data = loadData();
    foreach ($data['products'] as $p) {
        if ($p['id'] === $id) return $p;
    }
    return null;
}

function saveProduct(array $product, ?int $id = null): bool {
    $data = loadData();
    if ($id === null) {
        $product['id'] = nextId('products');
        $data['products'][] = $product;
    } else {
        foreach ($data['products'] as &$p) {
            if ($p['id'] === $id) { $p = array_merge($p, $product); break; }
        }
    }
    return saveData($data);
}

function deleteProduct(int $id): bool {
    $data = loadData();
    $data['products'] = array_values(array_filter($data['products'], fn($p) => $p['id'] !== $id));
    return saveData($data);
}

function getPromotions(int $limit = 6): array {
    $data = loadData();
    $promos = array_filter($data['promotions'], fn($p) => $p['is_active']);
    usort($promos, fn($a, $b) => strcmp($b['created_at'], $a['created_at']));
    return array_slice(array_values($promos), 0, $limit);
}

function getAllPromotions(): array {
    $data = loadData();
    usort($data['promotions'], fn($a, $b) => strcmp($b['created_at'], $a['created_at']));
    return $data['promotions'];
}

function getPromotion(int $id): ?array {
    $data = loadData();
    foreach ($data['promotions'] as $p) {
        if ($p['id'] === $id) return $p;
    }
    return null;
}

function savePromotion(array $promo, ?int $id = null): bool {
    $data = loadData();
    if ($id === null) {
        $promo['id'] = nextId('promotions');
        $promo['created_at'] = date('Y-m-d');
        $data['promotions'][] = $promo;
    } else {
        foreach ($data['promotions'] as &$p) {
            if ($p['id'] === $id) { $p = array_merge($p, $promo); break; }
        }
    }
    return saveData($data);
}

function deletePromotion(int $id): bool {
    $data = loadData();
    $data['promotions'] = array_values(array_filter($data['promotions'], fn($p) => $p['id'] !== $id));
    return saveData($data);
}

function categoryLabel(string $cat): string {
    return match ($cat) {
        'diamond' => __('category.diamond'),
        'watch' => __('category.watch'),
        'bag' => __('category.bag'),
        default => $cat,
    };
}

function e(?string $str): string {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

function isLoggedIn(): bool {
    return !empty($_SESSION['admin_logged_in']);
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        header('Location: /admin/index.php');
        exit;
    }
}

function uploadImage(array $file, string $prefix = 'img'): ?string {
    if ($file['error'] !== UPLOAD_ERR_OK) return null;
    $allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    if (!in_array($file['type'], $allowed)) return null;

    if (!is_dir(UPLOAD_PATH)) mkdir(UPLOAD_PATH, 0755, true);

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = $prefix . '_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    $dest = UPLOAD_PATH . '/' . $filename;

    if (move_uploaded_file($file['tmp_name'], $dest)) {
        return UPLOAD_URL . '/' . $filename;
    }
    return null;
}

function themeImageUrl(string $path): string {
    if (!function_exists('currentThemeId')) {
        require_once __DIR__ . '/themes.php';
    }

    $path = '/' . ltrim($path, '/');
    $theme = currentThemeId();
    $dir = dirname($path);
    $name = pathinfo($path, PATHINFO_FILENAME);
    $ext = pathinfo($path, PATHINFO_EXTENSION) ?: 'png';

    foreach (['classic', 'blanc', 'noir'] as $suffix) {
        if (str_ends_with($name, '-' . $suffix)) {
            $name = substr($name, 0, -strlen('-' . $suffix));
            break;
        }
    }

    $themedPath = $dir . '/' . $name . '-' . $theme . '.' . $ext;
    if (file_exists(BASE_PATH . $themedPath)) {
        return assetUrl($themedPath);
    }

    $basePath = $dir . '/' . $name . '.' . $ext;
    if (file_exists(BASE_PATH . $basePath)) {
        return assetUrl($basePath);
    }

    return assetUrl($path);
}

function imageUrl(string $url, string $category = ''): string {
    $fallbacks = [
        'diamond' => '/assets/images/bg-diamond.png',
        'watch' => '/assets/images/bg-watch.png',
        'bag' => '/assets/images/bg-bag.png',
    ];

    if (str_starts_with($url, '/assets/') || str_starts_with($url, 'assets/')) {
        $path = '/' . ltrim($url, '/');
        if (file_exists(BASE_PATH . $path) || $category) {
            return themeImageUrl($path);
        }
        if ($category && isset($fallbacks[$category])) {
            return themeImageUrl($fallbacks[$category]);
        }
    }

    if (str_starts_with($url, 'http')) {
        return $url;
    }

    $path = str_starts_with($url, '/') ? $url : '/' . ltrim($url, '/');
    if ($category && isset($fallbacks[$category]) && !file_exists(BASE_PATH . $path)) {
        return themeImageUrl($fallbacks[$category]);
    }

    return $path;
}

function countItems(string $type): int {
    $data = loadData();
    return count($data[$type] ?? []);
}

function assetUrl(string $path): string {
    $fullPath = BASE_PATH . $path;
    $version = file_exists($fullPath) ? (string) filemtime($fullPath) : (string) time();
    return $path . '?v=' . $version;
}
