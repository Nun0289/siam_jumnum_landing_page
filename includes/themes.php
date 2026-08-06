<?php

define('PROMPT_FONTS', 'https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap');

function getThemes(): array
{
    return [
        'classic' => [
            'id' => 'classic',
            'name' => 'Maison Classic',
            'name_th' => 'มาสัน คลาสสิก',
            'tagline' => 'Chaumet-inspired editorial luxury',
            'tagline_th' => 'Full-screen Hero · Logo กลาง · สไตล์ Chaumet Editorial',
            'layout' => 'Editorial fullscreen carousel, dark collections strip, split intro',
            'css' => '/assets/css/theme-classic.css',
            'fonts' => PROMPT_FONTS,
            'preview_bg' => '#080808',
            'preview_accent' => '#c4a265',
            'preview_text' => '#ffffff',
        ],
        'blanc' => [
            'id' => 'blanc',
            'name' => 'Blanc Élégance',
            'name_th' => 'บลอง เอเลกانس',
            'tagline' => 'Light luxury — airy & refined',
            'tagline_th' => 'Split Hero ครึ่งจอ · Logo ซ้าย · Card Grid สว่าง',
            'layout' => 'Split hero, left logo bar, image cards, 3-col services grid',
            'css' => '/assets/css/theme-blanc.css',
            'fonts' => PROMPT_FONTS,
            'preview_bg' => '#faf8f5',
            'preview_accent' => '#b8927a',
            'preview_text' => '#2c2825',
        ],
        'noir' => [
            'id' => 'noir',
            'name' => 'Noir Royal',
            'name_th' => 'นัวร์ รояล',
            'tagline' => 'Art Deco drama — bold gold & noir',
            'tagline_th' => 'Hero กลางจอ · Art Deco · ทอง-ดำ-แดง โดดเด่น',
            'layout' => 'Centered framed hero, art deco header, stacked services, carousel only',
            'css' => '/assets/css/theme-noir.css',
            'fonts' => PROMPT_FONTS,
            'preview_bg' => '#0a0808',
            'preview_accent' => '#d4af37',
            'preview_text' => '#f5f0e8',
        ],
    ];
}

function getTheme(string $id): array
{
    $themes = getThemes();
    return $themes[$id] ?? $themes['classic'];
}

function resolveTheme(?string $id = null): array
{
    $allowed = array_keys(getThemes());
    $id = $id ?? ($_GET['theme'] ?? 'classic');
    if (!in_array($id, $allowed, true)) {
        $id = 'classic';
    }
    return getTheme($id);
}
