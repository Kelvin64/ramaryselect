// Wine data - will be loaded from database
let wines = [];

// Features data
const features = [
    {
        icon: `<svg class="feature__icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 1.343-3 3 0 2.5 3 5 3 5s3-2.5 3-5c0-1.657-1.343-3-3-3z"/>
                <circle cx="12" cy="12" r="10"/>
               </svg>`,
        title: 'Exceptional Origins',
        description: 'From world-class vineyards, our wines reflect rich tradition and craft.'
    },
    {
        icon: `<svg class="feature__icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12l2 2 4-4"/>
               </svg>`,
        title: 'High Quality',
        description: 'We provide the finest, reliable quality.'
    },
    {
        icon: `<svg class="feature__icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 9h6v6H9z"/>
               </svg>`,
        title: 'Extraordinary',
        description: 'Wine like never before—unique taste experiences await.'
    },
    {
        icon: `<svg class="feature__icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3"/>
               </svg>`,
        title: 'Affordable Price',
        description: 'Our wine selection offers great value for every budget.'
    }
];

// Partners data
const partners = [
    { name: 'Don Emilio', logo: 'images/DE_LOGO.png' }
];

// Initialize the page
document.addEventListener('DOMContentLoaded', () => {
    loadWines(); // Load wines from database instead of initializing static ones
    initializeFeatures();
    initializePartners();
    
    const header = document.querySelector('.header');
    const toggleButton = document.querySelector('.header__toggle');
    const mobileNav = document.querySelector('.mobile-nav');

    if (toggleButton && mobileNav) {
        toggleButton.addEventListener('click', () => {
            header.classList.toggle('active');
            mobileNav.classList.toggle('active');
        });
    }

    window.addEventListener('resize', () => {
        if (window.innerWidth > 992) {
            if (header) {
                header.classList.remove('active');
            }
            if (mobileNav) {
                mobileNav.classList.remove('active');
            }
        }
    });
});

// Load wines from database
async function loadWines() {
    try {
        const response = await fetch('/ramaryselect/php/api/get_wines.php');
        const data = await response.json();
        
        if (data.success) {
            wines = data.wines;
            initializeWineCards();
        } else {
            console.error('Failed to load wines:', data.error);
            // Fallback to empty state or show error message
        }
    } catch (error) {
        console.error('Error loading wines:', error);
        // Fallback to empty state or show error message
    }
}

// Carousel state
let currentSlide = 0;
let autoSlideInterval;
let cardsPerView = 3;

// Initialize wine cards carousel
function initializeWineCards() {
    const wineCarouselTrack = document.querySelector('.wine-carousel__track');
    if (!wineCarouselTrack) return;

    // Clear existing cards
    wineCarouselTrack.innerHTML = '';

    if (wines.length === 0) {
        wineCarouselTrack.innerHTML = '<p style="text-align: center; color: #666; width: 100%;">No wines available at the moment.</p>';
        return;
    }

    // Add wine cards to carousel
    wines.forEach(wine => {
        const wineCard = document.createElement('div');
        wineCard.className = 'wine-card';
        wineCard.innerHTML = `
            <img src="${wine.image}" alt="${wine.name}" class="wine-card__image" />
            <h3 class="wine-card__title">${wine.name}</h3>
            <p class="wine-card__subtitle">${wine.type}<br/>${wine.cask || ''}</p>
            <a href="contact.php" class="wine-card__button">Order Now</a>
        `;
        wineCarouselTrack.appendChild(wineCard);
    });

    // Initialize carousel functionality
    initializeCarousel();
}

// Initialize carousel functionality
function initializeCarousel() {
    if (wines.length === 0) return;

    updateCardsPerView();
    createDots();
    setupNavigationEvents();
    setupTouchEvents();
    setupHoverEvents();
    startAutoSlide();
    
    // Handle window resize
    window.addEventListener('resize', () => {
        updateCardsPerView();
        updateSlidePosition();
        createDots();
    });
}

// Update cards per view based on screen size
function updateCardsPerView() {
    const screenWidth = window.innerWidth;
    if (screenWidth <= 480) {
        cardsPerView = 1;
    } else if (screenWidth <= 768) {
        cardsPerView = 2;
    } else if (screenWidth <= 1200) {
        cardsPerView = 3;
    } else {
        cardsPerView = 4;
    }
}

// Create navigation dots
function createDots() {
    const dotsContainer = document.querySelector('.wine-carousel__dots');
    if (!dotsContainer) return;

    dotsContainer.innerHTML = '';
    
    const totalSlides = Math.max(1, Math.ceil(wines.length / cardsPerView));
    
    for (let i = 0; i < totalSlides; i++) {
        const dot = document.createElement('button');
        dot.className = `wine-carousel__dot ${i === currentSlide ? 'active' : ''}`;
        dot.addEventListener('click', () => goToSlide(i));
        dotsContainer.appendChild(dot);
    }
}

// Setup navigation button events
function setupNavigationEvents() {
    const prevBtn = document.querySelector('.wine-carousel__prev');
    const nextBtn = document.querySelector('.wine-carousel__next');
    
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            stopAutoSlide();
            previousSlide();
            startAutoSlide();
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            stopAutoSlide();
            nextSlide();
            startAutoSlide();
        });
    }
}

