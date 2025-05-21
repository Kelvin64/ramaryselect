// Carousel functionality for wine slider

document.addEventListener('DOMContentLoaded', function () {
  const track = document.getElementById('carousel-track');
  const prevBtn = document.getElementById('carousel-prev');
  const nextBtn = document.getElementById('carousel-next');
  const card = track.querySelector('div'); // First wine card
  const cardWidth = card.offsetWidth + 24; // 24px gap-6

  prevBtn.addEventListener('click', () => {
    track.scrollBy({ left: -cardWidth, behavior: 'smooth' });
  });

  nextBtn.addEventListener('click', () => {
    track.scrollBy({ left: cardWidth, behavior: 'smooth' });
  });
}); 