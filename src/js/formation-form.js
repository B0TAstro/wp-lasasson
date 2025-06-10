document.addEventListener('DOMContentLoaded', function() {
    const objetDemandeSelect = document.getElementById('objetdemande');
    const formationContainer = document.getElementById('formation-container');
    const formationSelect = document.getElementById('formation');
    const dateSuggestionContainer = document.getElementById('date-suggestion-container');
    const dateFormationContainer = document.getElementById('date-formation-container');
    const dateSuggestionField = document.getElementById('date_suggestion');
    const dateFormationField = document.getElementById('date_formation');
    
    // Fonction pour mettre à jour l'affichage des champs
    function updateFormFields() {
        const selectedValue = objetDemandeSelect.value;
        
        console.log('Valeur sélectionnée:', selectedValue); // Debug
        
        // Reset des champs
        formationSelect.value = '';
        if (dateSuggestionField) dateSuggestionField.value = '';
        if (dateFormationField) dateFormationField.value = '';
        
        // Masquer tous les champs conditionnels d'abord
        formationContainer.style.display = 'none';
        dateSuggestionContainer.style.display = 'none'; 
        dateFormationContainer.style.display = 'none';
        
        // Retirer les attributs required
        formationSelect.removeAttribute('required');
        dateSuggestionField.removeAttribute('required');
        dateFormationField.removeAttribute('required');
        
        // Logique selon la sélection
        if (selectedValue === 'Suggestion' || selectedValue === 'suggestion') {
            console.log('Mode Suggestion activé');
            
            // Afficher seulement le champ date de suggestion
            dateSuggestionContainer.style.display = 'block';
            dateSuggestionField.setAttribute('required', '');
            
        } else if (selectedValue === 'Réclamation' || selectedValue === 'reclamation' || selectedValue === 'Reclamation') {
            console.log('Mode Réclamation activé');
            
            // Afficher formation ET date de formation
            formationContainer.style.display = 'block';
            dateFormationContainer.style.display = 'block';
            formationSelect.setAttribute('required', '');
            dateFormationField.setAttribute('required', '');
            
        } else if (selectedValue === 'Formation' || selectedValue === 'formation') {
            console.log('Mode Formation activé');
            
            // Afficher seulement le champ formation
            formationContainer.style.display = 'block';
            formationSelect.setAttribute('required', '');
            
        } else {
            console.log('Mode par défaut');
            
            // Mode par défaut - afficher seulement formation
            formationContainer.style.display = 'block';
            formationSelect.setAttribute('required', '');
        }
    }
    
    // Écouter les changements sur le select "Objet de la demande"
    if (objetDemandeSelect) {
        objetDemandeSelect.addEventListener('change', function() {
            console.log('Changement détecté sur objetdemande');
            updateFormFields();
        });
        
        // Initialiser l'affichage au chargement de la page
        updateFormFields();
    } else {
        console.error('Element objetdemande non trouvé');
    }
    
    // Debug - vérifier que tous les éléments existent
    console.log('objetDemandeSelect:', objetDemandeSelect);
    console.log('formationContainer:', formationContainer);
    console.log('dateSuggestionContainer:', dateSuggestionContainer);
    console.log('dateFormationContainer:', dateFormationContainer);
});