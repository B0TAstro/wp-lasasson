document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');
    
    if (!slider || slides.length === 0) return;
    
    let currentIndex = 0;
    const slideWidth = slides[0].clientWidth;
    let autoSlideInterval;
    
    function moveSlider(index) {
        currentIndex = index;
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    }
    
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            currentIndex = (currentIndex === 0) ? slides.length - 1 : currentIndex - 1;
            moveSlider(currentIndex);
            resetAutoSlide();
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            currentIndex = (currentIndex === slides.length - 1) ? 0 : currentIndex + 1;
            moveSlider(currentIndex);
            resetAutoSlide();
        });
    }
    
    function startAutoSlide() {
        autoSlideInterval = setInterval(function() {
            currentIndex = (currentIndex === slides.length - 1) ? 0 : currentIndex + 1;
            moveSlider(currentIndex);
        }, 5000);
    }
    
    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        startAutoSlide();
    }
    
    startAutoSlide();
});
