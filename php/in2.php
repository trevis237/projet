<?php
session_start();
include("connexion.php");

// Vérifier si les données ont été soumises
$message = ""; // Variable pour stocker le message d'erreur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $localisation = $_POST['localisation'] ?? '';
    $debut = $_POST['debut'] ?? '';
    $fin = $_POST['fin'] ?? '';
    $personne = $_POST['personne'] ?? '';
    
    // Afficher les données soumises pour débogage
    // var_dump($_POST);
    
    // Calculer le nombre de jours entre les dates de début et de fin
    $date1 = strtotime($debut);
    $date2 = strtotime($fin);
    $nb_jours = ($date2 - $date1) / 86400;

    if ($localisation && $nb_jours > 0) {
        // Requête pour sélectionner les logements correspondants
        $requete = $bdd->prepare("SELECT * FROM logement WHERE adresse LIKE :localisation OR ville LIKE :localisation");
        $requete->execute(["localisation" => '%' . $localisation . '%']);
        
        // Vérifiez les erreurs de la requête
        if ($requete->errorCode() != '00000') {
            $message = "Erreur lors de la recherche : " . implode(", ", $requete->errorInfo());
        } else {
            $logements = $requete->fetchAll(PDO::FETCH_ASSOC);
            
            if (!empty($logements)) {
                // Stocker les informations dans la session pour la redirection
                $_SESSION['logements'] = $logements;
                $_SESSION['nb_jours'] = $nb_jours;
                $_SESSION['debut'] = $debut;
                $_SESSION['fin'] = $fin;

                // Redirection vers la page des logements disponibles
                header('Location: ../pages/appar_dispo.php');
                exit;
            } else {
                // Message d'erreur
                $message = "Pas de logement disponible pour l'adresse '$localisation'.";
            }
        }
    } else {
        // Message d'erreur pour dates invalides
        $message = "Veuillez entrer une localisation valide et des dates correctes.";
    }
}
?>



<!-- Affichage du message d'erreur dans une boîte de dialogue -->
<?php if ($message): ?>
    <script>
        alert("<?php echo addslashes($message); ?>");
    </script>
<?php endif; ?>