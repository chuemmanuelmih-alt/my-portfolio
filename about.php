<?php

declare(strict_types=1);

require __DIR__ . '/config/db.php';
require __DIR__ . '/includes/functions.php';

$settings = [];
foreach ($pdo->query('SELECT setting_key, setting_value FROM portfolio_settings') as $row) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/about.css">
    <title>About <?= e($settings['hero_name'] ?? 'Me') ?></title>
</head>
<body class="about-detail">
    <main class="about-page">
        <a class="about-back" href="index.php#about"><span aria-hidden="true">&larr;</span> Back to portfolio</a>

        <section class="about-hero" aria-labelledby="about-name">
            <div class="about-copy">
                <p class="about-eyebrow">A LITTLE ABOUT ME <span> / 01</span></p>
                <h1 id="about-name"><?= e($settings['hero_name'] ?? 'Me') ?><span class="about-period">.</span></h1>
                <p class="about-role"><?= e($settings['about_role'] ?? $settings['hero_role'] ?? 'Creative developer') ?></p>
                <div class="about-divider" aria-hidden="true"></div>
                <p class="about-lead"><?= e($settings['about_short'] ?? '') ?></p>
                <p class="about-bio"><?= e($settings['about_long'] ?? 'I am available for professional web development, UI/UX design, database administration, and custom software projects.') ?></p>
                <div class="about-actions">
                    <a class="about-cta" href="contact.php">Let’s work together <span aria-hidden="true">&nearr;</span></a>
                    <a class="about-home-link" href="index.php">Home</a>
                </div>
            </div>

            <div class="about-visual">
                <div class="about-photo-frame">
                    <img src="assets/images/<?= e($settings['profile_image'] ?? '') ?>" alt="Portrait of <?= e($settings['hero_name'] ?? 'me') ?>">
                    <span class="about-photo-caption">DESIGNING WITH PURPOSE</span>
                </div>
                <p class="about-image-index"><span>01</span> / ABOUT</p>
            </div>
        </section>

        <footer class="about-footer">
            <span>Curious by nature. Building for people.</span>
            <a href="index.php#contact">Start a conversation <span aria-hidden="true">&nearr;</span></a>
        </footer>
    </main>
</body>
</html>
