<?php
$id_locataire = $bdd->query("SELECT max(id_locataire) as id_locataire FROM locataire");
$id=$id_locataire->fetch(PDO::FETCH_ASSOC);
if(!empty($id_locataire)){
    session_start();
    $_SESSION['id_locataire']=$id['id_locataire'];
    // header('location:../pages/inscription_locataire.php');
}
?>