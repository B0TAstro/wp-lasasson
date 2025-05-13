// js/dispositif-slider.js

function initSlider() {
    const container = document.querySelector('.dispositif-slider-container.has-slider');
    if (!container) return;

    const slider = container.querySelector('.dispositif-slider');
    const slides = container.querySelectorAll('.dispositif-slide');
    const dotsContainer = container.querySelector('.dispositif-slider-dots');

    let currentIndex = 0;
    let interval;

    function updateSlider(index) {
        currentIndex = index;
        slider.style.transform = `translateX(-${index * 100}%)`;
        updateDots();
    }

    function createDots() {
        slides.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.className = 'dot';
            dot.setAttribute('aria-label', `Aller à l’image ${index + 1}`);
            dot.addEventListener('click', () => updateSlider(index));
            dotsContainer.appendChild(dot);
        });
        updateDots();
    }

    function updateDots() {
        const dots = dotsContainer.querySelectorAll('.dot');
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentIndex);
        });
    }

    function autoSlide() {
        interval = setInterval(() => {
            currentIndex = (currentIndex + 1) % slides.length;
            updateSlider(currentIndex);
        }, 10000);
    }

    createDots();
    autoSlide();
}

document.addEventListener('DOMContentLoaded', initSlider);
