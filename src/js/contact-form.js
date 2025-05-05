// js/contact-form.js

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    if (!form) return;
    
    // Message de statut du formulaire
    const statusMessage = document.createElement('div');
    statusMessage.className = 'status-message';
    statusMessage.style.display = 'none';
    statusMessage.style.width = '100%';
    statusMessage.style.padding = '15px';
    statusMessage.style.marginTop = '20px';
    statusMessage.style.borderRadius = '5px';
    statusMessage.style.textAlign = 'center';
    statusMessage.style.fontWeight = '500';
    statusMessage.style.fontSize = '18px';
    statusMessage.style.transition = 'all 0.3s ease';
    statusMessage.style.boxSizing = 'border-box';
    
    const submitButton = form.querySelector('.btn-submit');
    if (submitButton) {
        submitButton.parentNode.insertBefore(statusMessage, submitButton.nextSibling);
    } else {
        form.appendChild(statusMessage);
    }
    
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const submitBtn = form.querySelector('.btn-submit');
        const originalButtonText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Envoi en cours...';
        
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
            console.log('Réponse reçue:', res);
            
            submitBtn.disabled = false;
            submitBtn.textContent = originalButtonText;
            
            if (res.success) {
                console.log("Message envoyé avec succès!");
                statusMessage.textContent = res.data || 'Votre message a été envoyé avec succès!';
                statusMessage.style.display = 'block';
                statusMessage.style.backgroundColor = '#42b883';
                statusMessage.style.color = '#ffffff';
                statusMessage.style.border = '1px solid #2d8659';
                
                form.reset();
            } else {
                console.log("Erreur lors de l'envoi du message.");
                statusMessage.textContent = res.data || 'Une erreur est survenue. Veuillez réessayer.';
                statusMessage.style.display = 'block';
                statusMessage.style.backgroundColor = '#ff5252';
                statusMessage.style.color = '#ffffff';
                statusMessage.style.border = '1px solid #c41c1c';
            }
            setTimeout(() => {
                statusMessage.style.opacity = '0';
                setTimeout(() => {
                    statusMessage.style.display = 'none';
                    statusMessage.style.opacity = '1';
                }, 300);
            }, 10000);
        })
        .catch(error => {
            console.error('Erreur:', error);
            
            submitBtn.disabled = false;
            submitBtn.textContent = originalButtonText;
            statusMessage.textContent = 'Une erreur de réseau est survenue. Veuillez réessayer.';
            statusMessage.style.display = 'block';
            statusMessage.style.backgroundColor = '#ff5252';
            statusMessage.style.color = '#ffffff';
            statusMessage.style.border = '1px solid #c41c1c';
            
            setTimeout(() => {
                statusMessage.style.opacity = '0';
                setTimeout(() => {
                    statusMessage.style.display = 'none';
                    statusMessage.style.opacity = '1';
                }, 300);
            }, 10000);
        });
    });
});