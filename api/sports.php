<?php
require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../dto/SportDto.php';
header('Content-Type: application/json');

try {

    $sql = "SELECT id, name, description FROM sports ORDER BY name ASC";
    $query = $pdo->query($sql);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    $sports = array_map(function ($row) {
        $sport = new SportDto();
        $sport->id = $row['id'];
        $sport->name = $row['name'];
        $sport->description = $row['description'];
        return $sport;
    }, $data);

    echo json_encode($sports, JSON_PRETTY_PRINT);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
