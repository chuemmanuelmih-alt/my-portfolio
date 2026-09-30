<?php
require __DIR__ . '/includes/admin_bootstrap.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); $token = (string)($_GET['token'] ?? '');
if (!$id || !hash_equals(csrf_token(), $token)) { http_response_code(400); exit('Invalid delete request.'); }
$pdo->prepare('DELETE FROM services WHERE id=?')->execute([$id]); flash('success','Service deleted.'); admin_redirect('services.php');
