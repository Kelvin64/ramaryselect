<?php
require_once __DIR__ . '/php/includes/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/ramaryselect/images/logo2.png">
    <title>About Us - RamarySelect</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <style>
        /* Enhanced Wine Categories Responsive Styles */
        .about-categories__images {
            display: flex !important;
            flex-direction: row !important;
            gap: 1rem !important;
            margin-bottom: 2rem !important;
            justify-content: flex-start !important;
            flex-wrap: wrap !important;
        }
        
        .about-categories__images img {
            border-radius: 1rem !important;
            box-shadow: 0 4px 20px rgba(52, 152, 219, 0.12), 0 2px 6px rgba(0, 0, 0, 0.04) !important;
            width: 160px !important;
            height: 220px !important;
            object-fit: cover !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease !important;
            flex-shrink: 0 !important;
            max-width: 100% !important;
        }
        
        .about-categories__images img:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 6px 25px rgba(52, 152, 219, 0.18), 0 3px 8px rgba(0, 0, 0, 0.06) !important;
        }
        
        /* Responsive breakpoints with !important */
        @media (max-width: 992px) {
            .about-categories__container {
                flex-direction: column !important;
                text-align: center !important;
            }
            
            .about-categories__images {
                flex-direction: row !important;
                justify-content: center !important;
                flex-wrap: wrap !important;
                gap: 1.2rem !important;
                margin-bottom: 2rem !important;
            }
            
            .about-categories__images img {
                width: 150px !important;
                height: 210px !important;
                max-width: 100% !important;
                flex-shrink: 0 !important;
            }
        }
        
        @media (max-width: 768px) {
            .about-categories__images {
                display: none !important;
            }
            
            .about-categories__content {
                text-align: center !important;
                max-width: 100% !important;
            }
        }
        
        /* Ensure container has proper responsive behavior */
        .about-categories {
            background: #fff !important;
            padding: 4rem 0 !important;
        }
        
        .about-categories__container {
            display: flex !important;
            align-items: flex-start !important;
            gap: 4rem !important;
        }
        
        .about-categories__content {
            flex: 1 1 0 !important;
            max-width: 540px !important;
        }
        
        @media (max-width: 992px) {
            .about-categories {
                padding: 3rem 0 !important;
            }
            
            .about-categories__container {
                gap: 2rem !important;
            }
        }
        
        @media (max-width: 768px) {
            .about-categories {
                padding: 2.5rem 0 !important;
            }
            
            .about-categories__container {
                gap: 1.5rem !important;
            }
        }
        
        @media (max-width: 576px) {
            .about-categories {
                padding: 2rem 0 !important;
            }
            
            .about-categories__container {
                gap: 1rem !important;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include 'php/includes/header.php'; ?>

    <main>
        <!-- About Hero Section -->
        <section class="about-hero">
            <div class="container about-hero__container">
                <div class="about-hero__content">
                    <h1 class="section-title">About RamarySelect</h1>
                    <p>
                        RamarySelect is your dedicated partner in the global wine and spirits trade. We specialize in bridging the gap between wholesale producers and local distributors, enabling access to diverse markets while ensuring quality, compliance, and smooth logistics. Whether you're sourcing premium wines, craft spirits, or specialty beverages, we make global distribution simple and strategic.
                    </p>
                    <a href="/ramaryselect/blog.php" class="btn btn-primary">Our Blog</a>
                </div>
                <div class="about-hero__image">
                    <img src="/ramaryselect/images/sidepan.png" alt="Wine bottles" />
                </div>
            </div>
        </section>

        <!-- Wine Categories Section -->
        <section class="about-categories">
            <div class="container about-categories__container">
                <div class="about-categories__images">
                    <img src="images/wine1.jpg" alt="Pinot Grigio" />
                    <img src="images/sidepan.png" alt="Wine Bottles" />
                    <img src="images/wine3.jpg" alt="Wine Cellar" />
                </div>
                <div class="about-categories__content">
                    <h2 class="section-title">Wine Categories</h2>
                    <p>
                        RamarySelect is your dedicated partner in the global wine and spirits trade. We specialize in bridging the gap between wholesale producers and local distributors, enabling access to diverse markets while ensuring quality, compliance, and smooth logistics. Whether you're sourcing premium wines, craft spirits, or specialty beverages, we make global distribution simple and strategic.
                    </p>
                    <a href="collections.php" class="btn btn-primary">Download Brochure</a>
                </div>
            </div>
        </section>

        <!-- Partners Section -->
        <section class="about-partners">
            <div class="about-partners__overlay"></div>
            <div class="container about-partners__container">
                <h2 class="section-title">Our Trusted Partners</h2>
                <p class="section-subtitle">
                    At RamarySelect, we take pride in our strong relationships with some of the world's most renowned wine and spirit producers. Our partners are at the heart of our mission—bringing premium selections to Ghana through a seamless distribution network.
                </p>
                <a href="contact.php" class="btn btn-primary">Join Us</a>
            </div>
        </section>

        <!-- Services Section -->
        <section class="about-services">
            <div class="container">
                <h2 class="section-title">Our Services</h2>
                <p class="section-subtitle">What services we offer</p>
                <div class="about-services__grid">
                    <div class="service-card">
                        <img src="images/wine13.jpg" alt="Delivery Services" />
                        <h3>Delivery Services</h3>
                        <p>We deliver your order on your request on time always.</p>
                    </div>
                    <div class="service-card">
                        <img src="images/wine7.jpg" alt="Wine Warehousing" />
                        <h3>Wine Warehousing</h3>
                        <p>We offer affordable warehousing solutions for your wine and spirits.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Recent Updates Section -->
        <section class="about-updates">
            <div class="container">
                <h2 class="section-title">Our recent Updates</h2>
                <p class="section-subtitle">Explore a New World of Wine & Spirits</p>
                <div class="about-updates__grid">
                    <div class="update-card">
                        <img src="images/wine15.jpg" alt="Healthy ingredients found wine" />
                        <h3>Healthy ingredients found wine</h3>
                        <p>Here are some of the healthy ingredients found in wine.</p>
                        <a href="blog.php" class="btn btn-secondary">Read more</a>
                    </div>
                    <div class="update-card">
                        <img src="images/wine14.jpg" alt="Processes for wine making" />
                        <h3>Processes for wine making</h3>
                        <p>At RamarySelect, we offer innovative technologies and efficient processes to connect renowned wine and spirit producers.</p>
                        <a href="blog.php" class="btn btn-secondary">Read more</a>
                    </div>
                    <div class="update-card">
                        <img src="images/wine16.jpg" alt="Stakeholders in wine production" />
                        <h3>Stakeholders in wine production</h3>
                        <p>At RamarySelect, we create new relationships with the world's most renowned wine and spirit producers.</p>
                        <a href="blog.php" class="btn btn-secondary">Read more</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="newsletter">
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
</body>
</html> 