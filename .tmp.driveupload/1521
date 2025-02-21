<?php

session_start();
include("connexion.php"); 
include 'envoie_mail.php';



$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['mail'];
$telephone = $_POST['telephone'];
$statut = 0;
$senderEmail = 'trevisscott47@gmail.com';

// requete permetant     de selectioner l'adresse du bailleur
if(isset($_SESSION['proprietaire'])){
    echo $proprio = $_SESSION['proprietaire'];
 
    $id= $bdd->query("SELECT email FROM user WHERE id_user = '$proprio' AND statut = '1'");
    $mail_proprio = $id->fetch(PDO::FETCH_ASSOC);
    $ownerEmail = $mail_proprio['email'];
 }else{
     $proprio = null;
 }


if(!empty($nom) && !empty($prenom) && !empty($email) && !empty($telephone)) {


    
// $recipientEmail = $_POST['email'];


    // $tab=$requetes->fetch();
    // $email= $tab['email'];

    //verification de l'unicite de l'email
    $chekEmail = $bdd->prepare("SELECT * FROM user WHERE email = :mail AND statut = '0'");

    $chekEmail->execute(["mail"=>$email]);
    if($chekEmail->rowCount() > 0) {
        echo "cet email est deja utilise";
    }else{
        $requetes = $bdd->prepare("INSERT INTO user(nom, prenom, email, telephone, password, statut) VALUES (:nom, :prenom, :email, :telephone, '', :statut)");
    
        $requetes->execute(["nom"=>$nom,"prenom"=>$prenom,"email"=>$email,"telephone"=>$telephone,"statut"=>$statut]);

        $subjectToTenant = 'confirmation de votre reservation'; //objet pour l'email du locataire
        $bodyToTenant = 'Merci, votre reseration a ete confirme !'; //corps de l'email pour le locataire

        $subjectToOwner = 'Nouvelle reservation'; //objet pour l'email du proprietaire
        $bodyToOwner = 'un nouvel utilisateur a fait une reservation.Detail:...'; //corps de l'email pour le proprietaire

        //envoyer l'email au locataire
        if(sendMail($senderEmail ,$email, $subjectToTenant, $bodyToTenant)) {
            echo 'un email de confirmation a ete envoye au locataire.'; //message de succes pour le locataire
        }else{
            echo 'L\'email de confirmation au locataire n\'a pas pu etre envoye.'; //message d'erreur' pour le locataire
        }

        //envoyer l'email au proprietaire
        if(sendMail($senderEmail ,$ownerEmail, $subjectToOwner, $bodyToOwner)) {
            echo 'un email de notification a ete envoye au proprietaire.'; //message de succes pour le proprietaire
        }else{
            echo 'L\'email de notification n\'a pas pu etre envoye.'; //message d'erreur' pour le proprietaire
        }

        header('location:../pages/inscription_locataire.php?email='.$email);
  }

}
  
?>