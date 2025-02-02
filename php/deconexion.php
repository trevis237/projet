<?php
session_start();
include('connexion.php');
//verifier si l'utilisateur confirme la deconnexion
if(isset($_POST['confirm'])){
    //detruire toute les variables sessions
    $_SESSION = array();
    // detrure la sesssion sur le serveur
    session_destroy();

    // rediriger vers la page de connexion
    header("Location:../pages/connexion.php");
    exit;
}

// verifier si l'utilisateur demande a se deconnecter
if(isset($_GET['logout'])){
    // afficher le formulaire de confirmation
    echo '
<div class="confirm-form">
    <form action="" method="post">
    <p>Etes-vous sur de vouloir vous deconnecter?</p>
    <button class="btn" type="submit" name="confirm">oui</button>
    <a class="btn cancel" href="../pages/dashboard.php">non</a>
    </form>
</div>';
}else{
    // aficher le lien de deconnexion
    echo '<a class="logout-link" href="?logout=1">Deconnexion</a>'; //lien qui declanche le formulaire
}
?>
<style>
    body{
        font-family:'Courier New', Courier, monospace;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }
    .confirm-form {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        max-width: 400px;
        margin: auto;
        text-align: center;
    }
    .confirm-form p{
        margin: 0 0 20px;
        font-size: 18px;
    }
    .btn{
        background-color: #4caf50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        margin: 5px;
    }
    .btn:hover{
        background-color: #45a049;
    }
    .cancel:hover{
        background-color: #d32f2f;

    }
    .logout-link{
        text-decoration: none;
        color: #007BFF;
        font-size: 16px;
    }
    .logout-link:hover{
        text-decoration: underline;
    }

</style>


