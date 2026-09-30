<?php

declare(strict_types=1);

session_start();
require __DIR__ . '/config/db.php';
require __DIR__ . '/includes/functions.php';

$settings = [];
foreach ($pdo->query('SELECT setting_key, setting_value FROM portfolio_settings') as $row) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

$services = $pdo->query('SELECT * FROM services WHERE is_active = 1 ORDER BY sort_order, id')->fetchAll();
$testimonials = $pdo->query('SELECT * FROM testimonials WHERE is_active = 1 ORDER BY sort_order, id')->fetchAll();
$projects = $pdo->query('SELECT * FROM projects WHERE is_active = 1 ORDER BY sort_order, id')->fetchAll();
$flash = get_flash();

function setting(array $settings, string $key, string $fallback = ''): string
{
    return e($settings[$key] ?? $fallback);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dynamic portfolio website for <?= setting($settings, 'hero_name') ?>.">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <title><?= setting($settings, 'page_title', 'Portfolio') ?></title>
</head>
<body>
<header class="header">
    <a class="logo" href="#home"><?= setting($settings, 'site_name', 'EMMANUEL') ?></a>
    <button class="menu-toggle" id="menu-icon" aria-label="Toggle navigation"><i class="bx bx-menu"></i></button>
    <nav class="navbar" id="navbar">
        <a href="#home">Home</a><a href="#about">About</a><a href="#services">Services</a>
        <a href="#testimonials">Testimonials</a><a href="#projects">Projects</a><a href="#contact">Contact</a>
    </nav>
</header>

<?php if ($flash): ?><div class="flash <?= e($flash['type']) ?>"><?= e($flash['message']) ?></div><?php endif; ?>

<section class="home" id="home">
    <div class="home-img"><img src="assets/images/<?= setting($settings, 'profile_image') ?>" alt="Profile image"></div>
    <div class="home-content">
        <h3>Hello, I'm</h3><h1><?= setting($settings, 'hero_name') ?></h1>
        <h3>And I'm a <span class="multiple-text"><?= setting($settings, 'hero_role') ?></span></h3>
        <p><?= setting($settings, 'hero_intro') ?></p>
        <div class="social-media">
            <a href="<?= setting($settings, 'linkedin_url', '#') ?>" aria-label="LinkedIn"><i class="bx bxl-linkedin"></i></a>
            <a href="<?= setting($settings, 'github_url', '#') ?>" aria-label="GitHub"><i class="bx bxl-github"></i></a>
            <a href="<?= setting($settings, 'facebook_url', '#') ?>" aria-label="Facebook"><i class="bx bxl-facebook"></i></a>
            <a href="<?= setting($settings, 'instagram_url', '#') ?>" aria-label="Instagram"><i class="bx bxl-instagram"></i></a>
        </div>
        <a class="btn" href="<?= setting($settings, 'cv_url', '#') ?>">Download CV</a>
    </div>
</section>

<section class="about" id="about">
    <div class="about-content"><h2 class="heading">About <span>Me</span></h2>
        <h3>I'm a <span><?= setting($settings, 'about_role') ?></span></h3>
        <p><?= setting($settings, 'about_short') ?></p><a class="btn" href="<?= setting($settings, 'about_read_more', '#') ?>">Read more</a>
    </div>
    <div class="about-img"><img src="assets/images/<?= setting($settings, 'profile_image') ?>" alt="About profile image"></div>
</section>

<section class="services" id="services"><h2 class="heading">My <span>Services</span></h2><div class="services-container">
<?php foreach ($services as $service): ?>
    <article class="services-box"><i class="bx <?= e($service['icon_class']) ?>"></i><h3><?= e($service['title']) ?></h3><p><?= e($service['short_description']) ?></p><a class="btn" href="service.php?id=<?= (int)$service['id'] ?>">Read More</a></article>
<?php endforeach; ?>
</div></section>

<section class="testimonials" id="testimonials"><div class="testimonials-box"><h2 class="heading">Testimonials</h2><div class="wrapper">
<?php foreach ($testimonials as $testimonial): ?>
    <article class="testimonial-item"><img src="assets/images/<?= e($testimonial['image']) ?>" alt="<?= e($testimonial['client_name']) ?>"><h2><?= e($testimonial['client_name']) ?><?= $testimonial['client_role'] ? ', ' . e($testimonial['client_role']) : '' ?></h2><p><?= e($testimonial['content']) ?></p><div class="rating"><?php for ($i = 1; $i <= (int)$testimonial['rating']; $i++): ?><i class="bx bxs-star"></i><?php endfor; ?></div></article>
<?php endforeach; ?>
</div></div></section>

<section class="projects" id="projects"><h2 class="heading">My <span>Projects</span></h2><div class="projects-container">
<?php foreach ($projects as $project): $technologies = json_list($project['technologies']); $features = json_list($project['features']); ?>
    <article class="project-box"><div class="project-image"><img src="assets/images/<?= e($project['image']) ?>" alt="<?= e($project['title']) ?>"></div><div class="project-content"><h3><?= e($project['title']) ?></h3><p><?= e($project['description']) ?></p><div class="project-meta"><div><h4>Technologies Used</h4><ul><?php foreach ($technologies as $technology): ?><li><?= e((string)$technology) ?></li><?php endforeach; ?></ul></div><div><h4>Features</h4><ul><?php foreach ($features as $feature): ?><li><?= e((string)$feature) ?></li><?php endforeach; ?></ul></div></div><a href="<?= e($project['project_url'] ?: '#') ?>" </a></div></article>
<?php endforeach; ?>
</div></section>

<section class="contact" id="contact"><h2 class="heading">Contact <span>Me</span></h2>
<form action="contact.php" method="post"><div class="input-box"><input name="name" placeholder="Full Name" type="text" required><input name="email" placeholder="Email Address" type="email" required></div><div class="input-box"><input name="phone" placeholder="Phone Number" type="tel"><input name="subject" placeholder="Email Subject" type="text" required></div><textarea name="message" placeholder="Your Message" rows="10" required></textarea><button class="btn" type="submit">Send Message</button></form>
</section>

<footer class="footer"><div class="social"><a href="<?= setting($settings, 'linkedin_url', '#') ?>"><i class="bx bxl-linkedin"></i></a><a href="<?= setting($settings, 'github_url', '#') ?>"><i class="bx bxl-github"></i></a><a href="<?= setting($settings, 'facebook_url', '#') ?>"><i class="bx bxl-facebook"></i></a><a href="<?= setting($settings, 'instagram_url', '#') ?>"><i class="bx bxl-instagram"></i></a></div><p class="copyright">&copy; <?= date('Y') ?> <?= setting($settings, 'hero_name') ?> | All Rights Reserved</p></footer>
<script src="assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script src="assets/js/script2.js?v=2"></script>

</body>
</html>
