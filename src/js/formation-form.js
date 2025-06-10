// js/formation-form.js

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formationForm');
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

    // Gestion de l'affichage conditionnel des champs selon l'objet de la demande
    const objetDemandeSelect = document.getElementById('objetdemande');
    const formationContainer = document.getElementById('formation-container');
    const formationSelect = document.getElementById('formation');
    const dateSuggestionContainer = document.getElementById('date-suggestion-container');
    const dateFormationContainer = document.getElementById('date-formation-container');
    const dateSuggestionField = document.getElementById('date_suggestion');
    const dateFormationField = document.getElementById('date_formation');
    
    // Fonction pour mettre à jour l'affichage des champs
    function updateFormFields() {
        if (!objetDemandeSelect) return;
        
        const selectedValue = objetDemandeSelect.value;
        console.log('Valeur sélectionnée:', selectedValue);
        
        // Reset des champs
        if (formationSelect) formationSelect.value = '';
        if (dateSuggestionField) dateSuggestionField.value = '';
        if (dateFormationField) dateFormationField.value = '';
        
        // Masquer tous les champs conditionnels d'abord
        if (formationContainer) formationContainer.style.display = 'none';
        if (dateSuggestionContainer) dateSuggestionContainer.style.display = 'none'; 
        if (dateFormationContainer) dateFormationContainer.style.display = 'none';
        
        // Retirer les attributs required
        if (formationSelect) formationSelect.removeAttribute('required');
        if (dateSuggestionField) dateSuggestionField.removeAttribute('required');
        if (dateFormationField) dateFormationField.removeAttribute('required');
        
        // Logique selon la sélection
        if (selectedValue === 'Suggestion' || selectedValue === 'suggestion') {
            console.log('Mode Suggestion activé');
            if (dateSuggestionContainer) {
                dateSuggestionContainer.style.display = 'block';
                if (dateSuggestionField) dateSuggestionField.setAttribute('required', '');
            }
            
        } else if (selectedValue === 'Réclamation' || selectedValue === 'reclamation' || selectedValue === 'Reclamation') {
            console.log('Mode Réclamation activé');
            if (formationContainer) {
                formationContainer.style.display = 'block';
                if (formationSelect) formationSelect.setAttribute('required', '');
            }
            if (dateFormationContainer) {
                dateFormationContainer.style.display = 'block';
                if (dateFormationField) dateFormationField.setAttribute('required', '');
            }
            
        } else if (selectedValue === 'Formation' || selectedValue === 'formation') {
            console.log('Mode Formation activé');
            if (formationContainer) {
                formationContainer.style.display = 'block';
                if (formationSelect) formationSelect.setAttribute('required', '');
            }
            
        } else if (selectedValue) {
            console.log('Mode par défaut - affichage formation');
            if (formationContainer) {
                formationContainer.style.display = 'block';
                if (formationSelect) formationSelect.setAttribute('required', '');
            }
        }
    }
    
    // Écouter les changements sur le select "Objet de la demande"
    if (objetDemandeSelect) {
        objetDemandeSelect.addEventListener('change', updateFormFields);
        // Initialiser l'affichage au chargement
        updateFormFields();
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
                action: 'send_formation_form', // Action spécifique pour le formulaire de formation
                nom: formData.get('nom'),
                prenom: formData.get('prenom'),
                email: formData.get('email'),
                telephone: formData.get('telephone'),
                statut: formData.get('statut'),
                objetdemande: formData.get('objetdemande'),
                formation: formData.get('formation'),
                date_suggestion: formData.get('date_suggestion'),
                date_formation: formData.get('date_formation'),
                messager: formData.get('messager'), // Note: votre textarea s'appelle "messager"
                consentement: formData.get('consentement') ? '1' : ''
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
                console.log("Demande de formation envoyée avec succès!");
                statusMessage.textContent = res.data || 'Votre demande de formation a été envoyée avec succès!';
                statusMessage.style.display = 'block';
                statusMessage.style.backgroundColor = '#42b883';
                statusMessage.style.color = '#ffffff';
                statusMessage.style.border = '1px solid #2d8659';
                
                form.reset();
                
                // Réinitialiser l'affichage des champs conditionnels
                if (formationContainer) formationContainer.style.display = 'none';
                if (dateSuggestionContainer) dateSuggestionContainer.style.display = 'none';
                if (dateFormationContainer) dateFormationContainer.style.display = 'none';
                
            } else {
                console.log("Erreur lors de l'envoi de la demande de formation.");
                statusMessage.textContent = res.data || 'Une erreur est survenue. Veuillez réessayer.';
                statusMessage.style.display = 'block';
                statusMessage.style.backgroundColor = '#ff5252';
                statusMessage.style.color = '#ffffff';
                statusMessage.style.border = '1px solid #c41c1c';
            }
            
            // Masquer le message après 10 secondes
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