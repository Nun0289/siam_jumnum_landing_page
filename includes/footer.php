    </main>



    <?php require __DIR__ . '/partials/float-widgets.php'; ?>



    <footer class="footer" id="contact">

        <div class="container">

            <div class="footer__grid">

                <div class="footer__brand">

                    <?php $logoModifier = 'logo--footer'; $asLink = false; require __DIR__ . '/partials/logo.php'; ?>

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

                        <a href="https://line.me/R/ti/p/@<?= e(ltrim(LINE_ID, '@')) ?>" target="_blank" rel="noopener" aria-label="Line">Line</a>

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


