<?php
require_once '../config/database.php';
require_once '../includes/auth.php';

// Require admin access
requireAdmin();

$error = '';
$post = null;

// Get post ID from URL
$post_id = $_GET['id'] ?? null;

if (!$post_id) {
    header('Location: blog.php');
    exit();
}

// Get post data
$stmt = $pdo->prepare("
    SELECT * FROM blog_posts 
    WHERE id = ? AND author_id = ?
");
$stmt->execute([$post_id, $_SESSION['user_id']]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    header('Location: blog.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $summary = $_POST['summary'] ?? '';

    if (empty($title) || empty($content) || empty($summary)) {
        $error = 'Please fill in all required fields';
    } else {
        try {
            $image_path = $post['image_path'];
            
            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = '../../uploads/blog/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                
                if (!in_array($file_extension, $allowed_extensions)) {
                    throw new Exception('Invalid file type. Only JPG, JPEG, PNG & GIF files are allowed.');
                }
                
                // Delete old image if exists
                if ($image_path && file_exists('../../' . $image_path)) {
                    unlink('../../' . $image_path);
                }
                
                $image_path = 'uploads/blog/' . uniqid() . '.' . $file_extension;
                move_uploaded_file($_FILES['image']['tmp_name'], '../../' . $image_path);
            }

            $stmt = $pdo->prepare("
                UPDATE blog_posts 
                SET title = ?, content = ?, summary = ?, image_path = ?
                WHERE id = ? AND author_id = ?
            ");
            $stmt->execute([$title, $content, $summary, $image_path, $post_id, $_SESSION['user_id']]);
            header('Location: blog.php?success=1');
            exit();
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - Admin</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/auth.css">
    <style>
        .edit-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
        .edit-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        textarea {
            min-height: 300px;
            resize: vertical;
        }
        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .current-image {
            max-width: 200px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .preview-image {
            max-width: 200px;
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="edit-container">
        <h1>Edit Post</h1>
        
        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="edit-form">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="<?php echo htmlspecialchars($post['title']); ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label for="summary">Summary (Short description for blog listing)</label>
                    <textarea id="summary" 
                              name="summary" 
                              required 
                              style="min-height: 100px;"><?php echo htmlspecialchars($post['summary']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="content" 
                              name="content" 
                              required><?php echo htmlspecialchars($post['content']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Featured Image</label>
                    <?php if ($post['image_path']): ?>
                        <div>
                            <p>Current image:</p>
                            <img src="/<?php echo htmlspecialchars($post['image_path']); ?>" 
                                 alt="Current featured image" 
                                 class="current-image">
                        </div>
                    <?php endif; ?>
                    <input type="file" 
                           id="image" 
                           name="image" 
                           accept="image/*"
                           onchange="previewImage(this)">
                    <img id="preview" class="preview-image">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update Post</button>
                    <a href="blog.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html> 