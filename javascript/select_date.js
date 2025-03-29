
    // Récupère les éléments des inputs de date
    const startDateInput = document.getElementById('start-date');
    const endDateInput = document.getElementById('end-date');

    // Fonction pour limiter la sélection des dates dans les inputs
    function setInputDateLimits() {
        const today = new Date(); // Crée un objet Date pour aujourd'hui
        const todayString = today.toISOString().split('T')[0]; // Format ISO pour la date actuelle (YYYY-MM-DD)
        
        startDateInput.setAttribute('min', todayString); // Définit la date minimale pour l'input de début
        endDateInput.setAttribute('min', todayString); // Définit la date minimale pour l'input de fin
    }

    // Met à jour la date de fin si elle est avant la date de début
    startDateInput.addEventListener('change', () => {
        const startDate = new Date(startDateInput.value); // Récupère la date de début
        const endDate = new Date(endDateInput.value); // Récupère la date de fin

        // Si la date de fin est avant la date de début, la mettre à jour
        if (endDate < startDate) {
            endDateInput.value = ''; // Réinitialise la date de fin
        }
    });

    setInputDateLimits(); // Définit les limites des inputs de date