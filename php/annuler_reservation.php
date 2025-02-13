<?php
session_start();
include('connexion.php');

try{
    $annuler = $bdd->prepare("DELETE FROM reservation ORDER BY id_reservation DESC LIMIT 1");
    $annuler->execute();

    //verifier si une ligne a ete suprimer
    if($annuler->rowCount() > 0){
        header('location:../index.php');
        echo "reservation annuler avec succes";
    }else{
        echo "aucune reservation supprimer";
    }
}catch (PDOException $e){
    echo "erreur: ". $e->getMessage();
}
?>