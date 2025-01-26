<?php
include("connexion.php");
// include "idLocataire.php";

$localisation = $_POST['localisation'];
$debut = $_POST['debut'];
$fin = $_POST['fin'];
$personne = $_POST['personne'];
$user=1;

$date1 = strtotime($debut);
$date2 = strtotime($fin);
$nb_jours_timestamp = $date2-$date1;
$nb_jours= $nb_jours_timestamp/86400;

if(!empty($localisation)) {

    $requete =$bdd->prepare("SELECT * FROM `logement` WHERE `adresse` = :localisation");

    $requete->execute(["localisation"=>$localisation]);

   $logement=$requete->fetch(PDO::FETCH_ASSOC) ;
    if($logement){
    $id=$logement['Id_logement'];
    $prix=$logement['prix'];

    $total=(int)$prix * $nb_jours;
}
}
//insertion dans reservation
$req = $bdd->prepare("INSERT INTO reservation(date_debut, date_sortie, cout, Id_logement , id_user)
 VALUES(:d_start, :d_end, :prix, :id_logement, :id)");

$req->execute(["d_start"=>$debut, "d_end"=>$fin, "prix"=>$total, "id_logement"=>$id, "id"=>$user]);

header('location:../pages/appar_dispo.php?id='.$id.'&nbjours='.$nb_jours.'&pu='.$prix);
?>