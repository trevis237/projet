<?php
include('connexion.php');

$mail = $_POST['mail'];
$password = $_POST['password'];

if(!empty($mail) && !empty($password)){

    $requete = $bdd->prepare("SELECT id_inscription FROM inscription WHERE email= :mail and password= :password");

    $requete->execute(["mail"=>$mail, "password"=>$password]);

    //recuperation du resultat

    $result = $requete->fetch(PDO::FETCH_ASSOC);
    $count = $requete->rowCount();

    if($count > 0) {
        //verification du mot de passe

        if(password_verify($password, $result['password'])) {
            //authentification reussie
            header('location:../pages/appar_dispo.php');
            exit;
        }else{
            //mot de passe incorect
            echo "Email ou mot de passe incorect.";
        }
        
    }else{
        //aucun utilisateur trouve
        echo "Email ou mot de passe incorect";
    }
   
}else{
    echo "remplissez tout les champ svp";
}

?>