<?php
include('connexion.php');

//pour copier le chemin vers la photo on va creer une constante
define("URL", "http://". $_SERVER["HTTP_HOST"] . "/projet/");
define("RACINE_SITE", $_SERVER["DOCUMENT_ROOT"] . "/projet/");

$nom=$_POST['nom'];
$adresse=$_POST['adresse'];
$surface=$_POST['surface'];
$prix=$_POST['prix'];
$path_photo_dbb;
$description=$_POST['description'];
$ville=$_POST['ville'];
$code_postal=$_POST['code_postal'];
$nature=$_POST['nature'];

if(!empty($nom) && !empty($adresse) && !empty($surface) && !empty($prix) && !empty($description) && !empty($ville) && !empty($code_postal) && !empty($nature)){

    $extention = strrchr($_FILES['photo']['name'], ".");
    if(isset($_FILES) && !empty($_FILES['photo']['name'])) {

        // //on recupere le nom de la photo
        // $nom_photo = $_FILES['photo']['name'];
        $nom_photo = "logement_". time() . $extention;
        //copier vers le chemin vers le serveur en bdd
        $path_photo_dbb = URL ."asset/" . $nom_photo;
       // echo $path_photo_dbb;

        //on copie sur le serveur
        $path_folder = RACINE_SITE . "asset/" . $nom_photo;

        copy($_FILES['photo']['tmp_name'], $path_folder);
    }
    $id_user=$bdd->query("SELECT MAX(id_user) as id_proprietaire FROM user");
    
    $row=$id_user->fetch(PDO::FETCH_ASSOC);
    $id_proprietaire=$row['id_proprietaire'];


    $requete = $bdd->prepare("INSERT INTO logement( nom, adresse, surface, prix, photo, description, ville, code_postal, nature, id_user)
     VALUES (:nom,:adresse,:surface,:prix,:tof,:description,:ville,:code_postal,:nature, :id)");

     $requete->execute(["nom"=>$nom,"adresse"=>$adresse,"surface"=>$surface,"prix"=>$prix,"tof"=>$path_photo_dbb,"description"=>$description,"ville"=>$ville,"code_postal"=>$code_postal,"nature"=>$nature, "id"=>$id_proprietaire]);
}
// $id_logement= $bdd->query("SELECT max(id_logement) as id_logement FROM logement");

// $id=$id_logement->fetch(PDO::FETCH_ASSOC);
// if(!empty($id_logement)){
//  session_start();
//  $_SESSION['id_logement']=$id['id_logement'];
// $logement = $requete->fetch();
// $id=$logement['Id_logement'];

header('location:../pages/dashboard.php');

?>