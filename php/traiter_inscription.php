<?php
// session_start();

include('connexion.php');

$mail = $_POST['mail'];
$password = $_POST['password'];
$statut= 1;

if(!empty($mail) && !empty($password)){

    $requetes = $bdd->prepare("UPDATE user SET password = :password WHERE email= :mail");

    $requetes->execute(["password"=>$password, "mail"=>$mail]);
    // var_dump($requetes->fetchAll()) ;


        //hachage du mot de passe
        // $hashpassword = password_hash($password, PASSWORD_DEFAULT);

        //verification de l'unicite de l'email
        // $chekEmail = $bdd->prepare("SELECT * FROM user WHERE email = :mail");

        // $chekEmail->execute(["mail"=>$mail]);
        // if($chekEmail->rowCount() > 0) {
        //     echo "cet email est deja utilise";
        // }else{


        header('location:../pages/ajoueter_logement.php');
        // echo "inscription reussie !";
    //  }
}
?>