<?php
require_once 'php/config/database.php';
require_once 'php/includes/auth.php';

// Function to fix image paths
function get_image_path($path) {
    if (empty($path)) {
        return '';
    }
    // If the path does not already start with /ramaryselect/, prepend it.
    if (strpos($path, '/ramaryselect/') !== 0) {
        return '/ramaryselect' . $path;
    }
    return $path;
}

// Get search query if exists
$search = $_GET['search'] ?? '';

// Get the current post ID if viewing a single post
$post_id = $_GET['post'] ?? null;

// If viewing a single post, require login
if ($post_id && !isLoggedIn()) {
    header('Location: php/auth/login.php?redirect=' . urlencode($_SERVER['REQUEST_URI']));
    exit();
}

// Get posts based on context
if ($post_id) {
    // Get single post for logged-in user
    $stmt = $pdo->prepare("
        SELECT p.*, u.username 
        FROM blog_posts p 
        JOIN users u ON p.author_id = u.id 
        WHERE p.id = ?
    ");
    $stmt->execute([$post_id]);
    $current_post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$current_post) {
        header('Location: blog.php');
        exit();
    }

    // Get other posts for carousel
    $stmt = $pdo->prepare("
        SELECT p.*, u.username 
        FROM blog_posts p 
        JOIN users u ON p.author_id = u.id 
        WHERE p.id != ?
        ORDER BY p.created_at DESC 
        LIMIT 6
    ");
    $stmt->execute([$post_id]);
    $other_posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Get latest 6 posts for blog listing
    $query = "
        SELECT p.*, u.username 
        FROM blog_posts p 
        JOIN users u ON p.author_id = u.id 
    ";
    $params = [];
    
    if ($search) {
        $query .= " WHERE p.title LIKE ? OR p.summary LIKE ? OR p.content LIKE ?";
        $searchTerm = "%$search%";
        $params = [$searchTerm, $searchTerm, $searchTerm];
    }
    
    $query .= " ORDER BY p.created_at DESC LIMIT 6";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $post_id ? htmlspecialchars($current_post['title']) . ' - ' : ''; ?>Blog - RamarySelect</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Header -->
    <?php include 'php/includes/header.php'; ?>

    <main class="blog-page-container">
        <?php if ($post_id): ?>
            <div class="blog-main-content">
                <!-- Single Post View -->
                <article class="single-post">
                    <?php if ($current_post['image_path']): ?>
                        <img src="<?php echo htmlspecialchars(get_image_path($current_post['image_path'])); ?>" 
                             alt="<?php echo htmlspecialchars($current_post['title']); ?>" 
                             class="single-post__image">
                    <?php endif; ?>
                    
                    <h1 class="single-post__title"><?php echo htmlspecialchars($current_post['title']); ?></h1>
                    
                    <div class="single-post__meta">
                        By <strong><?php echo htmlspecialchars($current_post['username']); ?></strong> on 
                        <?php echo date('F j, Y', strtotime($current_post['created_at'])); ?>
                    </div>
                    
                    <div class="single-post__content">
                        <?php echo nl2br(htmlspecialchars($current_post['content'])); ?>
                    </div>
                </article>

                <!-- Other Posts Sidebar -->
                <?php if (!empty($other_posts)): ?>
                    <aside class="related-posts">
                        <h2 class="related-posts__title">More Wine Stories</h2>
                        <div class="related-posts__grid">
                            <?php foreach ($other_posts as $post): ?>
                                <div class="blog-card">
                                    <?php if ($post['image_path']): ?>
                                        <a href="?post=<?php echo $post['id']; ?>">
                                            <img src="<?php echo htmlspecialchars(get_image_path($post['image_path'])); ?>" 
                                                 alt="<?php echo htmlspecialchars($post['title']); ?>" 
                                                 class="blog-card__image">
                                        </a>
                                    <?php endif; ?>
                                    <div class="blog-card__content">
                                        <h3 class="blog-card__title">
                                            <a href="?post=<?php echo $post['id']; ?>"><?php echo htmlspecialchars($post['title']); ?></a>
                                        </h3>
                                        <div class="blog-card__meta">
                                            <?php echo date('F j, Y', strtotime($post['created_at'])); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </aside>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <!-- Blog Listing -->
            <div class="search-container">
                <form method="GET" action="">
                    <input type="text" 
                           name="search" 
                           placeholder="Search for articles, news, and stories..." 
                           value="<?php echo htmlspecialchars($search); ?>"
                           class="search-input">
                </form>
            </div>

            <div class="blog-grid">
                <?php foreach ($posts as $post): ?>
                    <div class="blog-card">
                        <?php if ($post['image_path']): ?>
                             <a href="?post=<?php echo $post['id']; ?>">
                                <img src="<?php echo htmlspecialchars(get_image_path($post['image_path'])); ?>" 
                                     alt="<?php echo htmlspecialchars($post['title']); ?>" 
                                     class="blog-card__image">
                             </a>
                        <?php endif; ?>
                        <div class="blog-card__content">
                            <h2 class="blog-card__title">
                                <a href="?post=<?php echo $post['id']; ?>"><?php echo htmlspecialchars($post['title']); ?></a>
                            </h2>
                            <div class="blog-card__meta">
                                By <strong><?php echo htmlspecialchars($post['username']); ?></strong> on 
                                <?php echo date('F j, Y', strtotime($post['created_at'])); ?>
                            </div>
                            <p class="blog-card__summary"><?php echo htmlspecialchars($post['summary']); ?></p>
                            <a href="?post=<?php echo $post['id']; ?>" class="btn btn-secondary">Read More</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <?php include 'php/includes/footer.php'; ?>
</body>
</html> 