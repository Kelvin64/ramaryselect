<?php
require_once __DIR__ . '/php/includes/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - RamarySelect</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Header -->
    <?php include 'php/includes/header.php'; ?>

    <main>
        <!-- Contact Hero -->
        <div class="contact-hero"></div>

        <!-- Contact Section -->
        <section class="contact-section-alt">
            <div class="container">
                <div class="contact-card-alt">
                    <h1 class="contact-title">Get in Touch</h1>
                    <p class="contact-subtitle">Have questions about our wine distribution services? We'd love to hear from you.</p>

                    <div class="contact-info-row">
                        <div class="contact-info-card">
                            <span class="contact-icon">📞</span>
                            <span>+233-333-333-333</span>
                        </div>
                        <div class="contact-info-card">
                            <span class="contact-icon">✉️</span>
                            <span>info@ramaryselect.com</span>
                        </div>
                        <div class="contact-info-card">
                            <span class="contact-icon">📍</span>
                            <span>Accra, Ghana</span>
                        </div>
                    </div>

                    <form class="contact-form-alt">
                        <div class="form-col">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone">
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label for="company">Company Name</label>
                                <input type="text" id="company" name="company">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="contact-btn">Send Message</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include 'php/includes/footer.php'; ?>
</body>
</html> 