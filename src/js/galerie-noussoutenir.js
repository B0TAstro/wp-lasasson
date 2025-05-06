document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.gallery-tab-button');
    const groups = document.querySelectorAll('.gallery-group');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Active button
            buttons.forEach(b => b.classList.remove('active'));
            button.classList.add('active');

            // Récupère la cible
            const target = button.getAttribute('data-tab');

            groups.forEach(group => {
                if (group.id === target) {
                    // Affiche avec fondu
                    group.classList.add('active');
                } else {
                    // Masque avec opacité
                    group.classList.remove('active');
                }
            });
        });
    });
});
