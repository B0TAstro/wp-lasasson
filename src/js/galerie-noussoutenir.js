
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.gallery-tab-button');
        const groups = document.querySelectorAll('.gallery-group');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                // Active button
                buttons.forEach(b => b.classList.remove('active'));
                button.classList.add('active');

                // Show corresponding group
                const target = button.getAttribute('data-tab');
                groups.forEach(group => {
                    group.classList.toggle('active', group.id === target);
                });
            });
        });
    });
