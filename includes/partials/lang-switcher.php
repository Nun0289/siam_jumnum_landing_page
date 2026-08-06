<div class="lang-switcher" role="navigation" aria-label="<?= e(__('aria.lang')) ?>">
    <?php foreach (getLanguages() as $code => $info): ?>
    <a href="<?= e(langUrl($code)) ?>" class="lang-switcher__btn <?= currentLang() === $code ? 'active' : '' ?>" hreflang="<?= e($code) ?>"><?= e($info['label']) ?></a>
    <?php endforeach; ?>
</div>
