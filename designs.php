<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/themes.php';

$themes = getThemes();
$currentTheme = resolveTheme()['id'];
$lang = currentLang();

$compareRows = [
    ['key' => 'designs.row_hero', 'classic' => 'designs.classic.hero', 'blanc' => 'designs.blanc.hero', 'noir' => 'designs.noir.hero'],
    ['key' => 'designs.row_header', 'classic' => 'designs.classic.header', 'blanc' => 'designs.blanc.header', 'noir' => 'designs.noir.header'],
    ['key' => 'designs.row_products', 'classic' => 'designs.classic.products', 'blanc' => 'designs.blanc.products', 'noir' => 'designs.noir.products'],
    ['key' => 'designs.row_services', 'classic' => 'designs.classic.services', 'blanc' => 'designs.blanc.services', 'noir' => 'designs.noir.services'],
    ['key' => 'designs.row_inspire', 'classic' => 'designs.inspire.classic', 'blanc' => 'designs.inspire.blanc', 'noir' => 'designs.inspire.noir'],
    ['key' => 'designs.row_colors', 'classic' => 'designs.classic.colors', 'blanc' => 'designs.blanc.colors', 'noir' => 'designs.noir.colors'],
    ['key' => 'designs.row_font', 'classic' => 'designs.font_value', 'blanc' => 'designs.font_value', 'noir' => 'designs.font_value'],
    ['key' => 'designs.row_mood', 'classic' => 'designs.classic.mood', 'blanc' => 'designs.blanc.mood', 'noir' => 'designs.noir.mood'],
    ['key' => 'designs.row_fit', 'classic' => 'designs.classic.fit', 'blanc' => 'designs.blanc.fit', 'noir' => 'designs.noir.fit'],
];
?>
<!DOCTYPE html>
<html lang="<?= e($lang) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e(__('designs.page_title')) ?> | <?= e(siteMeta('name')) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= assetUrl('/assets/css/designs.css') ?>">
</head>
<body class="lang-<?= e($lang) ?>">
    <div class="designs-page">
        <header class="designs-header">
            <a href="<?= e(siteUrl('/')) ?>" class="designs-header__back"><?= e(__('designs.back')) ?></a>
            <div class="designs-header__brand">
                <img src="<?= e(assetUrl('/assets/images/logo.png')) ?>" alt="<?= e(siteMeta('name')) ?>" class="designs-header__logo-img" width="200" height="48">
                <span class="designs-header__sub"><?= e(__('designs.sub')) ?></span>
            </div>
            <div class="designs-header__actions">
                <?php require __DIR__ . '/includes/partials/lang-switcher.php'; ?>
                <span class="designs-header__count"><?= e(__('designs.count')) ?></span>
            </div>
        </header>

        <section class="designs-hero">
            <span class="designs-hero__eyebrow"><?= e(__('designs.hero_eyebrow')) ?></span>
            <h1 class="designs-hero__title"><?= __html('designs.hero_title') ?></h1>
            <p class="designs-hero__desc"><?= e(__('designs.hero_desc')) ?></p>
        </section>

        <div class="designs-grid">
            <?php foreach ($themes as $t): ?>
            <article class="design-card design-card--<?= e($t['id']) ?> <?= $currentTheme === $t['id'] ? 'design-card--active' : '' ?>" style="--card-bg: <?= e($t['preview_bg']) ?>; --card-accent: <?= e($t['preview_accent']) ?>; --card-text: <?= e($t['preview_text']) ?>;">
                <div class="design-card__preview">
                    <div class="design-card__mockup mockup--<?= e($t['id']) ?>">
                        <div class="mockup-header">
                            <span></span><span></span><span></span>
                        </div>
                        <div class="mockup-hero">
                            <div class="mockup-hero__line"></div>
                            <div class="mockup-hero__title"><?= e(siteMeta('name')) ?></div>
                            <div class="mockup-hero__sub">SIAM JUMNUM</div>
                        </div>
                        <div class="mockup-strip">
                            <span></span><span></span><span></span>
                        </div>
                        <div class="mockup-content">
                            <div class="mockup-block mockup-block--wide"></div>
                            <div class="mockup-block mockup-block--split">
                                <span></span><span></span>
                            </div>
                        </div>
                    </div>
                    <?php if ($currentTheme === $t['id']): ?>
                    <span class="design-card__badge"><?= e(__('designs.badge')) ?></span>
                    <?php endif; ?>
                </div>
                <div class="design-card__body">
                    <span class="design-card__number"><?= str_pad(array_search($t['id'], array_keys($themes)) + 1, 2, '0', STR_PAD_LEFT) ?></span>
                    <h2 class="design-card__name"><?= e($t['name']) ?></h2>
                    <p class="design-card__name-th"><?= e($t['name_th']) ?></p>
                    <p class="design-card__tagline"><?= e($t['tagline_th']) ?></p>
                    <div class="design-card__palette">
                        <span style="background: <?= e($t['preview_bg']) ?>"></span>
                        <span style="background: <?= e($t['preview_accent']) ?>"></span>
                        <span style="background: <?= e($t['preview_text']) ?>"></span>
                    </div>
                    <div class="design-card__actions">
                        <a href="<?= e(siteUrl('/', ['theme' => $t['id']])) ?>" class="design-card__btn design-card__btn--primary"><?= e(__('designs.preview')) ?></a>
                        <a href="<?= e(siteUrl('/', ['theme' => $t['id']])) ?>" class="design-card__btn design-card__btn--ghost"><?= e(__('designs.select')) ?></a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <section class="designs-compare">
            <h2 class="designs-compare__title"><?= e(__('designs.compare_title')) ?></h2>
            <div class="designs-compare__table-wrap">
                <table class="designs-compare__table">
                    <thead>
                        <tr>
                            <th><?= e(__('designs.col_feature')) ?></th>
                            <?php foreach ($themes as $t): ?>
                            <th><?= e($t['name']) ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($compareRows as $row): ?>
                        <tr>
                            <td><?= e(__($row['key'])) ?></td>
                            <?php foreach (['classic', 'blanc', 'noir'] as $themeId): ?>
                            <td><?= e(__($row[$themeId])) ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <footer class="designs-footer">
            <p><?= e(__('designs.footer_text')) ?></p>
            <a href="<?= e(siteUrl('/')) ?>" class="designs-footer__link"><?= e(__p('designs.footer_link', ['theme' => getTheme($currentTheme)['name']])) ?></a>
        </footer>
    </div>
</body>
</html>
