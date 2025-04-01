<?php
session_start();
include("connexion.php");
include 'envoie_mail.php';

$nom = $_POST['nom'] ?? '';
$prenom = $_POST['prenom'] ?? '';
$mail = $_POST['mail'] ?? '';
$telephone = $_POST['telephone'] ?? '';
$statut = 1;
$senderEmail = 'trevisscott47@gmail.com';

if (!empty($nom) && !empty($prenom) && !empty($mail) && !empty($telephone)) {

    $chekEmail = $bdd->prepare("SELECT * FROM user WHERE email = :mail AND statut = '1'");
    $chekEmail->execute(["mail" => $mail]);

    if ($chekEmail->rowCount() > 0) {
        echo "Cet email est déjà utilisé.";
    } else {
        $requetes = $bdd->prepare("INSERT INTO user(nom, prenom, email, telephone, statut) VALUES (:nom, :prenom, :email, :telephone, :statut)");

        if ($requetes->execute(["nom" => $nom, "prenom" => $prenom, "email" => $mail, "telephone" => $telephone, "statut" => $statut])) {
            $subjectToOwner = 'Bienvenue!';
            $bodyToOwner = "Nous sommes heureux de vous accueillir auprès de notre communauté, Mr/Mme $nom $prenom. 
            Cette plateforme a pour but de vous aider à avoir une grande visibilité afin d'accroître vos revenus. 
            Vivez avec nous une expérience palpitante.";

            // Envoi de l'email
            if (sendMail($senderEmail, $mail, $subjectToOwner, $bodyToOwner)) {
                echo 'Un email de salutation a été envoyé au propriétaire.';
            } else {
                echo 'L\'email de salutation au propriétaire n\'a pas pu être envoyé.';
            }
            var_dump( $_SESSION['nom']=$mail);

            header('Location: ../pages/inscription.php');
            exit();
        } else {
            echo "Erreur lors de l'insertion.";
        }
    }
    
} else {
    echo "Tous les champs doivent être remplis.";
}
?>

// if(!empty($nom) && !empty($prenom) && !empty($mail) && !empty($telephone)) {


    

//     //verification de l'unicite de l'email
//     $chekEmail = $bdd->prepare("SELECT * FROM user WHERE email = :mail AND statut = '1'");

//     $chekEmail->execute(["mail"=>$mail]);
//     if($chekEmail->rowCount() > 0) {
//         echo "cet email est deja utilise";
//     }else{
//         $requetes = $bdd->prepare("INSERT INTO user(nom, prenom, email, telephone, password, statut) VALUES (:nom, :prenom, :email, :telephone, '', :statut)");
    
//         $requetes->execute(["nom"=>$nom,"prenom"=>$prenom,"email"=>$mail,"telephone"=>$telephone,"statut"=>$statut]);

//         // $tab=$requetes->fetch();
//         // $email= $tab['email'];

       

//         header('location:../pages/inscription.php?email='.$mail);
//   }
}
?>