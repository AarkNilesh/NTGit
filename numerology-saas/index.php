<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

$user = current_user();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= e(APP_NAME) ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<nav class="nav">
    <div class="brand">🔮 <?= e(APP_NAME) ?></div>
    <div class="nav-links">
        <?php if ($user): ?>
            <a href="/dashboard.php">Dashboard</a>
            <a href="/crm/clients.php">CRM</a>
            <?php if ($user['role'] === 'admin'): ?>
                <a href="/admin/dashboard.php">Admin</a>
            <?php endif; ?>
            <a href="/login.php?logout=1">Logout</a>
        <?php else: ?>
            <a href="/login.php">Login</a>
            <a class="btn" href="/register.php">Start Free</a>
        <?php endif; ?>
    </div>
</nav>

<main class="container">
    <section class="hero">
        <div>
            <span class="badge">AI-ready numerology SaaS</span>
            <h1>Generate professional numerology reports, manage clients, and collect payments.</h1>
            <p>
                Built for numerologists who need a simple CRM, instant chart calculations,
                shareable WhatsApp summaries, and downloadable PDFs.
            </p>
            <a class="btn" href="<?= $user ? '/add_profile.php' : '/register.php' ?>">Create a report</a>
            <a class="btn secondary" href="/login.php">Login</a>
        </div>
        <div class="card">
            <h3>Report Flow</h3>
            <ol>
                <li>Register or login</li>
                <li>Add client birth details</li>
                <li>Generate numerology report</li>
                <li>Collect payment</li>
                <li>Download or share PDF</li>
            </ol>
        </div>
    </section>
</main>
</body>
</html>
