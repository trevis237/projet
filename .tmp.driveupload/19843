
    // Récupère les éléments des inputs
    const startDateInput = document.getElementById('start-date');
    const endDateInput = document.getElementById('end-date');
    const textInput = document.getElementById('text-input');
    const numberInput = document.getElementById('number-input');
    const saveButton = document.getElementById('send');

    // Fonction pour charger les valeurs depuis le stockage local
    function loadValues() {
        const startDate = localStorage.getItem('startDate');
        const endDate = localStorage.getItem('endDate');
        const textValue = localStorage.getItem('textValue');
        const numberValue = localStorage.getItem('numberValue');

        if (startDate) {
            startDateInput.value = startDate; // Charge la date de début
        }
        if (endDate) {
            endDateInput.value = endDate; // Charge la date de fin
        }
        if (textValue) {
            textInput.value = textValue; // Charge le texte
        }
        if (numberValue) {
            numberInput.value = numberValue; // Charge le nombre
        }
    }

    // Événement pour enregistrer les valeurs dans le stockage local et rediriger
    saveButton.addEventListener('click', () => {
        localStorage.setItem('startDate', startDateInput.value); // Enregistre la date de début
        localStorage.setItem('endDate', endDateInput.value); // Enregistre la date de fin
        localStorage.setItem('textValue', textInput.value); // Enregistre le texte
        localStorage.setItem('numberValue', numberInput.value); // Enregistre le nombre
        window.location.href = '../pages/appar_dispo.php'; // Redirige vers la page suivante
    });

    // Charge les valeurs lors du chargement de la page
    loadValues();