<?php
require_once '../config/database.php';
require_once '../includes/auth.php';

// Require admin access
requireAdmin();

$error = '';
$success = '';

// Handle post creation/editing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $summary = $_POST['summary'] ?? '';
    $post_id = $_POST['post_id'] ?? null;

    if (empty($title) || empty($content) || empty($summary)) {
        $error = 'Please fill in all required fields';
    } else {
        try {
            $image_path = null;
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
                
                $image_path = 'uploads/blog/' . uniqid() . '.' . $file_extension;
                move_uploaded_file($_FILES['image']['tmp_name'], '../../' . $image_path);
            }

            if ($post_id) {
                // Update existing post
                $stmt = $pdo->prepare("
                    UPDATE blog_posts 
                    SET title = ?, content = ?, summary = ?" . ($image_path ? ", image_path = ?" : "") . "
                    WHERE id = ? AND author_id = ?
                ");
                $params = [$title, $content, $summary];
                if ($image_path) {
                    $params[] = $image_path;
                }
                $params[] = $post_id;
                $params[] = $_SESSION['user_id'];
                $stmt->execute($params);
                $success = 'Post updated successfully';
            } else {
                // Create new post
                $stmt = $pdo->prepare("
                    INSERT INTO blog_posts (title, content, summary, image_path, author_id) 
                    VALUES (?, ?, ?, ?, ?)
                ");
                $stmt->execute([$title, $content, $summary, $image_path, $_SESSION['user_id']]);
                $success = 'Post created successfully';
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}

// Handle post deletion
if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    try {
        // Get the image path before deleting
        $stmt = $pdo->prepare("SELECT image_path FROM blog_posts WHERE id = ? AND author_id = ?");
        $stmt->execute([$post_id, $_SESSION['user_id']]);
        $post = $stmt->fetch();
        
        if ($post && $post['image_path']) {
            $full_path = '../../' . $post['image_path'];
            if (file_exists($full_path)) {
                unlink($full_path);
            }
        }
        
        $stmt = $pdo->prepare("DELETE FROM blog_posts WHERE id = ? AND author_id = ?");
        $stmt->execute([$post_id, $_SESSION['user_id']]);
        $success = 'Post deleted successfully';
    } catch (PDOException $e) {
        $error = 'Failed to delete post';
    }
}

// Get all posts
$stmt = $pdo->prepare("
    SELECT p.*, u.username 
    FROM blog_posts p 
    JOIN users u ON p.author_id = u.id 
    ORDER BY p.created_at DESC
");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blog Posts - Admin</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/auth.css">
    <style>
        .admin-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        .post-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .post-list {
            display: grid;
            gap: 20px;
        }
        .post-item {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .post-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        .post-actions a {
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
        }
        .edit-btn {
            background: #4a90e2;
        }
        .delete-btn {
            background: #dc3545;
        }
        textarea {
            min-height: 200px;
            resize: vertical;
        }
        .post-image {
            max-width: 200px;
            height: auto;
            margin-top: 10px;
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
    <div class="admin-container">
        <h1>Manage Blog Posts</h1>
        
        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <div class="post-form">
            <h2>Create New Post</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="summary">Summary (Short description for blog listing)</label>
                    <textarea id="summary" name="summary" required style="min-height: 100px;"></textarea>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="content" name="content" required></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Featured Image</label>
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                    <img id="preview" class="preview-image">
                </div>

                <button type="submit" class="btn btn-primary">Publish Post</button>
            </form>
        </div>

        <div class="post-list">
            <h2>Existing Posts</h2>
            <?php foreach ($posts as $post): ?>
                <div class="post-item">
                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                    <p class="post-meta">
                        By <?php echo htmlspecialchars($post['username']); ?> on 
                        <?php echo date('F j, Y', strtotime($post['created_at'])); ?>
                    </p>
                    <?php if ($post['image_path']): ?>
                        <img src="/<?php echo htmlspecialchars($post['image_path']); ?>" alt="Post image" class="post-image">
                    <?php endif; ?>
                    <div class="post-content">
                        <strong>Summary:</strong>
                        <p><?php echo nl2br(htmlspecialchars($post['summary'])); ?></p>
                        <strong>Content Preview:</strong>
                        <p><?php echo nl2br(htmlspecialchars(substr($post['content'], 0, 200))); ?>...</p>
                    </div>
                    <div class="post-actions">
                        <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="edit-btn">Edit</a>
                        <a href="?delete=<?php echo $post['id']; ?>" 
                           class="delete-btn" 
                           onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
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