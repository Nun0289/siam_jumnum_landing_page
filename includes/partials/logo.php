<?php
$logoModifier = $logoModifier ?? '';
$asLink = $asLink ?? true;
$logoAlt = siteMeta('name') . ' — SIAM JUMNUM';
$logoSrc = assetUrl('/assets/images/logo.png');
?>
<?php if ($asLink): ?>
<a href="/" class="logo <?= e(trim($logoModifier)) ?>">
<?php else: ?>
<div class="logo <?= e(trim($logoModifier)) ?>">
<?php endif; ?>
    <img src="<?= e($logoSrc) ?>" alt="<?= e($logoAlt) ?>" class="logo__img" width="360" height="70" loading="eager">
<?php if ($asLink): ?>
</a>
<?php else: ?>
</div>
<?php endif; ?>
