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
      <a href="/ramaryselect/events.php" class="header__nav-link">Events</a>
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

<!-- Secondary Admin Header -->
<?php if (isAdmin()): ?>
<div class="admin-header">
  <div class="admin-header__container container">
    <div class="admin-header__content">
      <span class="admin-header__label">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
        </svg>
        Admin Panel
      </span>
      <nav class="admin-header__nav">
        <a href="/ramaryselect/php/admin/add_post.php" class="admin-header__link">
          <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
          </svg>
          Add Post
        </a>
                 <a href="/ramaryselect/php/admin/add_wine.php" class="admin-header__link">
           <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
             <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
           </svg>
           Add Wine
         </a>
         <a href="/ramaryselect/php/admin/add_collection.php" class="admin-header__link">
           <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
             <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
           </svg>
           Add Collection
         </a>
      </nav>
    </div>
  </div>
</div>

<!-- Mobile Admin Menu -->
<div class="mobile-admin-nav">
  <div class="mobile-admin-nav__header">
    <span class="mobile-admin-nav__label">
      <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
      </svg>
      Admin Panel
    </span>
  </div>
  <nav class="mobile-admin-nav__links">
    <a href="/ramaryselect/php/admin/add_post.php" class="mobile-admin-nav__link">
      <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
      </svg>
      Add Post
    </a>
         <a href="/ramaryselect/php/admin/add_wine.php" class="mobile-admin-nav__link">
       <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
         <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
       </svg>
       Add Wine
     </a>
     <a href="/ramaryselect/php/admin/add_collection.php" class="mobile-admin-nav__link">
       <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
         <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
       </svg>
       Add Collection
     </a>
  </nav>
</div>
<?php endif; ?>
<div class="mobile-nav">
  <nav>
    <a href="/ramaryselect/index.php" class="mobile-nav__link">Home</a>
    <a href="/ramaryselect/about.php" class="mobile-nav__link">About</a>
    <a href="/ramaryselect/contact.php" class="mobile-nav__link">Contact</a>
    <a href="/ramaryselect/blog.php" class="mobile-nav__link">Blog</a>
    <a href="/ramaryselect/collections.php" class="mobile-nav__link">Collections</a>
    <a href="/ramaryselect/events.php" class="mobile-nav__link">Events</a>
     <?php if (isLoggedIn()): ?>
        <a href="/ramaryselect/php/auth/logout.php" class="btn">Logout</a>
      <?php else: ?>
        <a href="/ramaryselect/php/auth/login.php" class="btn">Sign In</a>
      <?php endif; ?>
  </nav>
</div> 