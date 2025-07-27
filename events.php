<?php
require_once __DIR__ . '/php/includes/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/ramaryselect/images/logo2.png">
    <title>Events - Ramary Select</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Header -->
    <?php include 'php/includes/header.php'; ?>

    <main>
        <!-- Events Hero Section -->
        <section class="events-hero">
            <div class="events-hero__overlay"></div>
            <div class="container">
                <div class="events-hero__content">
                    <h1 class="events-hero__title">Exceptional Wine Events</h1>
                    <p class="events-hero__subtitle">From intimate tastings to grand celebrations, we curate unforgettable wine experiences that bring people together around the finest selections.</p>
                    <a href="#contact-events" class="btn btn-primary events-hero__cta">Plan Your Event</a>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="section events-services">
            <div class="container">
                <h2 class="section-title">Our Event Services</h2>
                <p class="section-subtitle">We organize and source exceptional wine experiences for every occasion</p>
                <div class="services-grid">
                    <div class="service-card">
                        <div class="service-icon">
                            <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm3.5 6L12 10.5 8.5 8 12 5.5 15.5 8zM8.5 16L12 13.5 15.5 16 12 18.5 8.5 16z"/>
                            </svg>
                        </div>
                        <h3 class="service-title">Wine Tastings</h3>
                        <p class="service-description">Curated wine tasting experiences featuring premium selections from renowned vineyards, guided by expert sommeliers.</p>
                    </div>
                    
                    <div class="service-card">
                        <div class="service-icon">
                            <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
                            </svg>
                        </div>
                        <h3 class="service-title">Corporate Events</h3>
                        <p class="service-description">Elevate your business gatherings with sophisticated wine pairings and professional event management services.</p>
                    </div>
                    
                    <div class="service-card">
                        <div class="service-icon">
                            <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <h3 class="service-title">Private Celebrations</h3>
                        <p class="service-description">Make your special occasions unforgettable with personalized wine selections and intimate event coordination.</p>
                    </div>
                    
                    <div class="service-card">
                        <div class="service-icon">
                            <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 11H7v9a2 2 0 002 2h8a2 2 0 002-2V9H9v2zm3-6L10.5 3h3L12 5zm0 0l1.5 2h-3L12 5z"/>
                            </svg>
                        </div>
                        <h3 class="service-title">Educational Workshops</h3>
                        <p class="service-description">Learn about wine appreciation, food pairing, and viticulture through our comprehensive educational programs.</p>
                    </div>
                    
                    <div class="service-card">
                        <div class="service-icon">
                            <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <h3 class="service-title">Event Sourcing</h3>
                        <p class="service-description">We source and coordinate all aspects of your wine event, from venue selection to catering partnerships.</p>
                    </div>
                    
                    <div class="service-card">
                        <div class="service-icon">
                            <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2z"/>
                            </svg>
                        </div>
                        <h3 class="service-title">Custom Packages</h3>
                        <p class="service-description">Tailored event packages designed to meet your specific needs, budget, and vision for the perfect wine experience.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Event Types Section -->
        <section class="section event-types">
            <div class="container">
                <h2 class="section-title">Types of Events We Organize</h2>
                <div class="event-types-grid">
                    <div class="event-type-card">
                        <img src="images/wine7.jpg" alt="Wine Dinner" class="event-type-image">
                        <div class="event-type-content">
                            <h3 class="event-type-title">Wine Dinners</h3>
                            <p class="event-type-description">Multi-course dining experiences with carefully paired wines, featuring renowned chefs and premium selections.</p>
                        </div>
                    </div>
                    
                    <div class="event-type-card">
                        <img src="images/wine8.jpg" alt="Product Launch" class="event-type-image">
                        <div class="event-type-content">
                            <h3 class="event-type-title">Product Launches</h3>
                            <p class="event-type-description">Sophisticated launch events that showcase your brand alongside premium wine selections and elegant presentations.</p>
                        </div>
                    </div>
                    
                    <div class="event-type-card">
                        <img src="images/wine9.jpg" alt="Harvest Celebrations" class="event-type-image">
                        <div class="event-type-content">
                            <h3 class="event-type-title">Harvest Celebrations</h3>
                            <p class="event-type-description">Seasonal celebrations honoring the wine-making tradition with fresh harvests and vintage collections.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="section events-why-choose">
            <div class="events-why-choose__overlay"></div>
            <div class="container">
                <div class="events-why-choose__content">
                    <h2 class="section-title">Why Choose RamarySelect for Your Events?</h2>
                    <div class="benefits-grid">
                        <div class="benefit-item">
                            <h4>Expert Curation</h4>
                            <p>Our sommelier team carefully selects wines that perfectly complement your event theme and cuisine.</p>
                        </div>
                        <div class="benefit-item">
                            <h4>Global Network</h4>
                            <p>Access to premium wines from international distributors and exclusive vineyard partnerships.</p>
                        </div>
                        <div class="benefit-item">
                            <h4>Full-Service Planning</h4>
                            <p>From concept to execution, we handle every detail to ensure your event is flawless and memorable.</p>
                        </div>
                        <div class="benefit-item">
                            <h4>Competitive Pricing</h4>
                            <p>Direct relationships with producers allow us to offer exceptional value for premium event experiences.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonial Section -->
        <section class="section events-testimonial">
            <div class="container">
                <div class="testimonial-card events-testimonial-card">
                    <div class="testimonial-quote">
                        "RamarySelect transformed our annual corporate gala into an extraordinary wine journey. Their attention to detail and exquisite wine selections made it an unforgettable experience for all our clients and partners."
                    </div>
                    <div class="testimonial-author">Sarah Hammond</div>
                    <div class="testimonial-role">Event Director</div>
                    <img src="/ramaryselect/images/eventsimages.jpg" alt="Sarah Hammond" class="testimonial-photo" />
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="section events-contact" id="contact-events">
            <div class="container">
                <h2 class="section-title">Ready to Plan Your Event?</h2>
                <p class="section-subtitle">Let us create an unforgettable wine experience for your next gathering</p>
                
                <div class="events-contact-grid">
                    <div class="events-contact-info">
                        <h3>Get Started Today</h3>
                        <p>Contact our events team to discuss your vision and receive a personalized quote for your wine event.</p>
                        
                        <div class="contact-methods">
                            <div class="contact-method">
                                <span class="contact-icon">📞</span>
                                <div>
                                    <h4>Phone</h4>
                                    <p>+233-24-671-3326</p>
                                </div>
                            </div>
                            <div class="contact-method">
                                <span class="contact-icon">✉️</span>
                                <div>
                                    <h4>Email</h4>
                                    <p>events@ramaryselect.net</p>
                                </div>
                            </div>
                            <div class="contact-method">
                                <span class="contact-icon">📍</span>
                                <div>
                                    <h4>Location</h4>
                                    <p>Accra, Ghana</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="events-contact-form">
                        <form class="contact-form-modern" id="eventsForm">
                            <div class="form-group">
                                <label for="event-name">Your Name</label>
                                <input type="text" id="event-name" name="name" placeholder="John Doe" required>
                            </div>
                            <div class="form-group">
                                <label for="event-email">Email Address</label>
                                <input type="email" id="event-email" name="email" placeholder="you@example.com" required>
                            </div>
                            <div class="form-group">
                                <label for="event-type">Event Type</label>
                                <select id="event-type" name="event_type" required>
                                    <option value="">Select Event Type</option>
                                    <option value="wine-tasting">Wine Tasting</option>
                                    <option value="corporate">Corporate Event</option>
                                    <option value="private">Private Celebration</option>
                                    <option value="wedding">Wedding</option>
                                    <option value="product-launch">Product Launch</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="event-date">Preferred Date</label>
                                <input type="date" id="event-date" name="event_date">
                            </div>
                            <div class="form-group">
                                <label for="event-guests">Expected Guests</label>
                                <input type="number" id="event-guests" name="guests" placeholder="50" min="1">
                            </div>
                            <div class="form-group">
                                <label for="event-message">Event Details</label>
                                <textarea id="event-message" name="message" rows="4" placeholder="Tell us about your event vision, budget, and any special requirements..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" id="eventsSubmitBtn">Request Quote</button>
                            <div id="eventsFormMessage" style="display: none; margin-top: 1rem; padding: 1rem; border-radius: 0.5rem;"></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include 'php/includes/footer.php'; ?>

    <script>
        document.getElementById('eventsForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = this;
            const submitBtn = document.getElementById('eventsSubmitBtn');
            const messageDiv = document.getElementById('eventsFormMessage');
            
            // Disable submit button and show loading state
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';
            messageDiv.style.display = 'none';
            
            try {
                const formData = new FormData(form);
                
                const response = await fetch('/ramaryselect/php/events_form.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                // Show message
                messageDiv.style.display = 'block';
                messageDiv.style.backgroundColor = result.success ? '#d4edda' : '#f8d7da';
                messageDiv.style.color = result.success ? '#155724' : '#721c24';
                messageDiv.style.border = result.success ? '1px solid #c3e6cb' : '1px solid #f5c6cb';
                messageDiv.textContent = result.message;
                
                if (result.success) {
                    // Reset form on success
                    form.reset();
                }
                
            } catch (error) {
                console.error('Error:', error);
                messageDiv.style.display = 'block';
                messageDiv.style.backgroundColor = '#f8d7da';
                messageDiv.style.color = '#721c24';
                messageDiv.style.border = '1px solid #f5c6cb';
                messageDiv.textContent = 'An error occurred. Please try again or contact us directly at events@ramaryselect.net';
            } finally {
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = 'Request Quote';
            }
        });
    </script>
</body>
</html> 