function initSlider() {
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    
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
    
    function startAutoSlide() {
        autoSlideInterval = setInterval(goToNextSlide, 5000);
    }
    startAutoSlide();
}

// Initialize slider when DOM is ready
document.addEventListener('DOMContentLoaded', initSlider);