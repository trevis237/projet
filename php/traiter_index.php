<?php
session_start();
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
        $_SESSION['logements'] = $logements;
        $_SESSION['nb_jours'] = $nb_jours;
        $_SESSION['debut'] = $debut;
        $_SESSION['fin'] = $fin;

       // Calculer le coût total
      // $total = 0;
     //  foreach ($prix as $p) {
       //    $total += (int)$p * $nb_jours;
      // }
     //  $_SESSION['total'] = $total;

       // Insertion dans la table reservation
      // $req = $bdd->prepare("INSERT INTO reservation(date_debut, date_sortie, cout, Id_logement, id_user) VALUES(:d_start, :d_end, :prix, :id_logement, :id)");

       // Insérer chaque logement avec le coût total
     //  foreach ($ids as $id_logement) {
     //      $req->execute([
      //         "d_start" => $debut,
       //        "d_end" => $fin,
         //      "prix" => $total,
           //    "id_logement" => $id_logement,
             //  "id" => $user
          // ]);
       //}

       // Redirection vers la page des logements disponibles
       header('Location: ../pages/appar_dispo.php?id=' . implode(',', $ids) . '&nbjours=' . $nb_jours . '&db=' . $debut . '&fin=' . $fin);
       exit;
   } else {
       echo "Pas de logement disponible pour l'adresse '$localisation'.";
       //header("Location: ../index.php");
   }

   // if(!empty($logement)){
    //$ids=array_column($logement, 'Id_logement');
    //$idsString=implode(',', $ids);//concatene les idetifiants en une chaine de caractere
    //$prix=array_column($logement,'prix');

   //echo $total=(int)$prix * $nb_jours;

//insertion dans reservation
//$req = $bdd->prepare("INSERT INTO reservation(date_debut, date_sortie, cout, Id_logement , id_user)
 //VALUES(:d_start, :d_end, :prix, :id_logement, :id)");

//$req->execute(["d_start"=>$debut, "d_end"=>$fin, "prix"=>$total, "id_logement"=>$idsString, "id"=>$user]);

//header('location:../pages/appar_dispo.php?id='.$idsString.'&nbjours='.$nb_jours.'&db='.$debut.'&fin='.$fin);
//exit;
//}else{
  //  echo "pas de logement disponible pour l'adresse '$localisation'.";
   // header("location:../index.php");
}
//}
?>