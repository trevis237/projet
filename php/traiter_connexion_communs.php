<?php
session_start();
include('connexion.php');

$mail = $_POST['mail'];
$password = $_POST['password'];

if(!empty($mail) && !empty($password)){
    $requete = $bdd->prepare("SELECT * FROM user WHERE email = :mail AND password=:pass");

    $requete->execute(["mail"=>$mail,"pass"=>$password]);

    //recuperation du resultat
    $result = $requete->fetch(PDO::FETCH_ASSOC);
    $count = $requete->rowCount();
    $statut = $result['statut'];
    $id = $result['id_user'];
    $_SESSION['nom']=$mail;

    if($result){
        // session_start();

      $_SESSION['id']=$id;}

      if(password_verify($password, $result['password'])) {
    if($count > 0 && $statut > 0) {
        //verification du mot de passe

        // if(password_verify($password, $result['password'])) {
            //authentification reussie proprio
            if(isset($_SESSION['id'])){
               $user=$_SESSION['id'];
              }else{
                  $user=null;
              }
            header('location:../pages/dashboard.php');
            
            exit;
        // }else{
            //mot de passe incorect
          //  echo "mot de passe incorect.";
        // }  
    }else{
        //verification du mot de passe

        // if(password_verify($password, $result['password'])) {
            //authentification reussie locataitre
            if(isset($_SESSION['locataire'])){
                $user=$_SESSION['locataire'];
               }else{
                   $user=null;
               }
               header('location:../pages/index2.php');
             
             exit;
            }
        // }else{
            //mot de passe incorect
           // echo "mot de passe incorect.";
        // } 
         
    }else{
        //aucun utilisateur trouve
        echo "mot de passe incorect";
    }
  
}else{
    echo "remplissez tout les champ svp";
}
?>