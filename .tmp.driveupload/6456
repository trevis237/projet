<?php
session_start();
include('connexion.php');
$seach=$_POST['seach'];

if(isset($_SESSION['id'])){
    // echo'acun';
    $user=$_SESSION['id'];
}else{
    $user=null;
}

if(!empty($seach)){

    $recherche = $bdd->prepare("SELECT u.*, r.* FROM user u, logement l 
    WHERE u.nom LIKE:seach OR
    u.prenom LIKE:seach OR
    u.email LIKE:seach OR
    l.nom LIKE:seach OR
    l.adresse LIKE:seach OR
    l.ville LIKE:seach OR
    l.code_postal LIKE:seach AND 
    u.id_user=l.id_user AND
    u.id_user = :user AND");

    $recherche->execute(["seach"=>"%$seach%", "user"=>$user]);
    $result=$recherche->fetchAll(PDO::FETCH_ASSOC);

}
?>