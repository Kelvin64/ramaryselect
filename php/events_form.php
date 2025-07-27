<?php
// Events Form Handler
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
$event_type = trim($_POST['event_type'] ?? '');
$event_date = trim($_POST['event_date'] ?? '');
$guests = trim($_POST['guests'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validate required fields
if (empty($name) || empty($email) || empty($event_type) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Name, email, event type, and message are required']);
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
$event_type = htmlspecialchars($event_type, ENT_QUOTES, 'UTF-8');
$event_date = htmlspecialchars($event_date, ENT_QUOTES, 'UTF-8');
$guests = htmlspecialchars($guests, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

// Email configuration
$to = 'events@ramaryselect.net'; // Change this to your actual events email
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
$email_subject = "New Event Inquiry: " . ucfirst(str_replace('-', ' ', $event_type));

// Format event type for display
$event_type_display = ucwords(str_replace('-', ' ', $event_type));

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
        .highlight { background: #e8f4f8; padding: 10px; border-left: 4px solid #388397; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h2>New Event Inquiry</h2>
        </div>
        <div class='content'>
            <div class='field'>
                <span class='label'>Contact Name:</span>
                <span class='value'>$name</span>
            </div>
            <div class='field'>
                <span class='label'>Email:</span>
                <span class='value'>$email</span>
            </div>
            <div class='field highlight'>
                <span class='label'>Event Type:</span>
                <span class='value'>$event_type_display</span>
            </div>
            <div class='field'>
                <span class='label'>Preferred Date:</span>
                <span class='value'>" . ($event_date ? date('F j, Y', strtotime($event_date)) : 'Not specified') . "</span>
            </div>
            <div class='field'>
                <span class='label'>Expected Guests:</span>
                <span class='value'>" . ($guests ? $guests : 'Not specified') . "</span>
            </div>
            <div class='field'>
                <span class='label'>Event Details:</span>
                <div class='value' style='margin-top: 10px; white-space: pre-wrap;'>$message</div>
            </div>
            <div class='field' style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;'>
                <small>This inquiry was submitted from the RamarySelect events form on " . date('Y-m-d H:i:s') . "</small>
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
    error_log("Events form submitted successfully from: $email for event type: $event_type");
    
    echo json_encode([
        'success' => true, 
        'message' => 'Thank you for your event inquiry! Our events team will contact you within 24 hours to discuss your requirements.'
    ]);
} else {
    // Log error
    error_log("Failed to send events form email from: $email");
    
    echo json_encode([
        'success' => false, 
        'message' => 'Sorry, there was an error sending your inquiry. Please try again or contact us directly at events@ramaryselect.net'
    ]);
}
?> 