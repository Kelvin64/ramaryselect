class Carousel {
    constructor(element) {
        this.track = element.querySelector('.carousel__track');
        this.prevButton = element.querySelector('.carousel__button--prev');
        this.nextButton = element.querySelector('.carousel__button--next');
        this.cards = Array.from(this.track.children);
        this.currentIndex = 0;
        this.cardWidth = this.cards[0]?.offsetWidth || 0;
        this.gap = parseInt(getComputedStyle(this.cards[0]).marginRight) || 0;
        this.cardsPerView = Math.floor(this.track.offsetWidth / (this.cardWidth + this.gap));
        
        this.init();
    }

    init() {
        if (!this.track || !this.prevButton || !this.nextButton) return;

        // Set initial state
        this.updateButtons();
        
        // Add event listeners
        this.prevButton.addEventListener('click', () => this.slide('prev'));
        this.nextButton.addEventListener('click', () => this.slide('next'));
        
        // Handle window resize
        window.addEventListener('resize', () => {
            this.cardWidth = this.cards[0]?.offsetWidth || 0;
            this.cardsPerView = Math.floor(this.track.offsetWidth / (this.cardWidth + this.gap));
            this.updateButtons();
        });
    }

    slide(direction) {
        if (direction === 'prev' && this.currentIndex > 0) {
            this.currentIndex--;
        } else if (direction === 'next' && this.currentIndex < this.cards.length - this.cardsPerView) {
            this.currentIndex++;
        }

        const offset = this.currentIndex * (this.cardWidth + this.gap);
        this.track.style.transform = `translateX(-${offset}px)`;
        this.updateButtons();
    }

    updateButtons() {
        // Update prev button
        this.prevButton.style.opacity = this.currentIndex === 0 ? '0.5' : '1';
        this.prevButton.style.pointerEvents = this.currentIndex === 0 ? 'none' : 'auto';

        // Update next button
        const maxIndex = this.cards.length - this.cardsPerView;
        this.nextButton.style.opacity = this.currentIndex >= maxIndex ? '0.5' : '1';
        this.nextButton.style.pointerEvents = this.currentIndex >= maxIndex ? 'none' : 'auto';
    }
}

// Initialize all carousels on the page
document.addEventListener('DOMContentLoaded', () => {
    const carousels = document.querySelectorAll('.carousel');
    carousels.forEach(carousel => new Carousel(carousel));
}); 