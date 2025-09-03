// js/candidature-form.js

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('candidatureForm');
    if (!form) return;

    // Gestion de l'affichage conditionnel du select "Offres d'Emplois"
    const objetSelect = document.getElementById("objet");
    const offreSelectRow = document.getElementById("offre-select-row");
    if (objetSelect && offreSelectRow) {
        objetSelect.addEventListener("change", function () {
            if (this.value === "Offres d'Emplois") {
                offreSelectRow.style.display = "block";
            } else {
                offreSelectRow.style.display = "none";
            }
        });
    }

    // Initialisation des inputs de type fichier
    function setupFileInputs() {
        const fileInputs = form.querySelectorAll('input[type="file"]');
        fileInputs.forEach(fileInput => {
            setupFileInput(fileInput.id);
        });
    }
    // Fonction pour configurer le style des inputs de fichier
    function setupFileInput(inputId) {
        const fileInput = document.getElementById(inputId);
        if (!fileInput) return;
        const existingWrapper = fileInput.closest('.custom-file-upload');
        if (existingWrapper) {
            const parent = existingWrapper.parentElement;
            parent.insertBefore(fileInput, existingWrapper);
            existingWrapper.remove();
        }
        const wrapper = document.createElement("div");
        wrapper.className = "custom-file-upload";
        const customButton = document.createElement("div");
        customButton.className = "custom-file-button";
        customButton.textContent = "Choisir un fichier";
        // Rebuild le DOM
        const parent = fileInput.parentElement;
        parent.insertBefore(wrapper, fileInput);
        wrapper.appendChild(customButton);
        wrapper.appendChild(fileInput);
        fileInput.addEventListener("change", function () {
            if (this.files.length > 0) {
                customButton.textContent = this.files[0].name;
            } else {
                customButton.textContent = "Choisir un fichier";
            }
        });
    }
    setupFileInputs();

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

    // Fonction pour réinitialiser tous les inputs de type fichier
    function resetFileInputs() {
        const fileInputs = form.querySelectorAll('input[type="file"]');
        fileInputs.forEach(fileInput => {
            // Cloner et remplacer l'élément input
            const newInput = fileInput.cloneNode(false);
            fileInput.parentNode.replaceChild(newInput, fileInput);
            // Réinitialiser le texte du bouton
            const customButton = newInput.previousSibling;
            if (customButton && customButton.classList.contains('custom-file-button')) {
                customButton.textContent = "Choisir un fichier";
            }
            newInput.addEventListener("change", function () {
                if (this.files.length > 0) {
                    customButton.textContent = this.files[0].name;
                } else {
                    customButton.textContent = "Choisir un fichier";
                }
            });
        });
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const submitBtn = form.querySelector('.btn-submit');
        const originalButtonText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Envoi en cours...';

        const formData = new FormData(form);
        formData.append('action', 'send_candidature_form');

        // Si l'élément offre_poste est visible (sinon pas l'envoyer)
        const offrePoste = document.getElementById('offre_poste');
        if (offrePoste && offrePoste.closest('#offre-select-row').style.display !== 'none') {
            formData.append('offre_poste', offrePoste.value);
        }

        try {
            const res = await fetch(WP.ajaxUrl, {
                method: 'POST',
                body: formData,
            });

            if (!res.ok) throw new Error('Erreur réseau');

            const json = await res.json();
            console.log('Réponse reçue:', json);

            submitBtn.disabled = false;
            submitBtn.textContent = originalButtonText;

            if (json.success) {
                statusMessage.textContent = json.data || 'Votre candidature a été envoyée avec succès !';
                statusMessage.style.backgroundColor = '#42b883';
                statusMessage.style.color = '#ffffff';
                statusMessage.style.border = '1px solid #2d8659';

                form.reset();
                resetFileInputs();

            } else {
                statusMessage.textContent = json.data || 'Une erreur est survenue. Veuillez réessayer.';
                statusMessage.style.backgroundColor = '#ff5252';
                statusMessage.style.color = '#ffffff';
                statusMessage.style.border = '1px solid #c41c1c';
            }

            statusMessage.style.display = 'block';
            setTimeout(() => {
                statusMessage.style.opacity = '0';
                setTimeout(() => {
                    statusMessage.style.display = 'none';
                    statusMessage.style.opacity = '1';
                }, 300);
            }, 10000);

        } catch (error) {
            console.error('Erreur:', error);
            submitBtn.disabled = false;
            submitBtn.textContent = originalButtonText;
            statusMessage.textContent = 'Une erreur de réseau est survenue. Veuillez réessayer.';
            statusMessage.style.backgroundColor = '#ff5252';
            statusMessage.style.color = '#ffffff';
            statusMessage.style.border = '1px solid #c41c1c';
            statusMessage.style.display = 'block';
            setTimeout(() => {
                statusMessage.style.opacity = '0';
                setTimeout(() => {
                    statusMessage.style.display = 'none';
                    statusMessage.style.opacity = '1';
                }, 300);
            }, 10000);
        }
    });
});