<?php
require_once 'database.php';

function executeSQLFile($pdo, $filename) {
    try {
        $sql = file_get_contents($filename);
        $pdo->exec($sql);
        echo "Successfully executed $filename\n";
    } catch (PDOException $e) {
        echo "Error executing $filename: " . $e->getMessage() . "\n";
    }
}

// Execute all SQL files in order
executeSQLFile($pdo, __DIR__ . '/init.sql');
executeSQLFile($pdo, __DIR__ . '/wines_schema.sql');
executeSQLFile($pdo, __DIR__ . '/collections_schema.sql');

echo "Database setup completed!\n";
?> 