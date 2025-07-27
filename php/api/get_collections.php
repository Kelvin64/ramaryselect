<?php
require_once __DIR__ . '/../config/database.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure proper UTF-8 encoding
mb_internal_encoding('UTF-8');
$pdo->exec("SET NAMES utf8mb4");
$pdo->exec("SET CHARACTER SET utf8mb4");

// Start output buffering
ob_start();

// Set headers
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');

try {
    // Test database connection
    try {
        $pdo->query("SELECT 1");
        error_log("[Collections API] Database connection successful");
    } catch (PDOException $e) {
        error_log("[Collections API] Database connection failed: " . $e->getMessage());
        throw $e;
    }

    // Check if table exists
    try {
        $tableCheck = $pdo->query("SHOW TABLES LIKE 'wine_collections'");
        if ($tableCheck->rowCount() === 0) {
            error_log("[Collections API] wine_collections table does not exist");
            throw new Exception("Table wine_collections does not exist");
        }
        error_log("[Collections API] wine_collections table exists");
    } catch (PDOException $e) {
        error_log("[Collections API] Error checking table: " . $e->getMessage());
        throw $e;
    }
    
    // Fetch all active collections
    $stmt = $pdo->prepare("
        SELECT 
            id,
            name,
            description,
            image_path,
            pdf_path,
            created_at
        FROM wine_collections 
        WHERE is_active = TRUE 
        ORDER BY created_at ASC
    ");
    
    $stmt->execute();
    $collections = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("[Collections API] Found " . count($collections) . " collections");
    
    // Process the results
    $processed_collections = [];
    foreach ($collections as $collection) {
        // Ensure proper UTF-8 encoding for text fields
        $processed_collection = [
            'id' => (int)$collection['id'],
            'name' => mb_convert_encoding($collection['name'], 'UTF-8', 'UTF-8'),
            'description' => mb_convert_encoding($collection['description'], 'UTF-8', 'UTF-8'),
            'image_path' => $collection['image_path'] ? '/ramaryselect/' . ltrim($collection['image_path'], '/') : '/ramaryselect/images/wine1.jpg',
            'pdf_path' => $collection['pdf_path'] ? '/ramaryselect/' . ltrim($collection['pdf_path'], '/') : null,
            'has_brochure' => !empty($collection['pdf_path']),
            'created_at' => $collection['created_at']
        ];
        $processed_collections[] = $processed_collection;
    }
    
    // Clear any previous output
    ob_clean();
    
    // Prepare response
    $response = [
        'success' => true,
        'collections' => $processed_collections
    ];
    
    // Test JSON encoding with UTF-8 options
    $json = json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($json === false) {
        error_log("[Collections API] JSON encode error: " . json_last_error_msg());
        throw new Exception("Failed to encode JSON response: " . json_last_error_msg());
    }
    
    // Log response for debugging
    error_log("[Collections API] Response JSON: " . $json);
    
    // Send response
    echo $json;
    
} catch (PDOException $e) {
    error_log("[Collections API] Database error: " . $e->getMessage());
    error_log("[Collections API] Stack trace: " . $e->getTraceAsString());
    
    ob_clean();
    echo json_encode([
        'success' => false,
        'error' => 'Database error occurred'
    ]);
} catch (Exception $e) {
    error_log("[Collections API] General error: " . $e->getMessage());
    error_log("[Collections API] Stack trace: " . $e->getTraceAsString());
    
    ob_clean();
    echo json_encode([
        'success' => false,
        'error' => 'An error occurred'
    ]);
}

// End output buffer
ob_end_flush();
?> 