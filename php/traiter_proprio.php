<?php
include("connexion.php");

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mail = $_POST['mail'];
$telephone = $_POST['telephone'];
$statut = 1;

if(!empty($nom) && !empty($prenom) && !empty($mail) && !empty($telephone)) {


    

    //verification de l'unicite de l'email
    $chekEmail = $bdd->prepare("SELECT * FROM user WHERE email = :mail");

    $chekEmail->execute(["mail"=>$mail]);
    if($chekEmail->rowCount() > 0) {
        echo "cet email est deja utilise";
    }else{
        $requetes = $bdd->prepare("INSERT INTO user(nom, prenom, email, telephone, password, statut) VALUES (:nom, :prenom, :email, :telephone, '', :statut)");
    
        $requetes->execute(["nom"=>$nom,"prenom"=>$prenom,"email"=>$mail,"telephone"=>$telephone,"statut"=>$statut]);

        // $tab=$requetes->fetch();
        // $email= $tab['email'];

       

        header('location:../pages/inscription.php?email='.$mail);
  }
}
?>