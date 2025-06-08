<?php
require_once __DIR__ . '/auth.php';
?>
<header class="header">
  <div class="header__container container">
    <div class="header__logo">
      <a href="/ramaryselect/index.php">
        <img src="/ramaryselect/images/logo2.png" alt="Ramary Select">
      </a>
    </div>
    <nav class="header__nav">
      <a href="/ramaryselect/index.php" class="header__nav-link">Home</a>
      <a href="/ramaryselect/about.php" class="header__nav-link">About</a>
      <a href="/ramaryselect/contact.php" class="header__nav-link">Contact</a>
      <a href="/ramaryselect/blog.php" class="header__nav-link">Blog</a>
      <a href="/ramaryselect/collections.php" class="header__nav-link">Collections</a>
      <?php if (isAdmin()): ?>
        <a href="/ramaryselect/php/admin/add_post.php" class="header__nav-link">Add Post</a>
      <?php endif; ?>
    </nav>
    <div class="header__auth">
      <?php if (isLoggedIn()): ?>
        <span class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
        <a href="/ramaryselect/php/auth/logout.php" class="btn">Logout</a>
      <?php else: ?>
        <a href="/ramaryselect/php/auth/login.php" class="btn">Sign In</a>
      <?php endif; ?>
    </div>
    <button class="header__toggle" aria-label="Toggle navigation">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
</header>
<div class="mobile-nav">
  <nav>
    <a href="/ramaryselect/index.php" class="mobile-nav__link">Home</a>
    <a href="/ramaryselect/about.php" class="mobile-nav__link">About</a>
    <a href="/ramaryselect/contact.php" class="mobile-nav__link">Contact</a>
    <a href="/ramaryselect/blog.php" class="mobile-nav__link">Blog</a>
    <a href="/ramaryselect/collections.php" class="mobile-nav__link">Collections</a>
    <?php if (isAdmin()): ?>
      <a href="/ramaryselect/php/admin/add_post.php" class="mobile-nav__link">Add Post</a>
    <?php endif; ?>
     <?php if (isLoggedIn()): ?>
        <a href="/ramaryselect/php/auth/logout.php" class="btn">Logout</a>
      <?php else: ?>
        <a href="/ramaryselect/php/auth/login.php" class="btn">Sign In</a>
      <?php endif; ?>
  </nav>
</div> 