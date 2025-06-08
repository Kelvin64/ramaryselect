<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

function requireLogin() {
    if (!isLoggedIn()) {
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
        header('Location: /ramaryselect/php/auth/login.php');
        exit();
    }
}

function requireAdmin() {
    requireLogin();
    if (!isAdmin()) {
        header('Location: /ramaryselect/index.php');
        exit();
    }
}

function loginUser($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['user_role'] = $user['role_name'];
}

function logoutUser() {
    session_destroy();
    header('Location: /ramaryselect/index.php');
    exit();
}

function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    require_once __DIR__ . '/../config/database.php';
    
    try {
        $stmt = $pdo->prepare("
            SELECT u.*, r.name as role_name 
            FROM users u 
            JOIN roles r ON u.role_id = r.id 
            WHERE u.id = ?
        ");
        $stmt->execute([$_SESSION['user_id']]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return null;
    }
}

// Only check authentication for specific paths that require it
$current_path = $_SERVER['PHP_SELF'];
$protected_paths = [
    '/admin/',
    '/dashboard/',
    '/profile/',
    '/orders/'
];

foreach ($protected_paths as $path) {
    if (strpos($current_path, $path) !== false) {
        requireLogin();
        break;
    }
}
?> 