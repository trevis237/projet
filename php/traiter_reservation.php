<?php
session_start();
include("connexion.php");
require_once '../Mail/MailSender.php';


$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mail = $_POST['mail'];
$telephone = $_POST['telephone'];
$statut = 0;


if(!empty($nom) && !empty($prenom) && !empty($mail) && !empty($telephone)) {
    
$successMessage = '';
$errorMessage = '';

    
// $recipientEmail = $_POST['email'];
// requete permetant     de selectioner l'adresse du bailleur
if(isset($_SESSION['proprietaire'])){
   echo $proprio = $_SESSION['proprietaire'];
}else{
    $proprio = null;
}
// $recuperation->seelct email from logement where id_user= $id_proprio;
$propriotaire = $bdd->query("SELECT email FROM user WHERE id_user = '$proprio' AND statut = '1'");
$mail_proprio= $propriotaire->fetch(PDO::FETCH_ASSOC);
echo $mail=$propriotaire['email'];
    $mailSender = new MailSender();
    $mailSender->setsubject("Bonjour mr/Mme vous avez un nouveau client dans votre appartement");
    $mess = 'Bienvenue sur cette application';
    $mailSender->setMessage($mess);
    $mailSender->setrecipient($mail);//prend en compte le recipient du mail
// $db->prepare
    if ($mailSender->sendMail()) {
        $successMessage = "L'email a été envoyé avec succès à $mail.";
    } else {
        $errorMessage = "Une erreur s'est produite lors de l'envoi de l'email : " . $mailSender->getresult();
    }
}


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

        // header('location:../pages/inscription_locataire.php?email='.$mail);
  }


  
?>