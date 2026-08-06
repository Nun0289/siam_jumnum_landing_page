    <header class="header header--hero header--classic" id="header">

        <div class="header__bar">

            <nav class="nav nav--left" id="navLeft">

                <a href="#home" class="nav__link"><?= e(__('nav.home')) ?></a>

                <a href="#services" class="nav__link"><?= e(__('nav.services')) ?></a>

                <a href="#products" class="nav__link"><?= e(__('nav.products')) ?></a>

            </nav>

            <?php require __DIR__ . '/../partials/logo.php'; ?>

            <nav class="nav nav--right" id="navRight">

                <a href="#about" class="nav__link"><?= e(__('nav.about')) ?></a>

                <a href="#promotions" class="nav__link"><?= e(__('nav.promotions')) ?></a>

                <a href="#contact" class="nav__link"><?= e(__('nav.contact')) ?></a>

                <?php require __DIR__ . '/../partials/lang-switcher.php'; ?>

            </nav>

            <button class="nav-toggle" id="navToggle" aria-label="<?= e(__('aria.menu')) ?>"><span></span><span></span></button>

        </div>

    </header>


