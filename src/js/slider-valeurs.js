document.addEventListener("DOMContentLoaded", function() {
    let slider = document.querySelector('.valeurs-list');
    let isMouseOver = false;

    // Gérer le survol
    slider.addEventListener('mouseenter', () => {
        isMouseOver = true;  // Pause l'animation
        slider.style.animationPlayState = 'paused';  // Met l'animation en pause
    });

    slider.addEventListener('mouseleave', () => {
        isMouseOver = false;  // Reprend l'animation
        slider.style.animationPlayState = 'running';  // Relance l'animation
    });
});
