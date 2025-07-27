<?php
require_once __DIR__ . '/php/includes/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/ramaryselect/images/logo2.png">
    <title>Contact Us - Ramary Select</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <style>
        /* Enhanced Contact Form Styling */
        .contact-page__form {
            background: #fff;
            padding: 2.5rem;
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: 0 auto;
        }

        .contact-form-modern {
            text-align: center;
        }

        .contact-form-modern .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .contact-form-modern label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.75rem;
            font-family: var(--font-headline);
            color: var(--color-primary-dark);
            font-size: 1rem;
            text-align: left;
        }

        .contact-form-modern input,
        .contact-form-modern textarea {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 0.95rem;
            font-family: var(--font-body);
            background: #f9fafb;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .contact-form-modern input:focus,
        .contact-form-modern textarea:focus {
            border-color: var(--color-primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(56, 131, 151, 0.1);
            background: #fff;
            transform: translateY(-1px);
        }

        .contact-form-modern textarea {
            resize: vertical;
            min-height: 120px;
        }

        .contact-form-modern button {
            width: 100%;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            background: var(--color-primary);
            color: white;
            border: none;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .contact-form-modern button:hover {
            background: var(--color-primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(56, 131, 151, 0.3);
        }

        .contact-form-modern button:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
        }

        /* Form message styling */
        #formMessage {
            text-align: center;
            font-weight: 500;
            border-radius: 0.75rem !important;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .contact-page__form {
                padding: 2rem 1.5rem;
                margin: 0 1rem;
                border-radius: 1rem;
            }

            .contact-page__title {
                font-size: 2rem;
            }

            .contact-page__subtitle {
                font-size: 1rem;
            }

            .contact-form-modern input,
            .contact-form-modern textarea {
                padding: 0.875rem 1rem;
                font-size: 0.9rem;
            }

            .contact-form-modern button {
                padding: 0.875rem 1.5rem;
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .contact-page__form {
                padding: 1.5rem 1rem;
                margin: 0 0.5rem;
            }

            .contact-form-modern input,
            .contact-form-modern textarea {
                padding: 0.75rem 0.875rem;
            }
        }
    </style>
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
                     <form class="contact-form-modern" id="contactForm">
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
                        <button type="submit" class="btn btn-primary" id="submitBtn">Send Message</button>
                        <div id="formMessage" style="display: none; margin-top: 1rem; padding: 1rem; border-radius: 0.5rem;"></div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include 'php/includes/footer.php'; ?>

    <script>
        document.getElementById('contactForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = this;
            const submitBtn = document.getElementById('submitBtn');
            const messageDiv = document.getElementById('formMessage');
            
            // Disable submit button and show loading state
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';
            messageDiv.style.display = 'none';
            
            try {
                const formData = new FormData(form);
                
                const response = await fetch('/ramaryselect/php/contact_form.php', {
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
                messageDiv.textContent = 'An error occurred. Please try again or contact us directly.';
            } finally {
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = 'Send Message';
            }
        });
    </script>
</body>
</html> 