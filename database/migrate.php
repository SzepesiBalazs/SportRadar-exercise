<?php
require_once __DIR__ . '/../connection.php';

$sql = "
CREATE TABLE IF NOT EXISTS countries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    iso_code CHAR(3) NOT NULL
);

CREATE TABLE IF NOT EXISTS genders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS sports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

CREATE TABLE IF NOT EXISTS competitions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    country_id INT,
    FOREIGN KEY (country_id) REFERENCES countries(id)
);

CREATE TABLE IF NOT EXISTS venues (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    capacity INT,
    country_id INT,
    FOREIGN KEY (country_id) REFERENCES countries(id)
);

CREATE TABLE IF NOT EXISTS competitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    nationality INT NULL,
    age INT NULL,
    gender_id INT NULL,
    short_name VARCHAR(50) NULL,
    FOREIGN KEY (nationality) REFERENCES countries(id),
    FOREIGN KEY (gender_id) REFERENCES genders(id)
);

CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sport_id INT,
    competition_id INT,
    start_time DATETIME,
    competitor_home_id INT,
    competitor_away_id INT,
    venue_id INT,
    FOREIGN KEY (sport_id) REFERENCES sports(id),
    FOREIGN KEY (competition_id) REFERENCES competitions(id),
    FOREIGN KEY (competitor_home_id) REFERENCES competitors(id),
    FOREIGN KEY (competitor_away_id) REFERENCES competitors(id),
    FOREIGN KEY (venue_id) REFERENCES venues(id)
);
";

try {
    $pdo->exec($sql);
    echo "All tables created successfully.\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
