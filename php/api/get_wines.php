<?php
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

try {
    $stmt = $pdo->prepare("
        SELECT id, name, brand, type, cask, image_path 
        FROM wines 
        WHERE is_active = 1 
        ORDER BY created_at DESC
    ");
    $stmt->execute();
    $wines = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Format data for frontend compatibility
    $formattedWines = array_map(function($wine) {
        return [
            'id' => $wine['id'],
            'name' => $wine['name'],
            'brand' => $wine['brand'],
            'type' => $wine['type'],
            'cask' => $wine['cask'] ?: '',
            'image' => $wine['image_path'] ?: '/ramaryselect/images/sidepan.png'
        ];
    }, $wines);
    
    echo json_encode([
        'success' => true,
        'wines' => $formattedWines
    ]);
    
} catch (PDOException $e) {
    error_log("Get wines error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'error' => 'Failed to fetch wines'
    ]);
}
?> 