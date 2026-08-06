    <header class="header header--blanc" id="header">

        <div class="header__bar header__bar--blanc">

            <?php $logoModifier = 'logo--left'; require __DIR__ . '/../partials/logo.php'; ?>

            <nav class="nav nav--blanc" id="navRight">

                <a href="#home" class="nav__link"><?= e(__('nav.home')) ?></a>

                <a href="#services" class="nav__link"><?= e(__('nav.services')) ?></a>

                <a href="#products" class="nav__link"><?= e(__('nav.products')) ?></a>

                <a href="#about" class="nav__link"><?= e(__('nav.about')) ?></a>

                <a href="#valuation" class="nav__link nav__link--cta"><?= e(__('nav.valuation')) ?></a>

                <?php require __DIR__ . '/../partials/lang-switcher.php'; ?>

            </nav>

            <button class="nav-toggle" id="navToggle" aria-label="<?= e(__('aria.menu')) ?>"><span></span><span></span></button>

        </div>

    </header>


