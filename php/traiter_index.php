<?php
// session_start();
include("connexion.php");
// include "idLocataire.php";

$localisation = $_POST['localisation'];
$debut = $_POST['debut'];
$fin = $_POST['fin'];
$personne = $_POST['personne'];
$user=0;

$date1 = strtotime($debut);
$date2 = strtotime($fin);
$nb_jours_timestamp = $date2-$date1;
$nb_jours= $nb_jours_timestamp/86400;

if($localisation) {

    $requete =$bdd->prepare("SELECT * FROM logement WHERE adresse LIKE :localisation OR ville LIKE :localisation");

    $requete->execute(["localisation"=>'%'.$localisation.'%']);

  // $logement=$requete->fetchAll(PDO::FETCH_ASSOC);

   $logement = $requete->fetchAll(PDO::FETCH_ASSOC);
    
   if (!empty($logement)) {
       // Récupérer les identifiants et les prix
       $ids = array_column($logement, 'Id_logement');
      // $prix = array_column($logement, 'prix');

        
        $url = '../pages/appar_dispo.php?ids='.implode(',', $ids).'&nbjours='.$nb_jours. '&debut='.$debut. '&fin='.$fin;

       // Redirection vers la page des logements disponibles
       header("Location: $url");
       exit;
   } else {
       echo "Pas de logement disponible pour l'adresse $localisation.";
   }
}

?>