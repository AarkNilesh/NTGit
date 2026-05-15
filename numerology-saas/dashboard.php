<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

$user = require_login();
$pdo = db();

$clientCount = $pdo->prepare('SELECT COUNT(*) c FROM clients WHERE user_id = ?');
$clientCount->execute([$user['id']]);

$reportCount = $pdo->prepare('SELECT COUNT(*) c FROM reports r JOIN clients c ON c.id = r.client_id WHERE c.user_id = ?');
$reportCount->execute([$user['id']]);

$paid = $pdo->prepare("SELECT COALESCE(SUM(amount), 0) total FROM payments WHERE user_id = ? AND status = 'paid'");
$paid->execute([$user['id']]);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<nav class="nav">
    <div class="brand">Dashboard</div>
    <div class="nav-links">
        <a href="/add_profile.php">Add Profile</a>
        <a href="/crm/clients.php">Clients</a>
        <a href="/login.php?logout=1">Logout</a>
    </div>
</nav>
<main class="container">
    <h1>Welcome, <?= e($user['name']) ?></h1>
    <div class="grid">
        <div class="card">
            <div class="stat"><?= (int) $clientCount->fetch()['c'] ?></div>
            <p>Clients</p>
        </div>
        <div class="card">
            <div class="stat"><?= (int) $reportCount->fetch()['c'] ?></div>
            <p>Reports</p>
        </div>
        <div class="card">
            <div class="stat">$<?= number_format((float) $paid->fetch()['total'], 2) ?></div>
            <p>Revenue</p>
        </div>
    </div>
</main>
</body>
</html>
