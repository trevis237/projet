function filterTable() {
    // on recupere la valeur que l'utilisateur a entree
    const input = document.getElementById('search');
    // on converti en minuscule pour rendre la recherche insensible a la casse
    const filter = input.value.toLowerCase();
    // on recupere le tableau
    const table = document.getElementById('tenantTable');
    // on recupere toutes les lignes du tableau
    const tr = document.getElementsByTagName('tr');

    // on parcourt toutes les lignes du tableau
    // et on commence a 1 pour ignorer l'entete
    for(let i = 1; i < tr.length; i++){
        // on recupere les cellules de la ligne actuelle
        const td = tr[i].getElementsByTagName('td');
        // pour savoir si la ligne doit etre affiche
        let rowVisible = false;
        // on parcourt toutes les cellules de la ligne
        for(let j = 0; j < td.length; j++){
            if(td[j]){
                // on recuper le texte de la cellule 
                const cellValue = td[j].textContent || td[j].innerText;
                // si la valeur de la cellule contient le texte
                if(cellValue.toLowerCase().indexOf(filter) > -1){
                    // on marque la ligne comme visible
                    rowVisible = true;
                    // on sort de la boucle car on a trouve une correspondance
                    break;
                }
            }
        }
        // on affiche ou masque la ligne en fonction de rowvisible
        tr[i].style.display = rowVisible ? "" : "none"; //"" signifie visible, "none" signifi masque
    }
}