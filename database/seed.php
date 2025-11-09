<?php
require_once __DIR__ . '/../connection.php';

$sql = "
INSERT INTO countries (name, iso_code) VALUES
('Spain', 'ESP'),
('England', 'ENG'),
('USA', 'USA');

INSERT INTO genders (description) VALUES
('Male'),
('Female');

INSERT INTO sports (name, description) VALUES
('Football', 'Team sport with a ball'),
('Tennis', 'Racket sport');

INSERT INTO competitions (name, country_id) VALUES
('La Liga', 1),
('Premier League', 2);

INSERT INTO venues (name, capacity, country_id) VALUES
('Santiago Bernabéu', 81044, 1),
('Camp Nou', 99354, 1),
('Old Trafford', 74879, 2),
('Anfield', 54074, 2);

INSERT INTO competitors (name, nationality, age, gender_id, short_name) VALUES
('Real Madrid', 1, NULL, NULL, 'RMA'),
('Barcelona', 1, NULL, NULL, 'FCB'),
('Manchester United', 2, NULL, NULL, 'MUN'),
('Liverpool', 2, NULL, NULL, 'LIV');

INSERT INTO events (sport_id, competition_id, start_time, competitor_home_id, competitor_away_id, venue_id) VALUES
(1, 1, '2024-10-01 14:00:00', 1, 2, 1),
(1, 2, '2024-10-03 17:00:00', 3, 4, 3);
";

if ($pdo->exec($sql)) {
    echo "Data inserted successfully.\n";
} else {
    echo "Error inserting data: " . $pdo->errorInfo()[2] . "\n";
}

$pdo = null;
?>
