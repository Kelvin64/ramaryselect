<?php
require_once __DIR__ . '/config/database.php';

header('Content-Type: application/json');

// // --- Temporary Debugging ---
// $log_file = __DIR__ . '/newsletter_debug.log';
// $log_message = "Timestamp: " . date('Y-m-d H:i:s') . "\n";
// $log_message .= "POST Data: " . print_r($_POST, true) . "\n";
// $email_from_post = trim($_POST['email'] ?? '');
// $log_message .= "Trimmed Email: " . $email_from_post . "\n";
// $log_message .= "Is Valid Email: " . (filter_var($email_from_post, FILTER_VALIDATE_EMAIL) ? 'Yes' : 'No') . "\n";
// $log_message .= "----------------------------------\n";
// file_put_contents($log_file, $log_message, FILE_APPEND);
// // --- End Debugging ---

$email = trim($_POST['email'] ?? '');

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please provide a valid email address.']);
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM subscriptions WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        echo json_encode(['success' => false, 'message' => 'This email is already subscribed.']);
        exit();
    }

    $stmt = $pdo->prepare("INSERT INTO subscriptions (email) VALUES (?)");
    $stmt->execute([$email]);

    echo json_encode(['success' => true, 'message' => 'Thank you for subscribing!']);

} catch (PDOException $e) {
    error_log("Newsletter subscription error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again later.']);
}
?> 