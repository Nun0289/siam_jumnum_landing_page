<?php

/**
 * One-shot extract script for cPanel FTP deploy.
 * Uploaded by CI / deploy script, invoked once, then self-deletes.
 */

declare(strict_types=1);

$expected = '__DEPLOY_TOKEN_PLACEHOLDER__';

$token = $_SERVER['HTTP_X_DEPLOY_TOKEN']
    ?? ($_POST['token'] ?? null)
    ?? ($_GET['token'] ?? '');
$token = is_string($token) ? $token : '';

header('Content-Type: text/plain; charset=utf-8');

if ($expected === '' || $token === '' || !hash_equals($expected, $token)) {
    http_response_code(403);
    echo "Forbidden\n";
    exit;
}

$web = __DIR__;
$zipPath = $web . '/release.zip';

if (!is_file($zipPath)) {
    http_response_code(404);
    echo "release.zip not found at {$zipPath}\n";
    exit;
}

if (!class_exists(ZipArchive::class)) {
    http_response_code(500);
    echo "ZipArchive extension missing\n";
    exit;
}

$zip = new ZipArchive();
if ($zip->open($zipPath) !== true) {
    http_response_code(500);
    echo "Failed to open release.zip\n";
    exit;
}

if (!$zip->extractTo($web)) {
    $zip->close();
    http_response_code(500);
    echo "Failed to extract release.zip\n";
    exit;
}
$zip->close();
@unlink($zipPath);

foreach (['database', 'uploads'] as $dir) {
    $path = $web . '/' . $dir;
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }
    @chmod($path, 0755);
}

$localConfig = $web . '/config/config.local.php';
if (!is_file($localConfig)) {
    @copy($web . '/config/config.local.example.php', $localConfig);
}

$htaccess = $web . '/deployment/cpanel/.htaccess';
if (is_file($htaccess)) {
    copy($htaccess, $web . '/.htaccess');
}

echo "OK extract complete\n";
echo "Web: {$web}\n";

@unlink(__FILE__);
