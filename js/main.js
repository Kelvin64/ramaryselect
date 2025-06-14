// Wine data
const wines = [
    {
        name: 'Arbora',
        type: 'Pinot Noir',
        cask: 'Gau Cask',
        image: 'images/sidepan.png'
    },
    {
        name: 'Alto Italia',
        type: 'Pinot Grigio',
        cask: 'Gau Cask',
        image: 'images/sidepan.png'
    },
    {
        name: 'Cavellor',
        type: 'Pinot Grigio',
        cask: 'Gau Cask',
        image: 'images/sidepan.png'
    },
    {
        name: 'Trentino',
        type: 'Pinot Grigio',
        cask: 'Gau Cask',
        image: 'images/sidepan.png'
    }
];

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
    { name: 'Melcom', logo: 'images/melcom.png' }
];

// Initialize the page
document.addEventListener('DOMContentLoaded', () => {
    initializeWineCards();
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

// Initialize wine cards
function initializeWineCards() {
    const wineCardsGrid = document.querySelector('.wine-cards__grid');
    if (!wineCardsGrid) return;

    wines.forEach(wine => {
        const wineCard = document.createElement('div');
        wineCard.className = 'wine-card';
        wineCard.innerHTML = `
            <img src="${wine.image}" alt="${wine.name}" class="wine-card__image" />
            <h3 class="wine-card__title">${wine.name}</h3>
            <p class="wine-card__subtitle">${wine.type}<br/>${wine.cask}</p>
            <a href="contact.php" class="wine-card__button">Order Now</a>
        `;
        wineCardsGrid.appendChild(wineCard);
    });
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