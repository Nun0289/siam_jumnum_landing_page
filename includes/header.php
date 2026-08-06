<?php

require_once __DIR__ . '/../config/config.php';

require_once __DIR__ . '/functions.php';

require_once __DIR__ . '/themes.php';

$currentPage = $currentPage ?? 'home';

$theme = $theme ?? resolveTheme();

$lang = currentLang();

?>

<!DOCTYPE html>

<html lang="<?= e($lang) ?>">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= e($pageTitle ?? siteMeta('name')) ?> | <?= e(siteMeta('tagline')) ?></title>

    <meta name="description" content="<?= e(siteMeta('meta_desc')) ?>">

    <link rel="icon" href="<?= assetUrl('/assets/images/logo.png') ?>" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="<?= e($theme['fonts']) ?>" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <link rel="stylesheet" href="<?= assetUrl('/assets/css/style.css') ?>">

    <link rel="stylesheet" href="<?= assetUrl('/assets/css/luxury-bg.css') ?>">

    <link rel="stylesheet" href="<?= assetUrl($theme['css']) ?>">

</head>

<body class="theme-<?= e($theme['id']) ?> lang-<?= e($lang) ?>">

    <div class="luxury-bg" aria-hidden="true">

        <div class="luxury-bg__mesh"></div>

        <div class="luxury-bg__orb luxury-bg__orb--1"></div>

        <div class="luxury-bg__orb luxury-bg__orb--2"></div>

        <div class="luxury-bg__orb luxury-bg__orb--3"></div>

    </div>

    <div class="grain" aria-hidden="true"></div>

    <?php if (isset($_GET['theme'])): ?>

    <nav class="theme-switcher" aria-label="Design switcher">

        <?php foreach (getThemes() as $t): ?>

        <?php

            $params = $_GET;

            $params['theme'] = $t['id'];

            if ($lang !== 'th') {

                $params['lang'] = $lang;

            } else {

                unset($params['lang']);

            }

            $themeHref = '/?' . http_build_query($params);

        ?>

        <a href="<?= e($themeHref) ?>" class="theme-switcher__btn <?= $theme['id'] === $t['id'] ? 'active' : '' ?>"><?= e($t['name']) ?></a>

        <?php endforeach; ?>

        <a href="/designs.php?lang=<?= e($lang) ?>" class="theme-switcher__all">Designs</a>

    </nav>

    <?php endif; ?>

    <div class="preloader" id="preloader">

        <div class="preloader__inner">

            <div class="preloader__logo">
                <?php $logoModifier = 'logo--preloader'; $asLink = false; require __DIR__ . '/partials/logo.php'; ?>
            </div>

            <div class="preloader__sub">SIAM JUMNUM</div>

            <div class="preloader__line"></div>

        </div>

    </div>



    <?php require __DIR__ . '/headers/' . $theme['id'] . '.php'; ?>



    <div class="mobile-nav" id="mobileNav">

        <div class="mobile-nav__inner">

            <?php require __DIR__ . '/partials/lang-switcher.php'; ?>

            <a href="#home" class="mobile-nav__link"><?= e(__('nav.home')) ?></a>

            <a href="#services" class="mobile-nav__link"><?= e(__('nav.services')) ?></a>

            <a href="#products" class="mobile-nav__link"><?= e(__('nav.products')) ?></a>

            <a href="#about" class="mobile-nav__link"><?= e(__('nav.about')) ?></a>

            <a href="#how-it-works" class="mobile-nav__link"><?= e(__('nav.how')) ?></a>

            <a href="#valuation" class="mobile-nav__link"><?= e(__('nav.valuation')) ?></a>

            <a href="#promotions" class="mobile-nav__link"><?= e(__('nav.promotions')) ?></a>

            <a href="#contact" class="mobile-nav__link"><?= e(__('nav.contact')) ?></a>

            <div class="mobile-nav__contact">

                <a href="tel:0852001010"><?= PHONE ?></a>

                <a href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a>

            </div>

        </div>

    </div>



    <main>


