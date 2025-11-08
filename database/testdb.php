<?php
require __DIR__ . '/../connection.php'; 

$sql = "SELECT * FROM sportradar_exercise.countries";

try {
    $stmt = $pdo->query($sql); 
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    if (count($results) > 0) {
        echo "Data retrieved successfully (" . count($results) . " rows):\n\n";
        foreach ($results as $row) {
            print_r($row);
            echo "\n";
        }
    } else {
        echo "No data found in the table.\n";
    }

} catch (PDOException $e) {
    echo "Error retrieving data: " . $e->getMessage() . "\n";
}
