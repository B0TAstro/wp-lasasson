document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    if (!form) return;
    
    // Ajoutez éventuellement un message de statut
    const statusDiv = document.createElement('div');
    statusDiv.className = 'form-status';
    form.appendChild(statusDiv);

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Afficher un message de chargement
        statusDiv.textContent = 'Envoi en cours...';
        statusDiv.className = 'form-status loading';
        
        const formData = new FormData(form);
        
        fetch(WP.ajaxUrl, {
            method: 'POST',
            body: new URLSearchParams({
                action: 'send_dynamic_form',
                nom: formData.get('nom'),
                prenom: formData.get('prenom'),
                email: formData.get('email'),
                telephone: formData.get('telephone'),
                objet: formData.get('objet'),
                service: formData.get('service'),
                message: formData.get('message'),
                consent: formData.get('consent') ? '1' : ''
            })
        })
        .then(res => {
            if (!res.ok) {
                throw new Error('Erreur réseau');
            }
            return res.json();
        })
        .then(res => {
            console.log('Réponse reçue:', res); // Pour déboguer
            
            if (res.success) {
                statusDiv.textContent = typeof res.data === 'string' ? res.data : 'Votre message a bien été envoyé.';
                statusDiv.className = 'form-status success';
                form.reset();
            } else {
                statusDiv.textContent = typeof res.data === 'string' ? res.data : 'Erreur lors de l\'envoi du message.';
                statusDiv.className = 'form-status error';
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            statusDiv.textContent = 'Une erreur est survenue lors de l\'envoi du formulaire.';
            statusDiv.className = 'form-status error';
        });
    });
});