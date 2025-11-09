<?php
require_once __DIR__ . '/../connection.php';
header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['name']) || !isset($data['region'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing required fields']);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO countries (name, region) VALUES (:name, :region)");
    $stmt->execute([
        'name' => $data['name'],
        'region' => $data['region']
    ]);

    echo json_encode(['message' => 'Country created successfully']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
