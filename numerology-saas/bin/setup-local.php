<?php
/**
 * Local setup helper for the standalone PHP application.
 *
 * Usage:
 *   php bin/setup-local.php
 *   php bin/setup-local.php --admin-email=admin@example.com --admin-password=password123
 */
declare(strict_types=1);

require_once __DIR__ . '/../includes/db.php';

$options = getopt('', ['admin-email::', 'admin-password::', 'admin-name::']);
$pdo = db();

$adminEmail = strtolower(trim((string) ($options['admin-email'] ?? 'admin@example.com')));
$adminPassword = (string) ($options['admin-password'] ?? 'password123');
$adminName = (string) ($options['admin-name'] ?? 'Admin User');

$stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
$stmt->execute([$adminEmail]);
$adminId = $stmt->fetchColumn();

if ($adminId) {
    $update = $pdo->prepare('UPDATE users SET name = ?, password = ?, role = ? WHERE id = ?');
    $update->execute([$adminName, password_hash($adminPassword, PASSWORD_DEFAULT), 'admin', $adminId]);
    echo "Updated admin account: {$adminEmail}\n";
} else {
    $insert = $pdo->prepare('INSERT INTO users (name, email, password, role, created_at) VALUES (?, ?, ?, ?, ?)');
    $insert->execute([$adminName, $adminEmail, password_hash($adminPassword, PASSWORD_DEFAULT), 'admin', date('c')]);
    echo "Created admin account: {$adminEmail}\n";
}

echo "Database ready at: " . DB_PATH . "\n";
echo "Default login: {$adminEmail} / {$adminPassword}\n";
