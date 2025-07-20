<?php
require_once __DIR__ . '/php/includes/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="icon" type="image/x-icon" href="/ramaryselect/images/logo2.png">
  <title>Wine Collections - RamarySelect</title>
  <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
  <style>
    .collections-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 1.5rem;
      padding: 2rem 1rem;
      max-width: 1400px;
      margin: 0 auto;
    }

    .collection-card {
      background: #fff;
      border-radius: 1rem;
      overflow: hidden;
      box-shadow: 0 3px 15px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
      display: flex;
      flex-direction: column;
      min-height: 350px;
      height: auto;
      border: 1px solid #e8e8e8;
    }

    .collection-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
      border-color: var(--primary-color);
    }

    .collection-image {
      width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: 0;
    }

    .collection-content {
      padding: 1.3rem;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      flex-grow: 1;
      background: #fff;
      min-height: 160px;
    }

    .collection-info {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      margin-bottom: 1rem;
    }

    .collection-title {
      font-family: var(--font-primary);
      font-size: 1.35rem;
      color: var(--primary-color);
      margin-bottom: 0.7rem;
      line-height: 1.3;
      font-weight: 700;
    }

    .collection-subtitle {
      font-family: var(--font-primary);
      font-size: 1.8rem;
      margin-bottom: 2rem;
    }

    .collection-description {
      font-family: var(--font-primary);
      color: #666;
      line-height: 1.5;
      margin-bottom: 0.8rem;
      font-size: 0.9rem;
      flex-grow: 1;
    }

    .download-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
      color: white;
      padding: 0.8rem 1rem;
      border-radius: 1.5rem;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.8rem;
      transition: all 0.3s ease;
      width: calc(100% - 0.4rem);
      max-width: 100%;
      box-shadow: 0 3px 15px rgba(52, 152, 219, 0.3);
      flex-shrink: 0;
      border: none;
      letter-spacing: 0.2px;
      text-transform: uppercase;
      margin: 0 0.2rem;
      box-sizing: border-box;
    }

    .download-btn:hover {
      background: linear-gradient(135deg, #2980b9 0%, #1f4e79 100%);
      transform: translateY(-2px);
      box-shadow: 0 6px 25px rgba(52, 152, 219, 0.4);
      color: white;
    }

    .download-btn:active {
      transform: translateY(0);
      box-shadow: 0 2px 10px rgba(52, 152, 219, 0.3);
    }

    .download-btn svg {
      margin-left: 0.4rem;
      width: 16px;
      height: 16px;
      flex-shrink: 0;
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

    .loading-message,     .error-message {
      text-align: center;
      padding: 3rem;
      color: #666;
    }

    /* Online Brochure Section Styles */
    .online-brochure-section {
      padding: 3rem 0;
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      border-top: 1px solid #e8e8e8;
      border-bottom: 1px solid #e8e8e8;
    }

    .brochure-card {
      background: #fff;
      border-radius: 1.5rem;
      box-shadow: 0 8px 30px rgba(0,0,0,0.1);
      overflow: hidden;
      display: grid;
      grid-template-columns: 1fr 300px;
      gap: 0;
      max-width: 1000px;
      margin: 0 auto;
      border: 1px solid #e8e8e8;
    }

    .brochure-content {
      padding: 3rem 3rem 3rem 3rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .brochure-icon {
      font-size: 3rem;
      margin-bottom: 1.5rem;
      line-height: 1;
    }

    .brochure-title {
      font-family: 'Playfair Display', serif;
      font-size: 2.2rem;
      color: var(--primary-color);
      margin-bottom: 1rem;
      font-weight: 700;
      line-height: 1.2;
    }

    .brochure-description {
      color: #666;
      line-height: 1.6;
      margin-bottom: 2rem;
      font-size: 1.1rem;
    }

    .brochure-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, var(--color-primary) 0%, #2c6c7a 100%);
      color: white;
      padding: 1rem 2rem;
      border-radius: 2rem;
      text-decoration: none;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
      box-shadow: 0 4px 20px rgba(56, 131, 151, 0.3);
      border: none;
      width: fit-content;
      letter-spacing: 0.3px;
    }

    .brochure-btn:hover {
      background: linear-gradient(135deg, #2c6c7a 0%, #1f4e5a 100%);
      transform: translateY(-2px);
      box-shadow: 0 8px 30px rgba(56, 131, 151, 0.4);
      color: white;
    }

    .brochure-btn:active {
      transform: translateY(0);
    }

    .btn-text {
      margin-right: 0.8rem;
    }

    .btn-icon {
      width: 20px;
      height: 20px;
      transition: transform 0.3s ease;
    }

    .brochure-btn:hover .btn-icon {
      transform: translateX(3px);
    }

    .brochure-visual {
      background: linear-gradient(135deg, #388397 0%, #2c6c7a 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }

    .brochure-mockup {
      position: relative;
      width: 180px;
      height: 240px;
      perspective: 1000px;
      transform: rotateY(-10deg) rotateX(5deg);
    }

    .book-cover {
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
      border-radius: 8px;
      box-shadow: 0 15px 40px rgba(0,0,0,0.3);
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 2rem 1rem;
      border: 2px solid #e8e8e8;
    }

    .book-spine {
      position: absolute;
      left: -8px;
      top: 0;
      width: 16px;
      height: 100%;
      background: linear-gradient(135deg, #d4d6d8 0%, #bcc0c4 100%);
      border-radius: 4px 0 0 4px;
      box-shadow: inset 2px 0 4px rgba(0,0,0,0.1);
    }

    .book-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.2rem;
      font-weight: 700;
      color: var(--color-primary);
      text-align: center;
      margin-bottom: 0.5rem;
      line-height: 1.2;
    }

    .book-subtitle {
      font-size: 0.9rem;
      color: #666;
      text-align: center;
      font-weight: 500;
    }

    .download-btn.disabled {
      background: linear-gradient(135deg, #bdc3c7 0%, #95a5a6 100%);
      color: #7f8c8d;
      cursor: not-allowed;
      pointer-events: none;
      box-shadow: 0 2px 8px rgba(149, 165, 166, 0.2);
      transform: none;
      font-weight: 500;
    }

    .download-btn.disabled:hover {
      background: linear-gradient(135deg, #bdc3c7 0%, #95a5a6 100%);
      transform: none;
      box-shadow: 0 2px 8px rgba(149, 165, 166, 0.2);
      color: #7f8c8d;
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
      .collections-grid {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.3rem;
      }
      
      .brochure-card {
        grid-template-columns: 1fr 250px;
      }
      
      .brochure-content {
        padding: 2.5rem;
      }
      
      .brochure-title {
        font-size: 1.9rem;
      }
      
      .brochure-description {
        font-size: 1rem;
      }
      
      .brochure-mockup {
        width: 150px;
        height: 200px;
      }
      
      .book-title {
        font-size: 1rem;
      }
      
      .book-subtitle {
        font-size: 0.8rem;
      }
    }

    @media (max-width: 768px) {
      .collections-grid {
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.2rem;
        padding: 1.5rem 1rem;
      }
      
      .collection-card {
        min-height: 320px;
      }
      
      .collection-image {
        height: 140px;
      }
      
      .collection-content {
        padding: 1.2rem;
        min-height: 140px;
      }
      
      .collection-title {
        font-size: 1.2rem;
        margin-bottom: 0.6rem;
      }
      
      .collection-description {
        font-size: 0.85rem;
        margin-bottom: 0.8rem;
      }
      
      .download-btn {
        padding: 0.7rem 0.8rem;
        font-size: 0.75rem;
        border-radius: 1.3rem;
        width: calc(100% - 0.6rem);
        margin: 0 0.3rem;
      }
      
      .online-brochure-section {
        padding: 2rem 0;
      }
      
      .brochure-card {
        grid-template-columns: 1fr;
        margin: 0 1rem;
      }
      
      .brochure-content {
        padding: 2rem 1.5rem;
        text-align: center;
      }
      
      .brochure-title {
        font-size: 1.8rem;
      }
      
      .brochure-description {
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
      }
      
      .brochure-visual {
        padding: 1.5rem;
      }
      
      .brochure-mockup {
        width: 120px;
        height: 160px;
      }
      
      .book-title {
        font-size: 0.9rem;
      }
      
      .book-subtitle {
        font-size: 0.7rem;
      }
    }

    @media (max-width: 480px) {
      .collections-grid {
        grid-template-columns: 1fr;
        padding: 1rem 0.5rem;
        gap: 1rem;
      }
      
      .collection-card {
        min-height: 350px;
      }
      
      .collection-image {
        height: 160px;
      }
      
      .collection-content {
        padding: 1.2rem;
        min-height: 150px;
      }
      
      .collection-title {
        font-size: 1.3rem;
      }
      
      .collection-description {
        font-size: 0.9rem;
        margin-bottom: 1rem;
      }
      
      .download-btn {
        padding: 0.75rem 0.9rem;
        font-size: 0.8rem;
        border-radius: 1.4rem;
        width: calc(100% - 0.8rem);
        margin: 0 0.4rem;
      }
      
      .online-brochure-section {
        padding: 1.5rem 0;
      }
      
      .brochure-card {
        margin: 0 0.5rem;
        border-radius: 1rem;
      }
      
      .brochure-content {
        padding: 1.5rem 1rem;
      }
      
      .brochure-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
      }
      
      .brochure-title {
        font-size: 1.6rem;
        margin-bottom: 0.8rem;
      }
      
      .brochure-description {
        font-size: 0.9rem;
        margin-bottom: 1.2rem;
      }
      
      .brochure-btn {
        padding: 0.8rem 1.5rem;
        font-size: 0.9rem;
        border-radius: 1.5rem;
      }
      
      .btn-text {
        margin-right: 0.6rem;
      }
      
      .btn-icon {
        width: 18px;
        height: 18px;
      }
      
      .brochure-visual {
        padding: 1rem;
      }
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

    <!-- Online Brochure Section -->
    <section class="online-brochure-section">
      <div class="container">
        <div class="brochure-card">
          <div class="brochure-content">
            <div class="brochure-icon">
              📖
            </div>
            <h2 class="brochure-title">Complete Digital Catalog</h2>
            <p class="brochure-description">
              Explore our comprehensive wine portfolio in our interactive digital brochure. 
              Browse through our premium selections, detailed tasting notes, and complete 
              product information in an engaging flip-book format.
            </p>
            <a href="https://online.fliphtml5.com/eyrrh/fjuc/" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="brochure-btn">
              <span class="btn-text">View Digital Catalog</span>
              <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7zm-2 16H5V12H3v7c0 1.1.9 2 2 2h7v-2z"/>
                </svg>
              </a>
          </div>
          <div class="brochure-visual">
            <div class="brochure-mockup">
              <div class="book-spine"></div>
              <div class="book-cover">
                <div class="book-title">RamarySelect</div>
                <div class="book-subtitle">Wine Portfolio</div>
          </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Collections Grid -->
    <section class="section">
      <div class="container">
        <div id="collections-loading" class="loading-message">
          <p>Loading collections...</p>
        </div>
        <div id="collections-grid" class="collections-grid" style="display: none;">
          <!-- Collections will be loaded here dynamically -->
        </div>
        <div id="collections-error" class="error-message" style="display: none;">
          <p>Failed to load collections. Please try again later.</p>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
    <?php include 'php/includes/footer.php'; ?>

  <script>
    // Load collections dynamically
    async function loadCollections() {
      try {
        const response = await fetch('/ramaryselect/php/api/get_collections.php');
        const data = await response.json();
        
        if (data.success) {
          displayCollections(data.collections);
        } else {
          showError();
        }
      } catch (error) {
        console.error('Error loading collections:', error);
        showError();
      }
    }

    function displayCollections(collections) {
      const grid = document.getElementById('collections-grid');
      const loading = document.getElementById('collections-loading');
      
      loading.style.display = 'none';
      grid.style.display = 'grid';
      
             grid.innerHTML = collections.map(collection => `
         <div class="collection-card">
           <img src="${collection.image_path}" alt="${collection.name}" class="collection-image" onerror="this.src='/ramaryselect/images/wine1.jpg'">
           <div class="collection-content">
             <div class="collection-info">
               <h2 class="collection-title">${collection.name}</h2>
               <p class="collection-description">
                 ${collection.description}
               </p>
             </div>
             ${collection.has_brochure ? 
               `<a href="${collection.pdf_path}" class="download-btn" target="_blank" download>
                 Download Brochure
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                   <path d="M12 16l-6-6h4V4h4v6h4l-6 6zm-6 4h12v-2H6v2z"/>
                 </svg>
               </a>` :
               `<span class="download-btn disabled">
                 Brochure Coming Soon
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                   <path d="M12 16l-6-6h4V4h4v6h4l-6 6zm-6 4h12v-2H6v2z"/>
                 </svg>
               </span>`
             }
           </div>
         </div>
       `).join('');
    }

    function showError() {
      const loading = document.getElementById('collections-loading');
      const error = document.getElementById('collections-error');
      
      loading.style.display = 'none';
      error.style.display = 'block';
    }

    // Load collections when page loads
    document.addEventListener('DOMContentLoaded', loadCollections);
  </script>
</body>
</html> 