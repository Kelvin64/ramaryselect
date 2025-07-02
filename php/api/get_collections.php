<?php
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

try {
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
    
    // Process the results
    $processed_collections = [];
    foreach ($collections as $collection) {
        $processed_collections[] = [
            'id' => (int)$collection['id'],
            'name' => $collection['name'],
            'description' => $collection['description'],
            'image_path' => $collection['image_path'] ? '/ramaryselect/' . $collection['image_path'] : '/ramaryselect/images/wine1.jpg',
            'pdf_path' => $collection['pdf_path'] ? '/ramaryselect/' . $collection['pdf_path'] : null,
            'has_brochure' => !empty($collection['pdf_path']),
            'created_at' => $collection['created_at']
        ];
    }
    
    echo json_encode([
        'success' => true,
        'collections' => $processed_collections
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Failed to fetch collections'
    ]);
} 