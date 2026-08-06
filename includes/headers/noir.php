    <header class="header header--noir" id="header">

        <div class="header__bar header__bar--noir">

            <?php $logoModifier = 'logo--noir logo--left'; require __DIR__ . '/../partials/logo.php'; ?>

            <nav class="nav nav--noir" id="navNoir">

                <a href="#home" class="nav__link"><?= e(__('nav.home')) ?></a>

                <a href="#services" class="nav__link"><?= e(__('nav.services')) ?></a>

                <a href="#products" class="nav__link"><?= e(__('nav.products')) ?></a>

                <a href="#contact" class="nav__link"><?= e(__('nav.contact')) ?></a>

            </nav>

            <div class="header__actions">

                <?php require __DIR__ . '/../partials/lang-switcher.php'; ?>

            </div>

            <button class="nav-toggle" id="navToggle" aria-label="<?= e(__('aria.menu')) ?>"><span></span><span></span></button>

        </div>

    </header>

