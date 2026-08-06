    <header class="header header--noir" id="header">

        <div class="header__bar header__bar--noir">

            <nav class="nav nav--noir-left" id="navLeft">

                <a href="#home" class="nav__link"><?= e(__('nav.home')) ?></a>

                <a href="#services" class="nav__link"><?= e(__('nav.services')) ?></a>

            </nav>

            <?php $logoModifier = 'logo--noir'; $logoVariant = 'dark'; require __DIR__ . '/../partials/logo.php'; ?>

            <nav class="nav nav--noir-right" id="navRight">

                <a href="#products" class="nav__link"><?= e(__('nav.products')) ?></a>

                <a href="#contact" class="nav__link"><?= e(__('nav.contact')) ?></a>

                <?php require __DIR__ . '/../partials/lang-switcher.php'; ?>

            </nav>

            <button class="nav-toggle" id="navToggle" aria-label="<?= e(__('aria.menu')) ?>"><span></span><span></span></button>

        </div>

    </header>


