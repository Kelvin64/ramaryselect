<?php
// Contact Form Handler
header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get form data
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validate required fields
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address']);
    exit;
}

// Sanitize inputs
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$subject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

// Email configuration
$to = 'info@ramaryselect.net'; // Change this to your actual email
$from = 'noreply@ramaryselect.net';
$reply_to = $email;

// Email headers
$headers = array(
    'From: ' . $from,
    'Reply-To: ' . $reply_to,
    'X-Mailer: PHP/' . phpversion(),
    'Content-Type: text/html; charset=UTF-8'
);

// Email subject
$email_subject = "New Contact Form Submission: " . $subject;

// Email body
$email_body = "
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #388397; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #388397; }
        .value { margin-left: 10px; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h2>New Contact Form Submission</h2>
        </div>
        <div class='content'>
            <div class='field'>
                <span class='label'>Name:</span>
                <span class='value'>$name</span>
            </div>
            <div class='field'>
                <span class='label'>Email:</span>
                <span class='value'>$email</span>
            </div>
            <div class='field'>
                <span class='label'>Subject:</span>
                <span class='value'>$subject</span>
            </div>
            <div class='field'>
                <span class='label'>Message:</span>
                <div class='value' style='margin-top: 10px; white-space: pre-wrap;'>$message</div>
            </div>
            <div class='field' style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;'>
                <small>This message was sent from the RamarySelect contact form on " . date('Y-m-d H:i:s') . "</small>
            </div>
        </div>
    </div>
</body>
</html>
";

// Send email
$mail_sent = mail($to, $email_subject, $email_body, implode("\r\n", $headers));

if ($mail_sent) {
    // Log successful submission
    error_log("Contact form submitted successfully from: $email");
    
    echo json_encode([
        'success' => true, 
        'message' => 'Thank you for your message! We will get back to you soon.'
    ]);
} else {
    // Log error
    error_log("Failed to send contact form email from: $email");
    
    echo json_encode([
        'success' => false, 
        'message' => 'Sorry, there was an error sending your message. Please try again or contact us directly.'
    ]);
}
?> 