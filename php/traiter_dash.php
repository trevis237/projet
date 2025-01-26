<?php
session_start();
include('connexion.php');

$_SESSION['id_user']=$id['user'];
$user=$_SESSION['id_user'];

$requete=$bdd->query("SELECT * FROM logement WHERE id_user= $user");

$req=$requete->fetch();

header("location:../pages/dash_propriete.php?id=".$user);

?>