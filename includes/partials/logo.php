<?php
$logoModifier = $logoModifier ?? '';
$asLink = $asLink ?? true;
$logoVariant = $logoVariant ?? 'auto';
$logoAlt = siteMeta('name') . ' — SIAM JUMNUM';
$logoDarkSrc = assetUrl('/assets/images/logo.png');
$logoLightSrc = assetUrl('/assets/images/logo-light.png');

$showDark = $logoVariant === 'dark' || $logoVariant === 'auto';
$showLight = $logoVariant === 'light' || $logoVariant === 'auto';
?>
<?php if ($asLink): ?>
<a href="/" class="logo <?= e(trim($logoModifier)) ?>">
<?php else: ?>
<div class="logo <?= e(trim($logoModifier)) ?>">
<?php endif; ?>
    <?php if ($showDark): ?>
    <img src="<?= e($logoDarkSrc) ?>" alt="<?= e($logoAlt) ?>" class="logo__img logo__img--dark" width="220" height="52" loading="eager">
    <?php endif; ?>
    <?php if ($showLight): ?>
    <img src="<?= e($logoLightSrc) ?>" alt="<?= e($logoAlt) ?>" class="logo__img logo__img--light" width="220" height="52" loading="eager">
    <?php endif; ?>
<?php if ($asLink): ?>
</a>
<?php else: ?>
</div>
<?php endif; ?>
