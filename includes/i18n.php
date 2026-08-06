<?php

function getLanguages(): array
{
    return [
        'th' => ['label' => 'TH', 'name' => 'ไทย', 'locale' => 'th_TH'],
        'en' => ['label' => 'EN', 'name' => 'English', 'locale' => 'en_US'],
        'zh' => ['label' => '中文', 'name' => '中文', 'locale' => 'zh_CN'],
    ];
}

function resolveLang(?string $code = null): string
{
    $allowed = array_keys(getLanguages());

    if ($code !== null && in_array($code, $allowed, true)) {
        $_SESSION['lang'] = $code;
    } elseif (isset($_GET['lang']) && in_array($_GET['lang'], $allowed, true)) {
        $_SESSION['lang'] = $_GET['lang'];
    }

    $lang = $_SESSION['lang'] ?? 'th';
    if (!in_array($lang, $allowed, true)) {
        $lang = 'th';
    }

    return $lang;
}

function currentLang(): string
{
    return $GLOBALS['current_lang'] ?? resolveLang();
}

function loadTranslations(string $lang): array
{
    $path = BASE_PATH . '/lang/' . $lang . '.php';
    if (!file_exists($path)) {
        $path = BASE_PATH . '/lang/th.php';
    }
    return require $path;
}

function initI18n(): void
{
    $lang = resolveLang($_GET['lang'] ?? null);
    $GLOBALS['current_lang'] = $lang;
    $GLOBALS['translations'] = loadTranslations($lang);
}

function __(string $key): string
{
    return $GLOBALS['translations'][$key] ?? $key;
}

function __html(string $key): string
{
    $text = __($key);
    $text = preg_replace('/<br\s*\/?>/i', '[[BR]]', $text);
    $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    return str_replace('[[BR]]', '<br>', $text);
}

function __p(string $key, array $vars = []): string
{
    $text = __($key);
    foreach ($vars as $name => $value) {
        $text = str_replace('{' . $name . '}', $value, $text);
    }
    return $text;
}

function langUrl(string $lang): string
{
    $params = $_GET;
    $params['lang'] = $lang;
    if (!isset($params['theme']) && !empty($_SESSION['theme'])) {
        $params['theme'] = $_SESSION['theme'];
    }
    $query = http_build_query($params);
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    return $path . ($query ? '?' . $query : '');
}

function siteUrl(string $path = '/', array $params = []): string
{
    $params = array_merge($_GET, $params);
    if (!isset($params['theme']) && !empty($_SESSION['theme'])) {
        $params['theme'] = $_SESSION['theme'];
    }
    $lang = currentLang();
    if ($lang !== 'th') {
        $params['lang'] = $lang;
    } else {
        unset($params['lang']);
    }
    foreach ($params as $key => $value) {
        if ($value === '' || $value === null) {
            unset($params[$key]);
        }
    }
    $query = http_build_query($params);
    return $path . ($query ? '?' . $query : '');
}

function htmlLang(): string
{
    return currentLang();
}

function siteMeta(string $key): string
{
    return __( 'site.' . $key);
}
