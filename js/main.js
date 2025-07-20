// Wine data and Swiper instance
let wines = [];
let wineSwiper = null;

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
    
    // Remove the EventSource code since the endpoint doesn't exist yet
    
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
            console.log(`Loaded ${wines.length} wines from database`);
            wines.forEach((wine, index) => {
                console.log(`Wine ${index + 1}: ${wine.name} - ${wine.type}`);
            });
            
            // If Swiper exists, destroy it before reinitializing
            if (wineSwiper) {
                console.log('Destroying existing Swiper instance...');
                wineSwiper.destroy();
                wineSwiper = null;
            }
            
            initializeWineCards();
        } else {
            console.error('Failed to load wines:', data.error);
            // Show error message to user
            showNotification('Error loading wines. Please refresh the page.');
        }
    } catch (error) {
        console.error('Error loading wines:', error);
        // Show error message to user
        showNotification('Error loading wines. Please refresh the page.');
    }
}

// Initialize wine cards carousel with Swiper
function initializeWineCards() {
    const swiperWrapper = document.querySelector('.wine-swiper .swiper-wrapper');
    if (!swiperWrapper) return;

    // Clear existing cards
    swiperWrapper.innerHTML = '';

    if (wines.length === 0) {
        swiperWrapper.innerHTML = '<div class="swiper-slide"><p style="text-align: center; color: #666;">No wines available at the moment.</p></div>';
        return;
    }

    // Add wine cards to swiper
    wines.forEach(wine => {
        const slide = document.createElement('div');
        slide.className = 'swiper-slide';
        slide.innerHTML = `
            <div class="wine-card">
            <img src="${wine.image}" alt="${wine.name}" class="wine-card__image" />
            <h3 class="wine-card__title">${wine.name}</h3>
                <p class="wine-card__subtitle">${wine.type}<br/>${wine.cask || ''}</p>
            <a href="contact.php" class="wine-card__button">Order Now</a>
            </div>
        `;
        swiperWrapper.appendChild(slide);
    });

    // Initialize Swiper
    initializeSwiper();
}

// Initialize Swiper carousel
function initializeSwiper() {
    wineSwiper = new Swiper('.wine-swiper', {
        // Responsive breakpoints
        breakpoints: {
            // Mobile: 1 slide
            320: {
                slidesPerView: 1,
                spaceBetween: 20,
                centeredSlides: true,
            },
            // Tablet: 2 slides
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
                centeredSlides: false,
            },
            // Desktop: 3 slides
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
                centeredSlides: false,
            },
            // Large desktop: 4 slides
            1200: {
                slidesPerView: 4,
                spaceBetween: 30,
                centeredSlides: false,
            }
        },
        
        // Navigation
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        
        // Pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true, // Better for many slides
        },
        
        // Loop
        loop: wines.length > 4, // Only loop if more than 4 wines
        
        // Auto height
        autoHeight: true,
        
        // Smooth transitions
        effect: 'slide',
        speed: 500,
        
        // Touch/swipe support
        allowTouchMove: true,
        grabCursor: true,
        
        // Accessibility
        a11y: {
            prevSlideMessage: 'Previous wine',
            nextSlideMessage: 'Next wine',
            firstSlideMessage: 'This is the first wine',
            lastSlideMessage: 'This is the last wine',
            paginationBulletMessage: 'Go to wine {{index}}'
        }
    });

    console.log('Swiper initialized successfully with', wines.length, 'wines');
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

// Show notification to user
function showNotification(message) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    
    // Add to page
    document.body.appendChild(notification);
    
    // Remove after 5 seconds
    setTimeout(() => {
        notification.remove();
    }, 5000);
} 