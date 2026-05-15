<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

require_admin();
$payments = db()->query(
    'SELECT p.*, u.email user_email, c.full_name
     FROM payments p
     JOIN users u ON u.id = p.user_id
     LEFT JOIN clients c ON c.id = p.client_id
     ORDER BY p.created_at DESC'
)->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
    <title>Revenue</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<main class="container">
    <h1>Revenue</h1>
    <table>
        <tr><th>Reference</th><th>User</th><th>Client</th><th>Amount</th><th>Status</th></tr>
        <?php foreach ($payments as $payment): ?>
            <tr>
                <td><?= e($payment['reference']) ?></td>
                <td><?= e($payment['user_email']) ?></td>
                <td><?= e($payment['full_name']) ?></td>
                <td><?= e($payment['currency']) ?> <?= number_format((float) $payment['amount'], 2) ?></td>
                <td><?= e($payment['status']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>
</body>
</html>
