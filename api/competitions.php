<?php
require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../dto/CompetitionDto.php';
require_once __DIR__ . '/../dto/CountryDto.php';
header('Content-Type: application/json');

try {

    $sql = "SELECT c.name AS competition_name, c.id AS competition_id, co.name AS country_name, co.iso_code AS country_iso_code FROM competitions c
    LEFT JOIN countries co ON c.country_id = co.id
    ORDER BY c.name ASC";

    $query = $pdo->query($sql);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    $competitions = array_map(function ($row) {

        $competitionCountry = new CountryDto();
        $competitionCountry->name = $row['country_name'];
        $competitionCountry->iso_code = $row['country_iso_code'];

        $competition = new CompetitionDto();
        $competition->name = $row['competition_name'];
        $competition->id = $row['competition_id'];
        $competition->country = $competitionCountry;

        return $competition;
    }, $data);

    echo json_encode($competitions, JSON_PRETTY_PRINT);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
