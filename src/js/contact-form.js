document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    if (!form) return;

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(form);

        fetch(WP.ajaxUrl, {
            method: 'POST',
            headers: { 'X-WP-Nonce': WP.nonce },
            body: new URLSearchParams({
                action: 'send_dynamic_form',
                nom: formData.get('nom'),
                prenom: formData.get('prenom'),
                email: formData.get('email'),
                telephone: formData.get('telephone'),
                objet: formData.get('objet'),
                service: formData.get('service'),
                message: formData.get('message'),
                consent: formData.get('consent')
            })
        })
            .then(res => res.json())
            .then(res => {
                alert(res.data);
                if (res.success) form.reset();
            });
    });
});
