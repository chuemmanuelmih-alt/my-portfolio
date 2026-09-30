<?php
$page_title = $page_title ?? 'Dashboard';
$current_page = basename($_SERVER['PHP_SELF']);
$flash = take_flash();
$user = admin_user();
?><!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?= e($page_title) ?> | Emmanuel Admin</title><link rel="stylesheet" href="assets/admin.css"><link rel="stylesheet" href="assets/portfolio-theme.css"><link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"></head><body>
<div class="admin-shell"><aside class="sidebar" id="sidebar"><div class="brand"><span>Emmanuel</span>.admin</div><nav>
<a class="<?= $current_page === 'index.php' ? 'active' : '' ?>" href="index.php"><i class="bx bxs-dashboard"></i>Dashboard</a>
<a class="<?= in_array($current_page, ['testimonials.php','testimonial_form.php'], true) ? 'active' : '' ?>" href="testimonials.php"><i class="bx bx-message-square-detail"></i>Testimonials</a>
<a class="<?= in_array($current_page, ['messages.php','message.php'], true) ? 'active' : '' ?>" href="messages.php"><i class="bx bx-envelope"></i>Messages</a>
<a class="<?= in_array($current_page, ['services.php','service_form.php'], true) ? 'active' : '' ?>" href="services.php"><i class="bx bx-briefcase"></i>Services</a>
<a class="<?= in_array($current_page, ['projects.php','project_form.php'], true) ? 'active' : '' ?>" href="projects.php"><i class="bx bx-code-alt"></i>Projects</a>
<a href="../index.php" target="_blank"><i class="bx bx-globe"></i>View Website</a>
</nav><a class="logout" href="logout.php"><i class="bx bx-log-out"></i>Logout</a></aside><main class="main-content"><header class="topbar"><button class="mobile-toggle" id="mobile-toggle"><i class="bx bx-menu"></i></button><h1><?= e($page_title) ?></h1><div class="admin-user"><i class="bx bx-user-circle"></i><?= e($user['name']) ?></div></header><?php if ($flash): ?><div class="flash <?= e($flash['type']) ?>"><?= e($flash['message']) ?></div><?php endif; ?><div class="page-content">
