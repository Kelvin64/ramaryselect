<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');     // Change this to your database username
define('DB_PASS', '');         // Change this to your database password
define('DB_NAME', 'ramaryselect_db');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?> 