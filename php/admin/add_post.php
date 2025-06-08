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
    <link rel="stylesheet" href="../../css/auth.css">
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <div class="auth-bg">
        <div class="auth-container auth-container--wide">
            <form method="POST" class="auth-form" enctype="multipart/form-data">
                <h2>Add New Blog Post</h2>
                <?php if ($error): ?>
                    <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="summary">Summary</label>
                    <textarea id="summary" name="summary" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="content" name="content" rows="10" required></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Featured Image</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Add Post</button>
            </form>
        </div>
    </div>
</body>
</html>
<style>
    .form-group textarea {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1px solid var(--color-border);
        border-radius: var(--border-radius-md);
        font-size: 1rem;
        transition: border-color var(--transition-fast);
        resize: vertical;
    }
</style> 