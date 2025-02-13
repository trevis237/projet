<?php
require_once 'MailSender.php';

$successMessage = '';
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
// $recipientEmail = $_POST['email'];
// requete permetant     de selectioner l'adresse du bailleur
$id_proprio=$_GET[];
$recuperation->seelct email from logement where id_user= $id_proprio;
    $mailSender = new MailSender();
    $mailSender->setsubject("Un test sur les mails");
    $mess = 'Bienvenue sur cette application';
    $mailSender->setMessage($mess);
    $mailSender->setrecipient($recuperation);//prend en compte le recipient du mail
// $db->prepare
    if ($mailSender->sendMail()) {
        $successMessage = "L'email a été envoyé avec succès à $recipientEmail.";
    } else {
        $errorMessage = "Une erreur s'est produite lors de l'envoi de l'email : " . $mailSender->getresult();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Envoyer un Email</title>
</head>
<body>
    <?php if (!empty($successMessage)): ?>
        <p style="color: green;"><?php echo $successMessage; ?></p>
    <?php endif; ?>

    <?php if (!empty($errorMessage)): ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <form action="index.php" method="post">
        <label for="email">Adresse Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>