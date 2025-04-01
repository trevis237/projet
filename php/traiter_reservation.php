<?php

session_start();
include("connexion.php"); 
include 'envoie_mail.php';

$date=date('Y-m-d H:i:s');
$action = 'creer';
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['mail'];
$telephone = $_POST['telephone'];
$statut = 0;
$senderEmail = 'trevisscott47@gmail.com';

//insertion dans la table reservation

// requete permetant     de selectioner l'adresse du bailleur
if(isset($_SESSION['proprietaire'])){
    $proprio = $_SESSION['proprietaire'];
 
    $id= $bdd->query("SELECT email FROM user WHERE id_user = '$proprio' AND statut = '1'");
    $mail_proprio = $id->fetch(PDO::FETCH_ASSOC);
    $ownerEmail = $mail_proprio['email'];
 }else{
     $proprio = null;
 }


if(!empty($nom) && !empty($prenom) && !empty($email) && !empty($telephone)) {

    
// $recipientEmail = $_POST['email'];


    // $tab=$requetes->fetch();
    // $email= $tab['email'];

    //verification de l'unicite de l'email
    $chekEmail = $bdd->prepare("SELECT * FROM user WHERE email = :mail AND statut = '0'");

    $chekEmail->execute(["mail"=>$email]);
    if($chekEmail->rowCount() > 0) {
        echo "cet email est deja utilise";
    }else{
        $requetes = $bdd->prepare("INSERT INTO user(nom, prenom, email, telephone, password, statut) VALUES (:nom, :prenom, :email, :telephone, '', :statut)");
    
        $requetes->execute(["nom"=>$nom,"prenom"=>$prenom,"email"=>$email,"telephone"=>$telephone,"statut"=>$statut]);

        $subjectToTenant = 'confirmation de votre reservation'; //objet pour l'email du locataire
        $bodyToTenant = 'Merci, votre reseration a ete confirme !'; //corps de l'email pour le locataire

        $subjectToOwner = 'Nouvelle reservation'; //objet pour l'email du proprietaire
        $bodyToOwner = 'un nouvel utilisateur a fait une reservation.Detail:<br>' .$nom ." ". $prenom . "<br><br>" . $telephone . "<br><br>" . $email; //corps de l'email pour le proprietaire

        //envoyer l'email au locataire
        if(sendMail($senderEmail ,$email, $subjectToTenant, $bodyToTenant)) {
            echo 'un email de confirmation a ete envoye au locataire.'; //message de succes pour le locataire
        }else{
            echo 'L\'email de confirmation au locataire n\'a pas pu etre envoye.'; //message d'erreur' pour le locataire
        }

        //envoyer l'email au proprietaire
        if(sendMail($senderEmail ,$ownerEmail, $subjectToOwner, $bodyToOwner)) {
            echo 'un email de notification a ete envoye au proprietaire.'; //message de succes pour le proprietaire
        }else{
            echo 'L\'email de notification n\'a pas pu etre envoye.'; //message d'erreur' pour le proprietaire
        }

        header('location:../pages/inscription_locataire.php');
  }
  $_SESSION['email_loc']=$email;

  //recuperation de l'identifiant du locataire
  $locataire = $bdd->prepare("SELECT id_user FROM user WHERE email = :mail AND telephone = :phone");
  $locataire->execute(["mail"=>$email, "phone"=>$telephone]);
  $id_loc = $locataire->fetch();
  echo $user = $id_loc['id_user'];

    //isertion dans le table reservation
    if(isset($_SESSION['debut']) && isset($_SESSION['fin']) && isset($_SESSION['total']) && isset($_SESSION['logements'])){
        $debut = $_SESSION['debut'] ;
        $fin = $_SESSION['fin'];
        $total = $_SESSION['total'];
        $id_loge = $_SESSION['logements'];  
    }
   

               // Insertion dans la table reservation
               $req = $bdd->prepare("INSERT INTO reservation(date_debut, date_sortie, cout, Id_logement, id_user) VALUES(:d_start, :d_end, :prix, :id_logement, :id)");

               // Insérer chaque logement avec le coût total
                   $req->execute([
                       "d_start" => $_SESSION['debut'] ,
                       "d_end" => $fin,
                       "prix" => $total,
                       "id_logement" => $id_loge,
                       "id" => $user
                   ]);

                   $request=$bdd->query("SELECT MAX(id_reservation) as reser FROM reservation");
                    $result=$request->fetch(PDO::FETCH_ASSOC);
                    $reser=$result['reser'];

                    $historique = $bdd->prepare("INSERT INTO historique_reservation(date, action, id_reservation) VALUES (:date, :action, :id)");

                    $historique->execute(["date"=>$date, "action"=>$action, "id"=>$reser]);


}
  
?>