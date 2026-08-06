    </main>



    <a href="tel:0852001010" class="float-contact" aria-label="<?= e(__('aria.call')) ?>">

        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>

        <span><?= PHONE ?></span>

    </a>



    <footer class="footer" id="contact">

        <div class="container">

            <div class="footer__grid">

                <div class="footer__brand">

                    <?php $logoModifier = 'logo--footer'; $asLink = false; $logoVariant = 'dark'; require __DIR__ . '/partials/logo.php'; ?>

                    <p class="footer__desc"><?= e(siteMeta('desc')) ?></p>

                </div>

                <div class="footer__links">

                    <h4><?= e(__('footer.services')) ?></h4>

                    <ul>

                        <li><a href="#services"><?= e(__('footer.s1')) ?></a></li>

                        <li><a href="#services"><?= e(__('footer.s2')) ?></a></li>

                        <li><a href="#services"><?= e(__('footer.s3')) ?></a></li>

                        <li><a href="#products"><?= e(__('footer.s4')) ?></a></li>

                    </ul>

                </div>

                <div class="footer__links">

                    <h4><?= e(__('footer.menu')) ?></h4>

                    <ul>

                        <li><a href="#how-it-works"><?= e(__('footer.m1')) ?></a></li>

                        <li><a href="#valuation"><?= e(__('footer.m2')) ?></a></li>

                        <li><a href="#about"><?= e(__('footer.m3')) ?></a></li>

                        <li><a href="#promotions"><?= e(__('footer.m4')) ?></a></li>

                    </ul>

                </div>

                <div class="footer__contact">

                    <h4><?= e(__('footer.contact')) ?></h4>

                    <p><a href="tel:0852001010"><?= PHONE ?></a></p>

                    <p><a href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a></p>

                    <p><?= e(siteMeta('hours')) ?></p>

                    <div class="footer__social">

                        <a href="https://www.facebook.com/" target="_blank" rel="noopener" aria-label="Facebook">Facebook</a>

                        <a href="https://line.me/" target="_blank" rel="noopener" aria-label="Line">Line</a>

                    </div>

                </div>

            </div>

            <div class="footer__bottom">

                <p>&copy; <?= date('Y') ?> siamjumnum.com <?= e(__('footer.rights')) ?></p>

            </div>

        </div>

    </footer>



    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script src="<?= assetUrl('/assets/js/main.js') ?>"></script>

</body>

</html>


