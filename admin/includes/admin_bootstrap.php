<?php

declare(strict_types=1);

session_start();
require_once dirname(__DIR__, 2) . '/config/db.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';

if (empty($_SESSION['admin_id']) && !in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1'], true)) {
    http_response_code(403);
    exit('Admin access is available only from this computer.');
}

function admin_user(): array
{
    return $_SESSION['admin_user'] ?? ['name' => 'Admin', 'email' => ''];
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf(): void
{
    if (!hash_equals($_SESSION['csrf_token'] ?? '', (string)($_POST['csrf_token'] ?? ''))) {
        http_response_code(419);
        exit('Invalid security token. Please go back and try again.');
    }
}

function flash(string $type, string $message): void
{
    $_SESSION['admin_flash'] = ['type' => $type, 'message' => $message];
}

function take_flash(): ?array
{
    $flash = $_SESSION['admin_flash'] ?? null;
    unset($_SESSION['admin_flash']);
    return $flash;
}

function admin_redirect(string $page): never
{
    header('Location: ' . $page);
    exit;
}
