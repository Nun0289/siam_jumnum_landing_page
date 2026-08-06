<?php
$lineHandle = ltrim(LINE_ID, '@');
$lineUrl = 'https://line.me/R/ti/p/@' . $lineHandle;
?>
<div class="float-widgets" aria-label="<?= e(__('float.aria')) ?>">
    <a href="tel:0852001010" class="float-bubble float-bubble--phone" aria-label="<?= e(__('aria.call')) ?>">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
        <span class="float-bubble__phone-text"><?= PHONE ?></span>
    </a>

    <a href="<?= e($lineUrl) ?>" class="float-bubble float-bubble--line" target="_blank" rel="noopener" aria-label="<?= e(__('aria.line')) ?>">
        <span class="float-bubble__icon" aria-hidden="true">
            <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="36" height="36" rx="8" fill="#fff"/>
                <path d="M18 7C11.373 7 6 11.477 6 17.02c0 4.456 3.946 8.19 9.28 8.92.362.078.854.238.978.547.112.28.073.72.036 1.005l-.158 1.002c-.05.315-.248 1.23 1.078.67 1.326-.56 7.15-4.21 9.75-7.2C27.5 19.5 30 18.4 30 17.02 30 11.477 24.627 7 18 7z" fill="#06C755"/>
                <path d="M13.2 15.8h1.6v4.4h-1.6v-4.4zm3.2 0h1.6v4.4h-1.6v-4.4zm3.2 0h1.6c.88 0 1.6.72 1.6 1.6v1.2c0 .88-.72 1.6-1.6 1.6h-1.6v-4.4z" fill="#fff"/>
            </svg>
        </span>
        <span class="float-bubble__text">
            <span class="float-bubble__label"><?= e(__('float.line')) ?></span>
            <span class="float-bubble__id"><?= e(LINE_ID) ?></span>
        </span>
    </a>
</div>
