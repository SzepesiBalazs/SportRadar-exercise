<?php
require_once __DIR__ . '/../connection.php';
header('Content-Type: application/json');

try {

    $sql = "SELECT * FROM countries ORDER BY name ASC";
    $query = $pdo->query($sql);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    $countries = array_map(fn($row) => new CountryDto($row), $data);

    echo json_encode($countries, JSON_PRETTY_PRINT);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
