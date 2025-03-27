<?php
include('connexion.php');
session_start();

$mail = $_POST['mail'] ?? '';
$password = $_POST['password'] ?? '';
//$_SESSION['nom']=$mail;

if (!empty($mail) && !empty($password)) {
    // Préparation de la requête pour éviter les injections SQL
    $requete = $bdd->prepare("SELECT id_user, statut, password FROM user WHERE email = :mail");
    $requete->execute(["mail" => $mail]);

    // Vérifiez si l'utilisateur existe
    if ($requete->rowCount() > 0) {
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        $statut = $result['statut'];
        $id = $result['id_user'];
        $_SESSION['nom']=$mail;
        $_SESSION['id']=$id;

    //if($result){
        // session_start();

     // $_SESSION['id']=$id;}
        
        // Vérification du mot de passe
        if (password_verify($password, $result['password'])) {
           // $_SESSION['id_user'] = $result['id_user'];
            
            // Vérification de la catégorie
            if ($result['statut'] > 0) {
                if(isset($_SESSION['id'])){
                    $user=$_SESSION['id'];
                   }else{
                       $user=null;
                   }
                header('Location: ../pages/dashboard.php');
            } else {
                if(isset($_SESSION['locataire'])){
                    $user=$_SESSION['locataire'];
                   }else{
                       $user=null;
                   }
                header('Location: ../pages/index2.php');
            }
            exit;
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Email ou mot de passe incorrect.";
    }
} else {
    echo "Veuillez remplir tous les champs.";
}
?>