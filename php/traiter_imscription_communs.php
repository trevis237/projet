<?php

include('connexion.php');

$mail = $_POST['mail'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$id_proprietaire = null;
$id_locataire = null;

if(!empty($mail) && !empty($password) && !empty($cpassword)){

    if($password != $cpassword){
        echo 'mot de passe incorect';
        exit;
    }else{

        //hachage du mot de passe
        $hashpassword = password_hash($password, PASSWORD_DEFAULT);

        //verification de l'unicite de l'email
        $chekEmail = $bdd->prepare("SELECT * FROM user WHERE email = :mail");

        $chekEmail->execute(["mail"=>$mail]);
        if($chekEmail->rowCount() > 0) {
            echo "cet email est deja utilise";
        }else{

            //recuperer l'id de l'utilisteur insere
            

    $requete = $bdd->prepare("INSERT INTO inscription (email,password,confirmation_password,id_proprietaire,id_locataire) 
    VALUES(:mail,:password,:cpassword,:id_proprietaire,:id_l)");

    if($requete->execute(["mail"=>$mail, "password"=>$hashpassword, "cpassword"=>$hashpassword,
    "id_proprietaire"=>$id_proprietaire, "id_l"=>$id_locataire])) {

        header('location:../pages/appart_dispo_communs.php');
        // echo "inscription reussie !";
    }else{
        echo "erreur lors de l'inscription veillez reessayer.";
    }
    }
}
}
?>