<?php

declare(strict_types=1);

require __DIR__ . '/config/db.php';
require __DIR__ . '/includes/functions.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    http_response_code(404);
    exit('Service not found.');
}

$stmt = $pdo->prepare('SELECT * FROM services WHERE id = ? AND is_active = 1');
$stmt->execute([$id]);
$service = $stmt->fetch();
if (!$service) {
    http_response_code(404);
    exit('Service not found.');
}
$items = json_list($service['detail_items']);
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="assets/css/style.css"><link rel="stylesheet" href="assets/css/service.css"><link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"><title><?= e($service['details_title'] ?: $service['title']) ?></title></head>
<body><main class="detail-page"><a class="btn" href="index.php">&larr; Back to Home</a><div class="service-layout<?= $service['details_image'] ? '' : ' service-layout--text-only' ?>"><?php if ($service['details_image']): ?><div class="service-image"><img class="detail-image" src="assets/images/<?= e($service['details_image']) ?>" alt="<?= e($service['title']) ?> image"></div><?php endif; ?><div class="details-box"><h1><?= e($service['details_title'] ?: $service['title']) ?></h1><p><?= e($service['details_description'] ?: $service['short_description']) ?></p><?php if ($items): ?><h2>Services include</h2><ul><?php foreach ($items as $item): ?><li><?= e((string)$item) ?></li><?php endforeach; ?></ul><?php endif; ?></div></div></main></body></html>
