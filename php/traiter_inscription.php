<?php
session_start();

include('connexion.php');

$mail = $_POST['mail'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$statut= 1;


if(!empty($mail) && !empty($password) && !empty($cpassword)){

    if($password == $cpassword) {

    $hashpassword = password_hash($password, PASSWORD_DEFAULT);

    $requetes = $bdd->prepare("UPDATE user SET password = :password, cornfirmation_pass = :cpassword WHERE email= :mail");

    $requetes->execute(["password"=>$hashpassword, "cpassword" =>$hashpassword, "mail"=>$mail]);
    //garder l'dentifiant du proprietaire dans une session
    
    $id_proprio=$bdd->prepare("SELECT id_user FROM user WHERE email = :email AND password = :pass AND statut = :stat");

    $id_proprio->execute(["email"=>$mail,"pass"=>$hashpassword,"stat"=>$statut]);

    $id=$id_proprio->fetch();
    
 // var_dump(  $_SESSION['nom']=$mail);
    if($id){

    echo  $_SESSION['id']=$id['id_user'];
     header('location:../pages/ajoueter_logement.php');
    }
   
        
        

    }else{
        echo "les mots de passe ne corrrespondent pas";
    }
}
?>