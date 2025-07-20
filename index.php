<?php
require_once __DIR__ . '/php/includes/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/ramaryselect/images/logo2.png">
    <title>Ramary Select - Wine & Spirits</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body>
    <!-- Header -->
    <?php include 'php/includes/header.php'; ?>

    <main>
        <!-- Hero Section -->
        <section class="hero" style="background-image: url('images/wine2bg.png');">
            <div class="hero__overlay"></div>
            <div class="hero__content">
                <h1 class="hero__title"><span class="hero__title--primary">Ramary</span> <span class="hero__title--thin">Select</span></h1>
                <p class="hero__subtitle">At Ramary Select, we connect international wine and beverage wholesalers with trusted regional distributors—concisely and efficiently.</p>
                <a href="contact.php" class="btn btn-primary hero__cta">Order Now</a>
            </div>
        </section>

        <!-- About Section -->
        <section class="section about">
            <div class="container about__container">
                <div class="about__content">
                    <h2 class="section-title">Global Connections. Local Distribution</h2>
                    <p class="about__text">Ramary Select is your dedicated partner in the global wine and spirits market. We specialize in bridging the gap between wholesale producers and local distributors, making connections across diverse markets while ensuring quality, compliance, and smooth transactions. Whether you seek premium wines, craft spirits, or specialty beverages, we make global distribution simple and efficient.</p>
                    <a href="about.php" class="btn about__cta">Learn More</a>
                </div>
                <div class="about__image">
                    <div class="about__image-oval">
                        <img src="images/sidepan.png" alt="Wine bottles" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Wine Cards Section -->
        <section class="section wine-cards-section">
            <div class="container">
                <div class="wine-section-header">
                    <h2 class="section-title">Explore a New World of Wine & Spirits</h2>
                    <?php if (isAdmin()): ?>
                        <a href="/ramaryselect/php/admin/add_wine.php" class="btn btn-secondary wine-admin-btn">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
                            </svg>
                            Add New Wine
                        </a>
                    <?php endif; ?>
                </div>
                <!-- Swiper -->
                <div class="swiper wine-swiper">
                    <div class="swiper-wrapper">
                        <!-- Wine cards will be dynamically added here by js/main.js -->
                    </div>
                    <!-- Navigation -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="section features">
            <div class="container">
                <h2 class="section-title">Why Choose Ramary Select?</h2>
                <p class="section-subtitle">We don't just make your wine, we make your day!</p>
                <div class="features__grid">
                    <!-- Feature cards will be added here -->
                </div>
            </div>
        </section>

        <!-- Trusted Partners Section -->
        <section class="section partners">
            <div class="container">
                <h2 class="section-title">Our Trusted Partner</h2>
                <p class="section-subtitle">At Ramary Select, we take pride in our strong relationships with some of the world's most renowned wine and spirit producers.</p>
                <div class="partners__grid">
                    <!-- Partner logos will be added here -->
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="section testimonials">
            <div class="container">
                <h2 class="section-title">Our perfection feedback</h2>
                <p class="section-subtitle">Our customers' lives are amazing thanks to us</p>
                <div class="testimonial-card">
                    <div class="testimonial-quote">
                        As someone who loves hosting dinner parties, having premium wines delivered right to my door is a game changer. The tasting notes and pairing suggestions make me look like a pro — my guests are always impressed!
                    </div>
                    <div class="testimonial-author">Gilbert</div>
                    <div class="testimonial-role">Home Entertainer</div>
                    <img src="/ramaryselect/images/gilbert.jpg" alt="Kelvin Sample" class="testimonial-photo" />
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="section newsletter">
            <div class="newsletter__overlay"></div>
            <div class="newsletter__container">
                <h2 class="newsletter__title">Subscribe to get the Latest News</h2>
                <p class="newsletter__subtitle">Don't miss out on our latest news, updates, tips and special offers.</p>
                <form class="newsletter__form">
                    <input type="email" required placeholder="Enter your mail" class="newsletter__input" />
                    <button type="submit" class="btn">Subscribe</button>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include 'php/includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html> 