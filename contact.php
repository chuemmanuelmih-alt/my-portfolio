<?php

declare(strict_types=1);

session_start();
require __DIR__ . '/config/db.php';
require __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php#contact');
}

$name = trim((string)($_POST['name'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$phone = trim((string)($_POST['phone'] ?? ''));
$subject = trim((string)($_POST['subject'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));

if ($name === '' || $subject === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    set_flash('error', 'Please provide a valid name, email, subject, and message.');
    redirect('index.php#contact');
}

$stmt = $pdo->prepare('INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (:name, :email, :phone, :subject, :message)');
$stmt->execute([
    ':name' => $name,
    ':email' => $email,
    ':phone' => $phone !== '' ? $phone : null,
    ':subject' => $subject,
    ':message' => $message,
]);

set_flash('success', 'Thank you. Your message has been sent successfully.');
redirect('index.php#contact');
