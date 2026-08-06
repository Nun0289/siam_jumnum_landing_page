<?php
define('SITE_NAME', 'สยามจำนำ');
define('SITE_TAGLINE', 'ศูนย์รับจำนำเพชรเม็ดใหญ่ และสินค้าแบรนด์เนม ครบวงจร');
define('BASE_PATH', dirname(__DIR__));

if (!empty($_SERVER['HTTP_HOST'])) {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    define('SITE_URL', $scheme . '://' . $_SERVER['HTTP_HOST']);
} else {
    define('SITE_URL', 'https://siamjumnum.charoencodegroup.com');
}

define('DB_PATH', BASE_PATH . '/database/siam_jumnum.db');
define('UPLOAD_PATH', BASE_PATH . '/uploads');
define('UPLOAD_URL', '/uploads');

define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'admin123');

define('PHONE', '085 200 1010');
define('EMAIL', 'info@siamjumnum.com');
define('HOURS', 'Mon - Sun 10:00 - 18:00');
define('HOURS_TH', 'วันอาทิตย์ - วันศุกร์ 10:00 - 18:00 น.');

date_default_timezone_set('Asia/Bangkok');

session_start();

$localConfig = __DIR__ . '/config.local.php';
if (is_file($localConfig)) {
    require_once $localConfig;
}

require_once BASE_PATH . '/includes/i18n.php';
initI18n();
