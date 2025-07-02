<?php
require_once __DIR__ . '/php/includes/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/ramaryselect/images/logo2.png">
    <title>Contact Us - RamarySelect</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Header -->
    <?php include 'php/includes/header.php'; ?>

    <main>
        <section class="contact-page">
            <div class="contact-page__hero">
                <div class="contact-page__hero-overlay"></div>
                <div class="container">
                    <h1 class="contact-page__title">Contact Us</h1>
                    <p class="contact-page__subtitle">We're here to help. Reach out to us with any questions or inquiries.</p>
                </div>
            </div>

            <div class="contact-page__content container">
                <div class="contact-page__info">
                    <h2 class="section-title">Get in Touch</h2>
                    <p class="section-subtitle">We'd love to hear from you. Here's how you can reach us.</p>
                    
                    <div class="contact-info-group">
                        <div class="contact-info-item">
                            <span class="contact-info-icon">📞</span>
                            <div>
                                <h4>Phone</h4>
                                <p>+233-24-671-3326</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <span class="contact-info-icon">✉️</span>
                             <div>
                                <h4>Email</h4>
                                <p>info@ramaryselect.net</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <span class="contact-info-icon">📍</span>
                             <div>
                                <h4>Location</h4>
                                <p>Accra, Ghana</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-map">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3970.3976103862547!2d-0.3158936241319496!3d5.655486132639454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdf990cb2ec5a57%3A0xa5758d6187d55a50!2sRamary%20Select!5e0!3m2!1sen!2sgh!4v1751451491649!5m2!1sen!2sgh" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                </div>

                <div class="contact-page__form">
                     <form class="contact-form-modern">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" placeholder="John Doe" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="you@example.com" required>
                        </div>
                         <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" placeholder="Your reason for contacting" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5" placeholder="Your message..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include 'php/includes/footer.php'; ?>
</body>
</html> 