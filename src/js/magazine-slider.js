// js/magazine-slider.js

function initMagazineSlider() {
    const container = document.querySelector('.magazines-container');
    const track = document.querySelector('.magazines-slider');
    const prev = document.querySelector('.magazines-prev');
    const next = document.querySelector('.magazines-next');

    if (!track) return;

    let currentPosition = 0;

    function getMaxScroll() {
        const visibleWidth = container.clientWidth;
        const totalWidth = track.scrollWidth;
        return totalWidth - visibleWidth;
    }

    function move(position) {
        const maxScroll = getMaxScroll();
        currentPosition = Math.max(0, Math.min(position, maxScroll));
        track.style.transform = `translateX(-${currentPosition}px)`;
        updateNavButtons(maxScroll);
    }

    function updateNavButtons(maxScroll) {
        prev.disabled = currentPosition <= 0;
        next.disabled = currentPosition >= maxScroll;
    }

    function getScrollStep() {
        return container.offsetWidth * 0.8;
    }

    prev.addEventListener('click', () => {
        move(currentPosition - getScrollStep());
    });

    next.addEventListener('click', () => {
        const maxScroll = getMaxScroll();
        const step = getScrollStep();
        if (maxScroll - currentPosition < step * 1.5) {
            move(maxScroll);
        } else {
            move(currentPosition + step);
        }
    });

    window.addEventListener('resize', () => {
        move(currentPosition);
    });

    move(0);
}

document.addEventListener('DOMContentLoaded', initMagazineSlider);