<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$user = current_user();
if (!$user) {
    api_response(['error' => 'Unauthenticated'], 401);
}

$clientId = (int) ($_GET['client_id'] ?? 0);
$stmt = db()->prepare(
    'SELECT c.full_name, c.phone, r.content
     FROM clients c
     JOIN reports r ON r.client_id = c.id
     WHERE c.id = ? AND c.user_id = ?
     ORDER BY r.id DESC
     LIMIT 1'
);
$stmt->execute([$clientId, $user['id']]);
$row = $stmt->fetch();

if (!$row) {
    api_response(['error' => 'Report not found'], 404);
}

$text = 'Your numerology report is ready: ' . $row['content'];
api_response([
    'whatsapp_url' => 'https://wa.me/' . preg_replace('/\D/', '', $row['phone']) . '?text=' . rawurlencode($text),
    'message' => $text,
]);
