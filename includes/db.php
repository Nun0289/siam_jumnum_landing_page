<?php
require_once __DIR__ . '/../config/config.php';

define('DATA_FILE', BASE_PATH . '/database/content.json');

function loadData(): array {
    if (!file_exists(DATA_FILE)) {
        return getDefaultData();
    }
    $json = file_get_contents(DATA_FILE);
    $data = json_decode($json, true);
    return is_array($data) ? $data : getDefaultData();
}

function saveData(array $data): bool {
    $dir = dirname(DATA_FILE);
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    return file_put_contents(DATA_FILE, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false;
}

function getDefaultData(): array {
    return [
        'banners' => [
            ['id' => 1, 'title' => 'สยามจำนำ', 'subtitle' => 'รับซื้อ · ขายฝาก เพชร ทอง นาฬิกา สินค้าแบรนด์เนม', 'image_url' => '/assets/images/banner-store-collage.png', 'banner_style' => 'store', 'link_url' => '#contact', 'sort_order' => 1, 'is_active' => 1],
            ['id' => 2, 'title' => 'ห้างทองเพชร เยาวราช', 'subtitle' => 'ศูนย์รับจำนำเพชรเม็ดใหญ่ และสินค้าแบรนด์เนม ครบวงจร', 'image_url' => '/assets/images/banner-store-hero.png', 'banner_style' => 'store', 'link_url' => '#about', 'sort_order' => 2, 'is_active' => 0],
            ['id' => 3, 'title' => 'รับจำนำเพชรใบเซอร์', 'subtitle' => 'GIA · HRD · IGI — ให้ราคาสูง จ่ายเงินสด\u00a0ทันที', 'image_url' => '/assets/images/bg-diamond.png', 'banner_style' => 'product', 'link_url' => '#products', 'sort_order' => 3, 'is_active' => 1],
            ['id' => 4, 'title' => 'รับจำนำนาฬิกาแบรนด์เนม', 'subtitle' => 'Rolex · Patek Philippe · Richard Mille · Panerai', 'image_url' => '/assets/images/bg-watch.png', 'banner_style' => 'product', 'link_url' => '#products', 'sort_order' => 4, 'is_active' => 1],
            ['id' => 5, 'title' => 'เยี่ยมชมสาขาของเรา', 'subtitle' => 'สยามจำนำ · ใจกลางเยาวราช กรุงเทพฯ', 'image_url' => '/assets/images/banner-storefront.png', 'banner_style' => 'store', 'link_url' => '#contact', 'sort_order' => 5, 'is_active' => 1],
        ],
        'products' => [
            ['id' => 1, 'title' => 'เพชรใบเซอร์ GIA 1.5 กะรัต', 'category' => 'diamond', 'brand' => 'GIA', 'description' => 'เพชรใบเซอร์คุณภาพสูง ประเมินราคาให้สูงสุด', 'image_url' => '/assets/images/bg-diamond.png', 'price_label' => 'ประเมินราคา', 'is_featured' => 1, 'sort_order' => 1, 'is_active' => 1],
            ['id' => 2, 'title' => 'Rolex Submariner', 'category' => 'watch', 'brand' => 'Rolex', 'description' => 'นาฬิกาแบรนด์เนม รับจำนำให้ราคาสูง', 'image_url' => '/assets/images/bg-watch.png', 'price_label' => 'ประเมินราคา', 'is_featured' => 1, 'sort_order' => 2, 'is_active' => 1],
            ['id' => 3, 'title' => 'Hermès Birkin', 'category' => 'bag', 'brand' => 'Hermès', 'description' => 'กระเป๋าแบรนด์เนม เก็บรักษาปลอดภัย', 'image_url' => '/assets/images/bg-bag.png', 'price_label' => 'ประเมินราคา', 'is_featured' => 1, 'sort_order' => 3, 'is_active' => 1],
            ['id' => 4, 'title' => 'Chanel Classic Flap', 'category' => 'bag', 'brand' => 'Chanel', 'description' => 'กระเป๋าแบรนด์เนม ให้วงเงินสูง', 'image_url' => '/assets/images/product-chanel.png', 'price_label' => 'ประเมินราคา', 'is_featured' => 1, 'sort_order' => 4, 'is_active' => 1],
            ['id' => 5, 'title' => 'Patek Philippe Nautilus', 'category' => 'watch', 'brand' => 'Patek Philippe', 'description' => 'นาฬิการะดับพรีเมียม รับจำนำทันที', 'image_url' => '/assets/images/product-patek.png', 'price_label' => 'ประเมินราคา', 'is_featured' => 1, 'sort_order' => 5, 'is_active' => 1],
            ['id' => 6, 'title' => 'เพชรเม็ดใหญ่ HRD', 'category' => 'diamond', 'brand' => 'HRD', 'description' => 'เพชรเม็ดใหญ่ ให้ราคาสูงสุด', 'image_url' => '/assets/images/bg-diamond.png', 'price_label' => 'ประเมินราคา', 'is_featured' => 0, 'sort_order' => 6, 'is_active' => 1],
            ['id' => 7, 'title' => 'Louis Vuitton Neverfull', 'category' => 'bag', 'brand' => 'Louis Vuitton', 'description' => 'กระเป๋า LV รับจำนำให้ราคาดี', 'image_url' => '/assets/images/product-lv.png', 'price_label' => 'ประเมินราคา', 'is_featured' => 0, 'sort_order' => 7, 'is_active' => 1],
            ['id' => 8, 'title' => 'Richard Mille RM 011', 'category' => 'watch', 'brand' => 'Richard Mille', 'description' => 'นาฬิกาแบรนด์เนมระดับโลก', 'image_url' => '/assets/images/bg-watch.png', 'price_label' => 'ประเมินราคา', 'is_featured' => 0, 'sort_order' => 8, 'is_active' => 1],
        ],
        'promotions' => [
            ['id' => 1, 'title' => 'รับจำนำเพชรใบเซอร์', 'slug' => 'diamond-cert', 'excerpt' => 'รับจำนำเพชรเม็ดใหญ่ เพชรใบเซอร์ ให้เราประเมินราคาเบื้องต้นก่อนได้ค่ะ รับเงินสดทันที ให้ราคาสูง', 'content' => '', 'image_url' => '/assets/images/bg-diamond.png', 'is_active' => 1, 'created_at' => '2026-01-15'],
            ['id' => 2, 'title' => 'รับจำนำนาฬิกาแบรนด์เนม', 'slug' => 'luxury-watches', 'excerpt' => 'รับจำนำนาฬิกาแบรนด์เนม Patek Philippe, Rolex, Richard Mille, Panerai รับเงินสดทันที ให้ราคาสูง', 'content' => '', 'image_url' => '/assets/images/bg-watch.png', 'is_active' => 1, 'created_at' => '2026-01-10'],
            ['id' => 3, 'title' => 'รับจำนำกระเป๋าแบรนด์เนม', 'slug' => 'designer-bags', 'excerpt' => 'รับจำนำกระเป๋าแบรนด์เนม Hermes, Chanel, Louis Vuitton, Gucci, Balenciaga, Dior', 'content' => '', 'image_url' => '/assets/images/bg-bag.png', 'is_active' => 1, 'created_at' => '2026-01-05'],
            ['id' => 4, 'title' => 'รับจำนำเพชรเม็ดใหญ่', 'slug' => 'large-diamonds', 'excerpt' => 'รับจำนำเพชรเม็ดใหญ่ เพชรใบเซอร์ ให้ราคาสูง จ่ายเงินสดทันใจ', 'content' => '', 'image_url' => '/assets/images/banner-store-collage.png', 'is_active' => 1, 'created_at' => '2026-01-01'],
        ],
        'next_id' => ['banners' => 6, 'products' => 9, 'promotions' => 5],
    ];
}

function initData(): void {
    if (!file_exists(DATA_FILE)) {
        saveData(getDefaultData());
    }
}

function nextId(string $type): int {
    $data = loadData();
    $id = $data['next_id'][$type] ?? 1;
    $data['next_id'][$type] = $id + 1;
    saveData($data);
    return $id;
}

initData();
