<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';

// Ensure only admins can access this page
requireAdmin();

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    
    // Validation
    if (empty($name)) {
        $error_message = 'Collection name is required.';
    } else {
        try {
            $image_path = null;
            $pdf_path = null;
            
            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image_file = $_FILES['image'];
                $allowed_image_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                
                if (!in_array($image_file['type'], $allowed_image_types)) {
                    throw new Exception('Invalid image file type. Please upload JPG, PNG, GIF, or WebP files only.');
                }
                
                if ($image_file['size'] > 5 * 1024 * 1024) { // 5MB limit
                    throw new Exception('Image file size must be less than 5MB.');
                }
                
                $image_extension = pathinfo($image_file['name'], PATHINFO_EXTENSION);
                $image_filename = time() . '_collection_image.' . $image_extension;
                $image_upload_path = __DIR__ . '/../../images/collections/' . $image_filename;
                
                // Create directory if it doesn't exist
                if (!file_exists(dirname($image_upload_path))) {
                    mkdir(dirname($image_upload_path), 0755, true);
                }
                
                if (move_uploaded_file($image_file['tmp_name'], $image_upload_path)) {
                    $image_path = 'images/collections/' . $image_filename;
                } else {
                    throw new Exception('Failed to upload image file.');
                }
            }
            
            // Handle PDF upload
            if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
                $pdf_file = $_FILES['pdf'];
                
                if ($pdf_file['type'] !== 'application/pdf') {
                    throw new Exception('Invalid file type. Please upload PDF files only.');
                }
                
                if ($pdf_file['size'] > 10 * 1024 * 1024) { // 10MB limit for PDFs
                    throw new Exception('PDF file size must be less than 10MB.');
                }
                
                $pdf_filename = time() . '_' . sanitizeFilename($pdf_file['name']);
                $pdf_upload_path = __DIR__ . '/../../uploads/brochures/' . $pdf_filename;
                
                // Create directory if it doesn't exist
                if (!file_exists(dirname($pdf_upload_path))) {
                    mkdir(dirname($pdf_upload_path), 0755, true);
                }
                
                if (move_uploaded_file($pdf_file['tmp_name'], $pdf_upload_path)) {
                    $pdf_path = 'uploads/brochures/' . $pdf_filename;
                } else {
                    throw new Exception('Failed to upload PDF file.');
                }
            }
            
            // Insert into database
            $stmt = $pdo->prepare("
                INSERT INTO wine_collections (name, description, image_path, pdf_path, created_by) 
                VALUES (?, ?, ?, ?, ?)
            ");
            
            $stmt->execute([
                $name,
                $description,
                $image_path,
                $pdf_path,
                $_SESSION['user_id']
            ]);
            
            $success_message = 'Wine collection uploaded successfully!';
            
            // Clear form data
            $name = '';
            $description = '';
            
        } catch (Exception $e) {
            $error_message = $e->getMessage();
        }
    }
}

function sanitizeFilename($filename) {
    // Remove any path information and clean the filename
    $filename = basename($filename);
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
    return $filename;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/ramaryselect/images/logo2.png">
    <title>Add Collection - RamarySelect Admin</title>
    <link rel="stylesheet" href="/ramaryselect/css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Header -->
    <?php include '../includes/header.php'; ?>

    <main class="collection-main">
        <div class="collection-container">
            <div class="collection-form-card">
                <div class="collection-header">
                    <img src="/ramaryselect/images/logo2.png" alt="RamarySelect" class="collection-logo">
                    <h1 class="collection-title">Add Wine Collection</h1>
                    <p class="collection-subtitle">Upload a new wine collection with brochure</p>
                </div>

                <?php if ($success_message): ?>
                    <div class="alert alert-success">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        <?php echo htmlspecialchars($success_message); ?>
                    </div>
                <?php endif; ?>

                <?php if ($error_message): ?>
                    <div class="alert alert-error">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15h2v-2h-2v2zm0-4h2V7h-2v6z"/>
                        </svg>
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data" class="collection-form">
                    <div class="collection-form-grid">
                        <!-- Left Column - Form Fields -->
                        <div class="collection-form-left">
                            <div class="form-group">
                                <label for="name">Collection Name</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="<?php echo htmlspecialchars($name ?? ''); ?>"
                                    placeholder="e.g., Premium Red Wines"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea 
                                    id="description" 
                                    name="description" 
                                    rows="6"
                                    placeholder="Describe this wine collection..."
                                ><?php echo htmlspecialchars($description ?? ''); ?></textarea>
                            </div>
                        </div>

                        <!-- Right Column - Image & PDF Upload -->
                        <div class="collection-form-right">
                            <div class="form-group">
                                <label for="image">Collection Image</label>
                                <input 
                                    type="file" 
                                    id="image" 
                                    name="image" 
                                    accept="image/jpeg,image/png,image/gif,image/webp"
                                >
                                <small class="form-help">JPG, PNG, GIF, or WebP. Max 5MB.</small>
                            </div>

                            <div class="form-group">
                                <label for="pdf">Collection Brochure (PDF)</label>
                                <div class="pdf-upload-area">
                                    <input 
                                        type="file" 
                                        id="pdf" 
                                        name="pdf" 
                                        accept="application/pdf"
                                        class="pdf-input"
                                    >
                                    <div class="pdf-upload-placeholder">
                                        <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                        </svg>
                                        <p class="pdf-placeholder-text">
                                            <strong>Click to upload PDF brochure</strong><br>
                                            <span>or drag and drop</span>
                                        </p>
                                        <small class="pdf-help">PDF files only. Max 10MB.</small>
                                    </div>
                                    <div class="pdf-file-info" style="display: none;">
                                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                        </svg>
                                        <span class="pdf-filename"></span>
                                        <button type="button" class="pdf-remove">×</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="collection-submit">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                        </svg>
                        Add Collection
                    </button>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>

    <script>
        // PDF Upload Handler
        const pdfInput = document.getElementById('pdf');
        const pdfPlaceholder = document.querySelector('.pdf-upload-placeholder');
        const pdfFileInfo = document.querySelector('.pdf-file-info');
        const pdfFilename = document.querySelector('.pdf-filename');
        const pdfRemove = document.querySelector('.pdf-remove');

        pdfInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                pdfFilename.textContent = file.name;
                pdfPlaceholder.style.display = 'none';
                pdfFileInfo.style.display = 'flex';
            }
        });

        pdfRemove.addEventListener('click', function() {
            pdfInput.value = '';
            pdfPlaceholder.style.display = 'block';
            pdfFileInfo.style.display = 'none';
        });

        // Drag and drop functionality
        const pdfUploadArea = document.querySelector('.pdf-upload-area');

        pdfUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            pdfUploadArea.classList.add('dragover');
        });

        pdfUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            pdfUploadArea.classList.remove('dragover');
        });

        pdfUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            pdfUploadArea.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0 && files[0].type === 'application/pdf') {
                pdfInput.files = files;
                pdfInput.dispatchEvent(new Event('change'));
            }
        });
    </script>
</body>
</html> 