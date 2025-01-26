<?php
// session_start();
include("connexion.php");


$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mail = $_POST['mail'];
$telephone = $_POST['telephone'];
$statut = 0;
$date=date('Y-m-d H:i:s');
$action='creer';

if(!empty($nom) && !empty($prenom) && !empty($mail) && !empty($telephone)) {


    // $tab=$requetes->fetch();
    // $email= $tab['email'];

    //verification de l'unicite de l'email
    $chekEmail = $bdd->prepare("SELECT * FROM user WHERE email = :mail");

    $chekEmail->execute(["mail"=>$mail]);
    if($chekEmail->rowCount() > 0) {
        echo "cet email est deja utilise";
    }else{
        $requetes = $bdd->prepare("INSERT INTO user(nom, prenom, email, telephone, password, statut) VALUES (:nom, :prenom, :email, :telephone, '', :statut)");
    
        $requetes->execute(["nom"=>$nom,"prenom"=>$prenom,"email"=>$mail,"telephone"=>$telephone,"statut"=>$statut]);

        header('location:../pages/inscription_locataire.php?email='.$mail);
  }

  $id=$bdd->query("SELECT MAX(id_user) as id_locataire FROM user");

  $row=$id->fetch(PDO::FETCH_ASSOC);
  $id_locataire=$row['id_locataire'];

  $request=$bdd->query("SELECT MAX(id_reservation) as reser FROM reservation");
  $result=$request->fetch(PDO::FETCH_ASSOC);
  $reser=$result['reser'];

  $req=$bdd->prepare("UPDATE reservation SET id_user = :id WHERE id_reservation = :reser");
  $req->execute(["id"=>$id_locataire, "reser"=>$reser]);
}
  // recuperer id_reservation
  $id_reservation=$bdd->query("SELECT MAX(id_reservation) as idR FROM reservation");
  $tabl=$id_reservation->fetch(PDO::FETCH_ASSOC);
  $idR=$tabl['idR'];

  //remplire historiqueReservation

  $historique = $bdd->prepare("INSERT INTO historique_reservation(date, action, id_reservation) VALUES (:date, :action, :id)");

  $historique->execute(["date"=>$date, "action"=>$action, "id"=>$idR]);

  
?>