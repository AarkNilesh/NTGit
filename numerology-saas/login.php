<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

if (isset($_GET['logout'])) {
    logout_user();
    header('Location: /');
    exit;
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (login_user($_POST['email'] ?? '', $_POST['password'] ?? '')) {
        header('Location: /dashboard.php');
        exit;
    }

    $error = 'Invalid email or password.';
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<main class="container">
    <div class="card">
        <h1>Login</h1>
        <?php if ($error): ?>
            <div class="alert"><?= e($error) ?></div>
        <?php endif; ?>
        <form method="post">
            <label>Email</label>
            <input type="email" name="email" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button>Login</button>
        </form>
        <p>New here? <a href="/register.php">Register</a></p>
    </div>
</main>
</body>
</html>