// Go to specific slide
function goToSlide(slideIndex) {
    const totalSlides = Math.ceil(wines.length / cardsPerView);
    currentSlide = Math.max(0, Math.min(slideIndex, totalSlides - 1));
    updateSlidePosition();
    updateDots();
}

// Go to next slide
function nextSlide() {
    const totalSlides = Math.ceil(wines.length / cardsPerView);
    currentSlide = (currentSlide + 1) % totalSlides;
    updateSlidePosition();
    updateDots();
}

// Go to previous slide
function previousSlide() {
    const totalSlides = Math.ceil(wines.length / cardsPerView);
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    updateSlidePosition();
    updateDots();
}

// Update slide position
function updateSlidePosition() {
    const track = document.querySelector('.wine-carousel__track');
    if (!track) return;

    // Get actual card width based on screen size
    let cardWidth = 280;
    const screenWidth = window.innerWidth;
    
    if (screenWidth <= 480) {
        cardWidth = 220;
    } else if (screenWidth <= 768) {
        cardWidth = 240;
    } else if (screenWidth <= 1200) {
        cardWidth = 260;
    }

    const gap = 24; // Gap between cards (1.5rem)
    const offset = currentSlide * cardsPerView * (cardWidth + gap);
    
    track.style.transform = `translateX(-${offset}px)`;
}

// Update active dot
function updateDots() {
    const dots = document.querySelectorAll('.wine-carousel__dot');
    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSlide);
    });
}

// Start automatic sliding
function startAutoSlide() {
    if (wines.length <= cardsPerView) return; // Don't auto-slide if all cards fit
    
    stopAutoSlide(); // Clear any existing interval
    autoSlideInterval = setInterval(() => {
        nextSlide();
    }, 4000); // Change slide every 4 seconds
}

// Stop automatic sliding
function stopAutoSlide() {
    if (autoSlideInterval) {
        clearInterval(autoSlideInterval);
        autoSlideInterval = null;
    }
}

// Setup touch/swipe events for mobile
function setupTouchEvents() {
    const carousel = document.querySelector('.wine-carousel');
    if (!carousel) return;

    let startX = 0;
    let endX = 0;
    let isDragging = false;

    carousel.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        isDragging = true;
        stopAutoSlide();
    }, { passive: true });

    carousel.addEventListener('touchmove', (e) => {
        if (!isDragging) return;
        endX = e.touches[0].clientX;
    }, { passive: true });

    carousel.addEventListener('touchend', () => {
        if (!isDragging) return;
        isDragging = false;

        const threshold = 50;
        const diff = startX - endX;

        if (Math.abs(diff) > threshold) {
            if (diff > 0) {
                nextSlide();
            } else {
                previousSlide();
            }
        }

        startAutoSlide();
    }, { passive: true });
}

// Setup hover events to pause auto-slide
function setupHoverEvents() {
    const carousel = document.querySelector('.wine-carousel');
    if (!carousel) return;

    carousel.addEventListener('mouseenter', stopAutoSlide);
    carousel.addEventListener('mouseleave', startAutoSlide);
}

// Initialize features section
function initializeFeatures() {
    const featuresGrid = document.querySelector('.features__grid');
    if (!featuresGrid) return;

    features.forEach(feature => {
        const featureCard = document.createElement('div');
        featureCard.className = 'feature-card';
        featureCard.innerHTML = `
            ${feature.icon}
            <h3 class="feature-card__title">${feature.title}</h3>
            <p class="feature-card__description">${feature.description}</p>
        `;
        featuresGrid.appendChild(featureCard);
    });
}

// Initialize partners section
function initializePartners() {
    const partnersGrid = document.querySelector('.partners__grid');
    if (!partnersGrid) return;

    partners.forEach(partner => {
        const partnerLogo = document.createElement('div');
        partnerLogo.className = 'partner-logo';
        partnerLogo.innerHTML = `
            <img src="${partner.logo}" alt="${partner.name}" />
        `;
        partnersGrid.appendChild(partnerLogo);
    });
}

// Handle newsletter form submission
const newsletterForm = document.querySelector('.newsletter__form');
if (newsletterForm) {
    newsletterForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const emailInput = newsletterForm.querySelector('input[type="email"]');
        const email = emailInput.value.trim();
        const submitButton = newsletterForm.querySelector('button');
        const originalButtonText = submitButton.textContent;

        submitButton.disabled = true;
        submitButton.textContent = 'Subscribing...';

        try {
            const response = await fetch('/ramaryselect/php/newsletter_subscribe.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'email=' + encodeURIComponent(email),
            });

            const result = await response.json();

            alert(result.message || 'An error occurred.');
            
            if (result.success) {
                newsletterForm.reset();
            }
        } catch (error) {
            console.error('Subscription error:', error);
            alert('An error occurred while subscribing. Please try again.');
        } finally {
            submitButton.disabled = false;
            submitButton.textContent = originalButtonText;
        }
    });
} 