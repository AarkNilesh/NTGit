<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

$user = require_login();
$clientId = (int) ($_GET['client_id'] ?? 0);

$stmt = db()->prepare(
    'SELECT c.*, r.content, r.life_path, r.destiny, r.soul_urge, r.personality
     FROM clients c
     LEFT JOIN reports r ON r.client_id = c.id
     WHERE c.id = ? AND c.user_id = ?
     ORDER BY r.id DESC
     LIMIT 1'
);
$stmt->execute([$clientId, $user['id']]);
$report = $stmt->fetch();

if (!$report) {
    http_response_code(404);
    exit('Report not found');
}

$html = '<h1>' . e($report['full_name']) . ' Numerology Report</h1><p>' . e($report['content']) . '</p>';

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';

    $dompdf = new Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->render();
    $dompdf->stream('numerology-report.pdf');
    exit;
}

header('Content-Type: text/html');
header('Content-Disposition: attachment; filename="numerology-report.html"');
echo $html;
