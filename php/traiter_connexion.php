<?php
include('connexion.php');
session_start();
$mail = $_POST['mail'];
$password = $_POST['password'];

if(!empty($mail) && !empty($password)){

    $requete = $bdd->prepare("SELECT id_inscription FROM inscription WHERE password=:pass and email= :mail");

    $requete->execute(["mail"=>$mail, "pass"=>$password]);

    //recuperation du resultat

    $count = $requete->rowCount();

    if($count > 0) {
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        if($result['categorie'] > 0){

            
            if(isset($_SESSION['id_user'])){
                  $user=$_SESSION['id_user'];
              }else{
                  $user=null;
              };
        //verification du mot de passe

        // if(password_verify($password, $result['password'])) {
            //authentification reussie
            header('location:../pages/dashboard.php');
            exit;
        // }elseif($result['id_proprietaire']=null){
        //     header('location:../pages/appar_dispo.php');
        //     exit;
        }else{
            if(isset($_SESSION['id_user'])){
                echo  $user=$_SESSION['id_user'];
              }else{
                  $user=null;
              }
            
            header('location:../pages/appar_dispo.php');
            exit;
            // echo "vous n'existez pas";
        }
        // }else{
        //     //mot de passe incorect
        //     echo "mot de passe incorect.";
        // }
        
    }else{
        //aucun utilisateur trouve
        echo "Email ou mot de passe incorect";
    }
   
}else{
    echo "remplissez tout les champ svp";
}

?>