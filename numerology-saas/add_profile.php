<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

$user = require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = db()->prepare(
        'INSERT INTO clients (user_id, full_name, birth_date, phone, email, notes, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([
        $user['id'],
        $_POST['full_name'],
        $_POST['birth_date'],
        $_POST['phone'] ?? '',
        $_POST['email'] ?? '',
        $_POST['notes'] ?? '',
        date('c'),
    ]);

    header('Location: /report.php?client_id=' . db()->lastInsertId());
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Add Profile</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="/assets/js/app.js" defer></script>
</head>
<body>
<main class="container">
    <div class="card">
        <h1>Add Client Profile</h1>
        <p id="name-preview">Enter a client name to begin.</p>
        <form method="post">
            <label>Full name</label>
            <input id="full_name" name="full_name" required>
            <label>Birth date</label>
            <input type="date" name="birth_date" required>
            <label>Phone / WhatsApp</label>
            <input name="phone">
            <label>Email</label>
            <input type="email" name="email">
            <label>Notes</label>
            <textarea name="notes"></textarea>
            <button>Generate Report</button>
        </form>
    </div>
</main>
</body>
</html>
