<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';

// Ensure user is admin
if (!isAdmin()) {
    header('Location: /ramaryselect/index.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $summary = $_POST['summary'] ?? '';
    $content = $_POST['content'] ?? '';
    $image = $_FILES['image'] ?? null;

    if (empty($title) || empty($summary) || empty($content)) {
        $error = 'Please fill in all required fields.';
    } elseif ($image && $image['error'] === UPLOAD_ERR_OK) {
        $target_dir = __DIR__ . '/../../images/blog/';
        $image_name = time() . '_' . basename($image['name']);
        $target_file = $target_dir . $image_name;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image
        $check = getimagesize($image['tmp_name']);
        if ($check === false) {
            $error = 'File is not an image.';
        } elseif (!in_array($image_file_type, ['jpg', 'png', 'jpeg', 'gif'])) {
            $error = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
        } elseif (!move_uploaded_file($image['tmp_name'], $target_file)) {
            $error = 'Sorry, there was an error uploading your file.';
        } else {
            $image_path = '/ramaryselect/images/blog/' . $image_name;
        }
    }

    if (empty($error)) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO blog_posts (title, summary, content, author_id, image_path) 
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([$title, $summary, $content, $_SESSION['user_id'], $image_path ?? null]);
            $success = 'Blog post added successfully!';
        } catch (PDOException $e) {
            $error = 'Database error: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Blog Post - RamarySelect</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <div class="admin-panel">
        <div class="container">
            <div class="admin-form-wrapper">
                <form method="POST" class="admin-form" enctype="multipart/form-data">
                    <h2>Add New Blog Post</h2>
                    
                    <?php if ($error): ?>
                        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="summary">Summary</label>
                        <textarea id="summary" name="summary" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea id="content" name="content" class="form-control" rows="10" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Featured Image</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Add Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <style>
        .admin-panel {
            padding: 2rem 0;
            background-color: #f8f9fa;
            min-height: calc(100vh - 72px);
        }
        
        .admin-form-wrapper {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .admin-form {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .admin-form h2 {
            color: var(--color-primary);
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 1.8rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #333;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.2s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 2px rgba(56, 131, 151, 0.1);
        }
        
        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }
        
        textarea#content.form-control {
            min-height: 300px;
        }
        
        input[type="file"].form-control {
            padding: 0.5rem;
            border: 1px dashed #ddd;
            background: #f8f9fa;
        }
        
        .form-actions {
            margin-top: 2rem;
            text-align: center;
        }
        
        .btn-primary {
            padding: 0.75rem 2rem;
            font-size: 1rem;
            font-weight: 500;
        }
        
        .error-message,
        .success-message {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 4px;
            text-align: center;
        }
        
        .error-message {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        
        .success-message {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
    </style>
</body>
</html> 