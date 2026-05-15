<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$user = current_user();
if (!$user) {
    api_response(['error' => 'Unauthenticated'], 401);
}

$input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
if (empty($input['full_name']) || empty($input['birth_date'])) {
    api_response(['error' => 'full_name and birth_date are required'], 422);
}

$report = build_report([
    'full_name' => $input['full_name'],
    'birth_date' => $input['birth_date'],
]);

api_response(['data' => $report]);
