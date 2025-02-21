<?php 
require '../vendor/autoload.php';
//utiliser les classes PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//creer une instance de PHPMailer
function sendMail($from, $to, $subject, $body) {
    //creer une nouvelleinstance de phpmailer
    $mail = new PHPMailer(true);//true active les exceptions

    try {
        //configuration du serveur SMTP
        $mail->isSMTP();//specifie que nous voulons utiliser smtp
        $mail->Host = 'smtp.gmail.com';//serveur smtp
        $mail->SMTPAuth = true; //activer l'authentification smtp
        $mail->Username = $from;
        $mail->Password = 'yldf ehtr ctqi hkum';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587; //port du serveur smtp

        //ajouter lesdestinataires et le cntenu de l'email
        $mail->setFrom($from, 'MYHOUSE'); //l'email de l'expediteur
        //email du destinataire le bailleur dans mon cas
        $mail->addAddress($to);
        
        //contenu de l'email
        $mail->isHTML(true);//indique que le ontenu est en html
        $mail->Subject = $subject; //objet du mail
        $mail->Body = $body; //le corps de l'email
        //envoyer l'email
        $mail->send(); //essayer d'envoyer l'email
        return true; //retourne vrai si l'email es envoye
    }catch (Exception $e) {
        echo 'erreur lors de l\'envoi de l\'email: '.$mail->ErrorInfo;
        //ferer les erreurs
        return false; //retourne false en cas d'erreur
    }
    
}

?>