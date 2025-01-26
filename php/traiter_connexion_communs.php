<?php
include('connexion.php');

$mail = $_POST['mail'];
$password = $_POST['password'];

if(!empty($mail) && !empty($password)){
    $requete = $bdd->prepare("SELECT * FROM inscription WHERE email = :mail AND password=:pass");

    $requete->execute(["mail"=>$mail,"pass"=>$password]);

    //recuperation du resultat
    $result = $requete->fetch(PDO::FETCH_ASSOC);
    $count = $requete->rowCount();

    if($count > 0 ) {
        //verification du mot de passe

        if(password_verify($password, $result['password'])) {
            //authentification reussie
            header('location:../pages/appart_dispo_communs.php');
            exit;
        }else{
            //mot de passe incorect
            echo "mot de passe incorect.";
        }  
    }else{
        //aucun utilisateur trouve
        echo "Email ou mot de passe incorect";
    }
  
}else{
    echo "remplissez tout les champ svp";
}
?>