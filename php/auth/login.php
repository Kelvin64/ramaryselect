<?php
require_once '../config/database.php';
require_once '../includes/auth.php';

// If already logged in, redirect to home
if (isLoggedIn()) {
    header('Location: /ramaryselect/index.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Get redirect URL from session or default to home
    $redirect = $_SESSION['redirect_after_login'] ?? '/ramaryselect/index.php';
    unset($_SESSION['redirect_after_login']); // Clear the redirect URL

    if (empty($username) || empty($password)) {
        $error = 'Please fill in all fields';
    } else {
        try {
            $stmt = $pdo->prepare("
                SELECT u.*, r.name as role_name 
                FROM users u 
                JOIN roles r ON u.role_id = r.id 
                WHERE u.username = ?
            ");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                loginUser($user);
                header('Location: ' . $redirect);
                exit();
            } else {
                $error = 'Invalid username or password';
            }
        } catch (PDOException $e) {
            error_log("Login error: " . $e->getMessage());
            $error = 'Login failed. Please try again.';
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
    <title>Login - RamarySelect</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/components/auth.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="auth-page">
        <div class="auth-card">
            <div class="auth-card__logo">
                <img src="../../images/logo2.png" alt="RamarySelect Logo" />
            </div>
            <form method="POST" class="auth-form">
                <h2 class="auth-card__title">Login</h2>
                <?php if ($error): ?>
                    <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
                
                <div class="auth-card__footer">
                    <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="../../js/main.js"></script>
</body>
</html> 