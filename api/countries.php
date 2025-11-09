<?php
require_once __DIR__ . '/../connection.php';
header('Content-Type: application/json');

try {
    $region = $_GET['region'] ?? null;
    $id = $_GET['id'] ?? null;

    if ($id) {
        $stmt = $pdo->prepare("SELECT * FROM countries WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    } elseif ($region) {
        $stmt = $pdo->prepare("
            SELECT c.*, COUNT(t.id) AS team_count
            FROM countries c
            LEFT JOIN teams t ON t.country_id = c.id
            WHERE c.region = :region
            GROUP BY c.id
        ");
        $stmt->execute(['region' => $region]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $stmt = $pdo->query("SELECT * FROM countries ORDER BY name ASC");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($data);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
