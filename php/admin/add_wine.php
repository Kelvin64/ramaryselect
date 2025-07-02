<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';

// Ensure user is admin
requireAdmin();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $brand = trim($_POST['brand'] ?? '');
    $type = trim($_POST['type'] ?? '');
    $cask = trim($_POST['cask'] ?? '');
    $image = $_FILES['image'] ?? null;

    // Validation
    if (empty($name) || empty($brand) || empty($type)) {
        $error = 'Please fill in all required fields (Name, Brand, Type).';
    } elseif ($image && $image['error'] === UPLOAD_ERR_OK) {
        // Handle image upload
        $target_dir = __DIR__ . '/../../images/wines/';
        
        // Create wines directory if it doesn't exist
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        
        $image_name = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', basename($image['name']));
        $target_file = $target_dir . $image_name;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is valid
        $check = getimagesize($image['tmp_name']);
        if ($check === false) {
            $error = 'File is not a valid image.';
        } elseif (!in_array($image_file_type, ['jpg', 'png', 'jpeg', 'gif', 'webp'])) {
            $error = 'Only JPG, JPEG, PNG, GIF & WebP files are allowed.';
        } elseif ($image['size'] > 5000000) { // 5MB limit
            $error = 'Image file is too large. Maximum size is 5MB.';
        } elseif (!move_uploaded_file($image['tmp_name'], $target_file)) {
            $error = 'Failed to upload image. Please try again.';
        } else {
            $image_path = '/ramaryselect/images/wines/' . $image_name;
        }
    } elseif ($image && $image['error'] !== UPLOAD_ERR_NO_FILE) {
        $error = 'Image upload failed. Please try again.';
    }

    // Insert wine into database if no errors
    if (empty($error)) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO wines (name, brand, type, cask, image_path, created_by) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $name, 
                $brand, 
                $type, 
                $cask ?: null, 
                $image_path ?? null, 
                $_SESSION['user_id']
            ]);
            $success = 'Wine added successfully!';
            
            // Clear form data
            $_POST = [];
        } catch (PDOException $e) {
            error_log("Add wine error: " . $e->getMessage());
            $error = 'Database error occurred. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../images/logo2.png">
    <title>Add New Wine - RamarySelect</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/components/auth.css">
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <div class="wine-form-page">
        <div class="wine-form-card">
            <div class="wine-form-header">
                <div class="auth-card__logo">
                    <img src="../../images/logo2.png" alt="RamarySelect Logo" />
                </div>
                <h2 class="auth-card__title">Add New Wine</h2>
                
                <?php if ($error): ?>
                    <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>
            </div>
            
            <form method="POST" class="wine-form" enctype="multipart/form-data">
                <div class="wine-form-grid">
                    <!-- Left Column - Form Fields -->
                    <div class="wine-form-fields">
                        <div class="form-group">
                            <label for="name">Wine Name *</label>
                            <input type="text" id="name" name="name" required 
                                   value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                                   placeholder="e.g., Arbora">
                        </div>

                        <div class="form-group">
                            <label for="brand">Brand *</label>
                            <input type="text" id="brand" name="brand" required 
                                   value="<?php echo htmlspecialchars($_POST['brand'] ?? ''); ?>"
                                   placeholder="e.g., Arbora Vineyards">
                        </div>

                        <div class="form-group">
                            <label for="type">Wine Type *</label>
                            <input type="text" id="type" name="type" required 
                                   value="<?php echo htmlspecialchars($_POST['type'] ?? ''); ?>"
                                   placeholder="e.g., Pinot Noir, Chardonnay">
                        </div>

                        <div class="form-group">
                            <label for="cask">Cask (Optional)</label>
                            <input type="text" id="cask" name="cask" 
                                   value="<?php echo htmlspecialchars($_POST['cask'] ?? ''); ?>"
                                   placeholder="e.g., Gau Cask, Oak Barrel">
                        </div>
                    </div>
                    
                    <!-- Right Column - Image Upload & Preview -->
                    <div class="wine-form-preview">
                        <div class="form-group">
                            <label for="image">Wine Image</label>
                            <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                            <small style="color: #666; font-size: 0.9rem; display: block; margin-bottom: 1rem;">
                                Supported formats: JPG, PNG, GIF, WebP (Max: 5MB)
                            </small>
                        </div>
                        
                        <div class="image-preview-container">
                            <div class="image-preview-box" id="imagePreviewBox">
                                <div class="preview-placeholder">
                                    <svg width="64" height="64" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17l2.5-3.25L14 17H9zm0-9c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                    </svg>
                                    <p>Image Preview</p>
                                    <p class="preview-text">Upload an image to see preview</p>
                                </div>
                                <img id="imagePreview" src="" alt="Wine preview" style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="wine-form-actions">
                    <button type="submit" class="btn btn-primary">Add Wine</button>
                    <a href="/ramaryselect/index.php" class="btn btn-secondary">← Back to Home</a>
                </div>
            </form>
        </div>
    </div>

    <script src="../../js/main.js"></script>
    <script>
        function previewImage(input) {
            const previewBox = document.getElementById('imagePreviewBox');
            const preview = document.getElementById('imagePreview');
            const placeholder = previewBox.querySelector('.preview-placeholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                    previewBox.classList.add('has-image');
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.display = 'none';
                placeholder.style.display = 'flex';
                previewBox.classList.remove('has-image');
            }
        }
    </script>
</body>
</html> 