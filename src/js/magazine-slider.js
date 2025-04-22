document.addEventListener('DOMContentLoaded', function() {
    const magazineSlider = (() => {
        const slider = document.querySelector('.magazines-slider');
        const prevBtn = document.querySelector('.magazines-prev');
        const nextBtn = document.querySelector('.magazines-next');
        const items = document.querySelectorAll('.magazine-item');
        
        if (!slider || !prevBtn || !nextBtn || items.length === 0) return;
        
        let currentIndex = 0;
        let resizeTimer;
        const itemWidth = items[0].offsetWidth + parseInt(window.getComputedStyle(items[0]).marginRight);
        let itemsPerView = calculateItemsPerView();
        let maxIndex = Math.max(0, items.length - itemsPerView);
        
        function calculateItemsPerView() {
            const containerWidth = slider.parentElement.offsetWidth;
            return Math.max(1, Math.floor(containerWidth / itemWidth));
        }
        
        function updateSliderPosition() {
            const translateX = -currentIndex * itemWidth;
            slider.style.transform = `translateX(${translateX}px)`;
            
            prevBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
            nextBtn.style.opacity = currentIndex >= maxIndex ? '0.5' : '1';
        }
        
        function handleSwipe() {
            const minSwipeDistance = 50;
            const swipeDistance = touchEndX - touchStartX;
            
            if (swipeDistance > minSwipeDistance && currentIndex > 0) {
                currentIndex--;
                updateSliderPosition();
            } else if (swipeDistance < -minSwipeDistance && currentIndex < maxIndex) {
                currentIndex++;
                updateSliderPosition();
            }
        }
        
        function setupEventListeners() {
            prevBtn.addEventListener('click', () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateSliderPosition();
                }
            });
            
            nextBtn.addEventListener('click', () => {
                if (currentIndex < maxIndex) {
                    currentIndex++;
                    updateSliderPosition();
                }
            });
            
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    itemsPerView = calculateItemsPerView();
                    maxIndex = Math.max(0, items.length - itemsPerView);
                    
                    if (currentIndex > maxIndex) {
                        currentIndex = maxIndex;
                    }
                    
                    updateSliderPosition();
                }, 250);
            });
            
            let touchStartX = 0;
            let touchEndX = 0;
            
            slider.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });
            
            slider.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, { passive: true });
        }
        
        function initIntersectionObserver() {
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                        }
                    });
                }, { threshold: 0.1 });
                
                items.forEach(item => {
                    observer.observe(item);
                });
            }
        }
        
        function init() {
            updateSliderPosition();
            setupEventListeners();
            initIntersectionObserver();
        }
        
        return { init };
    })();
    
    if (magazineSlider) magazineSlider.init();
});
