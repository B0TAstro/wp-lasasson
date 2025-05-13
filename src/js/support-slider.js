function initSlider() {
    const slider = document.querySelector('.emergency-slider');
    const slides = document.querySelectorAll('.emergency-slide');
    //const prevButton = document.querySelector('.slider-prev');
    //const nextButton = document.querySelector('.slider-next');

    if (!slider || slides.length === 0) return;

    let currentIndex = 0;
    let autoSlideInterval;

    function moveSlider(index) {
        currentIndex = index;
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    function goToNextSlide() {
        currentIndex = (currentIndex === slides.length - 1) ? 0 : currentIndex + 1;
        moveSlider(currentIndex);
    }

    function goToPrevSlide() {
        currentIndex = (currentIndex === 0) ? slides.length - 1 : currentIndex - 1;
        moveSlider(currentIndex);
    }

    function startAutoSlide() {
        autoSlideInterval = setInterval(goToNextSlide, 5000);
    }

    startAutoSlide();

    // Boutons manuels désactivés pour le moment
/*
    if (nextButton) {
        nextButton.addEventListener('click', () => {
            goToNextSlide();
        });
    }

    if (prevButton) {
        prevButton.addEventListener('click', () => {
            goToPrevSlide();
        });
    }
    */
}

document.addEventListener('DOMContentLoaded', initSlider);
