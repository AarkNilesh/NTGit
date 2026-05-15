<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

require_admin();
$users = db()->query('SELECT id, name, email, role, created_at FROM users ORDER BY created_at DESC')->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
    <title>Users</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<main class="container">
    <h1>Users</h1>
    <table>
        <tr><th>Name</th><th>Email</th><th>Role</th><th>Joined</th></tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= e($user['name']) ?></td>
                <td><?= e($user['email']) ?></td>
                <td><?= e($user['role']) ?></td>
                <td><?= e($user['created_at']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>
</body>
</html>
