<?php
require __DIR__ . '/includes/admin_bootstrap.php';
$page_title = 'Dashboard';
$stats = [
    'testimonials' => (int)$pdo->query('SELECT COUNT(*) FROM testimonials WHERE is_active = 1')->fetchColumn(),
    'messages' => (int)$pdo->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'new'")->fetchColumn(),
    'services' => (int)$pdo->query('SELECT COUNT(*) FROM services WHERE is_active = 1')->fetchColumn(),
    'projects' => (int)$pdo->query('SELECT COUNT(*) FROM projects WHERE is_active = 1')->fetchColumn(),
];
$recent = $pdo->query('SELECT id, name, email, subject, status, created_at FROM contact_messages ORDER BY created_at DESC LIMIT 5')->fetchAll();
require __DIR__ . '/includes/header.php';
?><section class="stats-grid"><article class="stat-card"><i class="bx bx-message-square-detail">
</i><div><strong><?= $stats['testimonials'] ?></strong><span>Visible testimonials</span></div></article><article class="stat-card"><i class="bx bx-envelope"></i><div><strong><?= $stats['messages'] ?></strong><span>Unread messages</span></div></article><article class="stat-card"><i class="bx bx-briefcase"></i><div><strong><?= $stats['services'] ?></strong><span>Services listed</span></div></article><article class="stat-card"><i class="bx bx-code-alt"></i><div><strong><?= $stats['projects'] ?></strong><span>Projects listed</span></div></article></section><section class="panel"><div class="panel-heading"><h2>Recent messages</h2><a href="messages.php" class="text-link">View all &rarr;</a></div><div class="table-wrap"><table><thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Status</th><th></th></tr></thead><tbody><?php foreach ($recent as $message): ?><tr><td><?= e($message['name']) ?></td><td><?= e($message['email']) ?></td><td><?= e($message['subject']) ?></td><td><span class="badge <?= e($message['status']) ?>"><?= e($message['status']) ?></span></td><td><a class="text-link" href="message.php?id=<?= (int)$message['id'] ?>">View &rarr;</a></td></tr><?php endforeach; ?><?php if (!$recent): ?><tr><td colspan="5" class="empty">No messages yet.</td></tr><?php endif; ?></tbody></table></div></section><?php require __DIR__ . '/includes/footer.php'; ?>
