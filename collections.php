<?php
require_once __DIR__ . '/php/includes/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Wine Collections - RamarySelect</title>
  <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
  <style>
    .collections-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
      padding: 2rem 0;
    }

    .collection-card {
      background: #fff;
      border-radius: 1rem;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      display: flex;
      flex-direction: column;
    }

    .collection-card:hover {
      transform: translateY(-5px);
    }

    .collection-image {
      width: 100%;
      height: 280px;
      object-fit: cover;
    }

    .collection-content {
      padding: 1.5rem;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    .collection-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      color: var(--primary-color);
      margin-bottom: 1rem;
    }

    .collection-description {
      color: #666;
      line-height: 1.6;
      margin-bottom: 1.5rem;
      flex-grow: 1;
    }

    .download-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background-color: var(--accent-color);
      color: white;
      padding: 0.8rem 1.5rem;
      border-radius: 2rem;
      text-decoration: none;
      font-weight: 500;
      transition: background-color 0.3s ease;
      width: fit-content;
    }

    .download-btn:hover {
      background-color: #b4860f;
    }

    .download-btn svg {
      margin-left: 0.5rem;
      width: 20px;
      height: 20px;
    }

    .section-intro {
      text-align: center;
      max-width: 800px;
      margin: 0 auto;
      padding: 3rem 1rem;
    }

    .section-title {
      margin-bottom: 1.5rem;
    }

    .section-subtitle {
      color: #666;
      line-height: 1.6;
      font-size: 1.1rem;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <?php include 'php/includes/header.php'; ?>

  <main>
    <!-- Intro Section -->
    <section class="section-intro">
      <h1 class="section-title">Our Wine Collections</h1>
      <p class="section-subtitle">
        Get detailed information about each wine collection. Download brochures by section below.
      </p>
    </section>

    <!-- Collections Grid -->
    <section class="section">
      <div class="container">
        <div class="collections-grid">
          <!-- White Wines -->
          <div class="collection-card">
            <img src="images/wine1.jpg" alt="White Wines" class="collection-image">
            <div class="collection-content">
              <h2 class="collection-title">White Wines</h2>
              <p class="collection-description">
                Elegant, crisp, and refreshing. Explore our selection of premium white wines.
              </p>
              <a href="#" class="download-btn">
                Download Brochure
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 16l-6-6h4V4h4v6h4l-6 6zm-6 4h12v-2H6v2z"/>
                </svg>
              </a>
            </div>
          </div>

          <!-- Red Wines -->
          <div class="collection-card">
            <img src="images/wine4.jpg" alt="Red Wines" class="collection-image">
            <div class="collection-content">
              <h2 class="collection-title">Red Wines</h2>
              <p class="collection-description">
                Rich, bold, and full-bodied. Discover our curated red wine collection.
              </p>
              <a href="#" class="download-btn">
                Download Brochure
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 16l-6-6h4V4h4v6h4l-6 6zm-6 4h12v-2H6v2z"/>
                </svg>
              </a>
            </div>
          </div>

          <!-- Rosé Wines -->
          <div class="collection-card">
            <img src="images/wine3.jpg" alt="Rosé Wines" class="collection-image">
            <div class="collection-content">
              <h2 class="collection-title">Rosé Wines</h2>
              <p class="collection-description">
                Delicate, floral, and vibrant. Enjoy our handpicked rosé wines.
              </p>
              <a href="#" class="download-btn">
                Download Brochure
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 16l-6-6h4V4h4v6h4l-6 6zm-6 4h12v-2H6v2z"/>
                </svg>
              </a>
            </div>
          </div>

          <!-- Sparkling Wines -->
          <div class="collection-card">
            <img src="images/wine8.jpg" alt="Sparkling Wines" class="collection-image">
            <div class="collection-content">
              <h2 class="collection-title">Sparkling Wines</h2>
              <p class="collection-description">
                Celebrate with our selection of sparkling wines and champagnes.
              </p>
              <a href="#" class="download-btn">
                Download Brochure
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 16l-6-6h4V4h4v6h4l-6 6zm-6 4h12v-2H6v2z"/>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
    <?php include 'php/includes/footer.php'; ?>
</body>
</html> 