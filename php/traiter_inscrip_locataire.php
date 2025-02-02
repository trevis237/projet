<?php
session_start();

include('connexion.php');

$mail = $_POST['mail'];
$password = $_POST['password'];
$statut= 0;
$date=date('Y-m-d H:i:s');
$action='creer';

if(!empty($mail) && !empty($password)){

    $requetes = $bdd->prepare("UPDATE user SET password = :password WHERE email= :mail");

    $requetes->execute(["password"=>$password, "mail"=>$mail]);


        //hachage du mot de passe
        // $hashpassword = password_hash($password, PASSWORD_DEFAULT);

        //verification de l'unicite de l'email
        // $chekEmail = $bdd->prepare("SELECT * FROM user WHERE email = :mail");

        // $chekEmail->execute(["mail"=>$mail]);
        // if($chekEmail->rowCount() > 0) {
        //     echo "cet email est deja utilise";
        // }else{


        header('location:../index.php');
        // echo "inscription reussie !";
    //  }
}
//recuperer l'id du locataire pour mettre dans la session et l'ajouter dans reservation
$id_locataire=$bdd->prepare("SELECT id_user FROM user WHERE email = :email AND password = :pass");

    $id_locataire->execute(["email"=>$mail,"pass"=>$password]);

    $id=$id_locataire->fetch();

if($id){
    // session_start();

  $_SESSION['locataire']=$id['id_user'];
  $client=$_SESSION['locataire'];
}

$request=$bdd->query("SELECT MAX(id_reservation) as reser FROM reservation");
$result=$request->fetch(PDO::FETCH_ASSOC);
$reser=$result['reser'];

$req=$bdd->prepare("UPDATE reservation SET id_user = :id WHERE id_reservation = :reser");
$req->execute(["id"=>$client, "reser"=>$reser]);

// recuperer id_reservation
// $id_reservation=$bdd->query("SELECT MAX(id_reservation) as idR FROM reservation");
// $tabl=$id_reservation->fetch(PDO::FETCH_ASSOC);
// $idR=$tabl['idR'];

//remplire historiqueReservation

$historique = $bdd->prepare("INSERT INTO historique_reservation(date, action, id_reservation) VALUES (:date, :action, :id)");

$historique->execute(["date"=>$date, "action"=>$action, "id"=>$reser]);

?>