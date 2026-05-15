<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$user = require_login();
$stmt = db()->prepare('SELECT * FROM clients WHERE user_id = ? ORDER BY created_at DESC');
$stmt->execute([$user['id']]);
$clients = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
    <title>Clients</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<main class="container">
    <h1>Client CRM</h1>
    <p><a class="btn" href="/add_profile.php">Add Client</a></p>
    <table>
        <thead>
        <tr><th>Name</th><th>Birth Date</th><th>Phone</th><th>Action</th></tr>
        </thead>
        <tbody>
        <?php foreach ($clients as $client): ?>
            <tr>
                <td><?= e($client['full_name']) ?></td>
                <td><?= e($client['birth_date']) ?></td>
                <td><?= e($client['phone']) ?></td>
                <td><a href="/crm/client_view.php?id=<?= $client['id'] ?>">View</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
</body>
</html>
