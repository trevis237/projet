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

        // Stocker les informations dans la session pour la redirection
        // $_SESSION['logements'] = $logements;
        // $_SESSION['nb_jours'] = $nb_jours;
        // $_SESSION['debut'] = $debut;
        // $_SESSION['fin'] = $fin;

        //creation de la cle secrete
        $secretKey = "ma cle";

        //fonction pour creer une signature
        function createSignature($data,$secretKey) {
          return hash_hmac('sha256', $data, $secretKey);
        }

        //creation de la chaine de donnees a signer
        $data = http_build_query(['ids'=>implode(',', $ids),'nbjours'=>$nb_jours, 'debut'=>$debut, 'fin'=>$fin]);
        $signature = createSignature($data, $secretKey);

        //url avec parametre signes
        $url = "../pages/appar_dispo.php?$data&$signature=$signature";

       // Redirection vers la page des logements disponibles
       header("Location: $url");
       exit;
   } else {
       echo "Pas de logement disponible pour l'adresse $localisation.";
   }
}

?>