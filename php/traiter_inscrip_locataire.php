<?php
//session_start();

include('connexion.php');

$mail = $_POST['mail'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$statut= 0;


if(!empty($mail) && !empty($password) && !empty($cpassword)){

    if($password == $cpassword) {

    $hashpassword = password_hash($password, PASSWORD_DEFAULT);

    $requetes = $bdd->prepare("UPDATE user SET password = :password, cornfirmation_pass = :cpassword WHERE email= :mail");

    $requetes->execute(["password"=>$hashpassword, "cpassword" =>$hashpassword, "mail"=>$mail]);

        header('location:../pages/index2.php');
}else{
    echo "les mots de passe ne corrrespondent pas";
}

//$_SESSION['email_loc']=$mail;
}


?>