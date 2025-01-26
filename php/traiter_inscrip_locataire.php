<?php
// session_start();

include('connexion.php');

$mail = $_POST['mail'];
$password = $_POST['password'];
$statut= 0;

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


        header('location:../pages/appar_dispo.php');
        // echo "inscription reussie !";
    //  }
}
?>