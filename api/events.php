<?php
require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../dto/EventDto.php';

header('Content-Type: application/json');

try {
    $competitionId = $_GET['competition_id'] ?? null;

    $sql = "
        SELECT
            e.id AS event_id,
            e.start_time,

            s.name AS sport_name,
            s.description AS sport_description,

            comp.name AS competition_name,
            comp_country.name AS competition_country,
            comp_country.iso_code AS competition_country_iso,

            v.name AS venue_name,
            v.capacity AS venue_capacity,
            venue_country.name AS venue_country,
            venue_country.iso_code AS venue_country_iso,

            home.name AS home_name,
            home.short_name AS home_short,
            home.age AS home_age,
            home_country.name AS home_nationality,
            home_gender.description AS home_gender,

            away.name AS away_name,
            away.short_name AS away_short,
            away.age AS away_age,
            away_country.name AS away_nationality,
            away_gender.description AS away_gender

        FROM events e
        LEFT JOIN sports s ON e.sport_id = s.id
        LEFT JOIN competitions comp ON e.competition_id = comp.id
        LEFT JOIN countries comp_country ON comp.country_id = comp_country.id
        LEFT JOIN venues v ON e.venue_id = v.id
        LEFT JOIN countries venue_country ON v.country_id = venue_country.id
        LEFT JOIN competitors home ON e.competitor_home_id = home.id
        LEFT JOIN countries home_country ON home.nationality = home_country.id
        LEFT JOIN genders home_gender ON home.gender_id = home_gender.id
        LEFT JOIN competitors away ON e.competitor_away_id = away.id
        LEFT JOIN countries away_country ON away.nationality = away_country.id
        LEFT JOIN genders away_gender ON away.gender_id = away_gender.id
    ";

    if ($competitionId) {
        $sql .= " WHERE e.competition_id = :competition_id";
    }

    $sql .= " ORDER BY e.start_time ASC";

    if ($competitionId) {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['competition_id' => $competitionId]);
    } else {
        $stmt = $pdo->query($sql);
    }

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $events = array_map(fn($row) => new EventDto($row), $rows);

    echo json_encode($events, JSON_PRETTY_PRINT);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
