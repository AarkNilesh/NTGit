<?php
declare(strict_types=1);
require_once __DIR__ . '/db.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function current_user(): ?array
{
    if (empty($_SESSION['user_id'])) {
        return null;
    }
    $stmt = db()->prepare('SELECT id, name, email, role, created_at FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch() ?: null;
}

function require_login(): array
{
    $user = current_user();
    if (!$user) {
        header('Location: /login.php');
        exit;
    }
    return $user;
}

function require_admin(): array
{
    $user = require_login();
    if ($user['role'] !== 'admin') {
        http_response_code(403);
        exit('Admin access required.');
    }
    return $user;
}

function register_user(string $name, string $email, string $password): bool
{
    $stmt = db()->prepare('INSERT INTO users (name, email, password, role, created_at) VALUES (?, ?, ?, ?, ?)');
    return $stmt->execute([
        trim($name),
        strtolower(trim($email)),
        password_hash($password, PASSWORD_DEFAULT),
        'user',
        date('c'),
    ]);
}

function login_user(string $email, string $password): bool
{
    $stmt = db()->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([strtolower(trim($email))]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        return true;
    }
    return false;
}

function logout_user(): void
{
    $_SESSION = [];
    session_destroy();
}
