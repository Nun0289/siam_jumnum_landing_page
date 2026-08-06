<?php
$brandItems = array_merge(getBrandMarqueeItems(), getBrandMarqueeItems());
?>
<section class="brands" aria-label="<?= e(__('brands.aria')) ?>">
    <div class="brands__track">
        <?php foreach ($brandItems as $brand): ?>
        <div class="brand-item">
            <img
                src="<?= e(assetUrl($brand['logo'])) ?>"
                alt="<?= e($brand['name']) ?>"
                class="brand-item__logo"
                width="120"
                height="36"
                loading="lazy"
                decoding="async"
            >
        </div>
        <?php endforeach; ?>
    </div>
</section>
