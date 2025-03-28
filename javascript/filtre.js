
        function filterTable() {
            // On récupère la valeur que l'utilisateur a entrée
            const input = document.getElementById('search');
            // On convertit en minuscule pour rendre la recherche insensible à la casse
            const filter = input.value.toLowerCase();
            // On récupère le tableau
            const table = document.getElementById('tenantTable');
            // On récupère toutes les lignes du tableau
            const tr = table.getElementsByTagName('tr');

            // On parcourt toutes les lignes du tableau, en commençant à 1 pour ignorer l'entête
            for (let i = 1; i < tr.length; i++) {
                // On récupère les cellules de la ligne actuelle
                const td = tr[i].getElementsByTagName('td');
                // Pour savoir si la ligne doit être affichée
                let rowVisible = false;

                // On parcourt toutes les cellules de la ligne
                for (let j = 0; j < td.length; j++) {
                    if (td[j]) {
                        // On récupère le texte de la cellule 
                        const cellValue = td[j].textContent || td[j].innerText;
                        // Si la valeur de la cellule contient le texte
                        if (cellValue.toLowerCase().indexOf(filter) > -1) {
                            // On marque la ligne comme visible
                            rowVisible = true;
                            // On sort de la boucle car on a trouvé une correspondance
                            break;
                        }
                    }
                }
                // On affiche ou masque la ligne en fonction de rowVisible
                tr[i].style.display = rowVisible ? "" : "none"; // "" signifie visible, "none" signifie masqué
            }
        }
