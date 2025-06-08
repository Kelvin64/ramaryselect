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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
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
                    
                    <div id="map" class="contact-map"></div>

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
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([5.6037, -0.1870], 13); // Centered on Accra

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([5.6037, -0.1870]).addTo(map)
                .bindPopup('RamarySelect, Accra, Ghana')
                .openPopup();
        });
    </script>
</body>
</html> 