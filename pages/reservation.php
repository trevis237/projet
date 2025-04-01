<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/reservatio.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <a class="lien" href="#">MYHOUSE</a>
            </div>
            <ul class="links">
                <li><a class="lien" href="hero">accueil</a></li>
                <li><a class="lien" href="media">media</a></li>
                <li><a class="lien" href="about">a propos</a></li>
                <li><a class="lien" href="contact">contact</a></li>
            </ul>
            <div class="buttons">
                <a  href="" class="action-button pro">espace pro</a>
                <a  href="./inscription.php" class="action-button">se connecter</a>
            </div>
            <div class="burger-menu-button">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="burger-menu">
            <ul class="links">
                <li><a class="lien" href="hero">accueil</a></li>
                <li><a class="lien" href="media">media</a></li>
                <li><a class="lien" href="about">a propos</a></li>
                <li><a class="lien" href="contact">contact</a></li>
                <div class="divider"></div>
                <div class="buttons-burger-menu">
                    <a href="" class="action-button pro">espace pro</a>
                    <a href="" class="action-button">se connecter</a>
                </div>
            </ul>
        </div>
    </header>
    <?php
    include('../php/connexion.php');
    // Fonction pour déchiffrer une valeur
    // function decrypt($data, $key) {
    //     list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    //     return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
    // }

    // Fonction pour déchiffrer une valeur
function decrypt($data, $key) {
    $decoded_data = base64_decode($data);
    if ($decoded_data === false) {
        die("Erreur de décodage base64.");
    }

    list($encrypted_data, $iv) = explode('::', $decoded_data, 2);
    
    if (!$iv) {
        die("IV manquant dans le déchiffrement.");
    }

    $decrypted = openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
    
    if ($decrypted === false) {
        die("Erreur de déchiffrement : " . openssl_error_string());
    }

    return $decrypted;
}

// Clé utilisée pour le déchiffrement (doit être la même que pour le chiffrement)
$key = '2c6ee24b09816a6f14f95d1698b24eadc4b1e2e6d4c4f8c6a5a9e6723c3c3f5a'; // Exemple de clé sécurisée

// Vérifier si l'ID chiffré est présent dans l'URL
if (isset($_GET['id_loge'])) {
    $encrypted_id_logement = $_GET['id_loge'];

    // Déchiffrer l'ID du logement
    $id_logement = decrypt($encrypted_id_logement, $key);
    
   
    
        // Vérifiez si le prix est stocké dans la session
        if (isset($_SESSION['prix'])) {
            $prix_total = $_SESSION['prix'];
    
        } else {
            echo "Aucun prix trouvé pour cette réservation.";
        }
    // } else {
    //     echo "Aucun ID de logement fourni.";
    // }
    

    // $total=$_GET['pu'];
    //  if(isset($_GET['id_loge'])) {
     // echo  $id=$_GET['id_loge'];
        $identifiants= $bdd->query("SELECT * FROM logement WHERE Id_logement = '$id_logement'");
        $pdos= $identifiants->fetchAll(PDO::FETCH_ASSOC);
        // $proprietaire=$identifiants['id_user'];
       // $link="../php/annuler_reservation.php?id_loge=".$id."&pu=".$total?>
    
    <section class="corps">
        <div class="conteneur">
            <div class="cadre">
            <?php 
            foreach ($pdos as $pdo ) { 
                $_SESSION['proprietaire']=$pdo['id_user'];?>
                <div class="entete">
                    <img class="image" src="<?php echo $pdo['photo'] ?>" alt="">
                </div>
                <div class="desc">
                    <h3><?php echo $pdo['nom'] ?></h3>
                    <p><?php echo $pdo['description'] ?></p>
                    <ul class="list">
                        <li>nature: <?php echo $pdo['nature'] ?></li>
                        <li>prix: <?php echo $prix_total?> XAF</</li>
                        <li>code postal: <?php echo $pdo['code_postal'] ?></li>
                    </ul>
                </div>
                <div class="pied">
                    <div class="pied1">
                        <a class="card-link" href=""><?php echo $pdo['ville'] ?></</a>
                    </div>
                    <div class="pied2">  
                        <a class="card-link" href=""><?php echo $pdo['adresse'] ?></a>
                    </div>
                </div>
            <div class="button">
            <button onclick="history.back()" class="submit back">modifier</button>
                
            </div>
              <?php   } ?>
            </div>
        </div>
        <?php  } ?>
        <form class="container" action="../php/traiter_reservation.php" method="post">
            <div>
                <h1>veullez remplir ce formulaire pour reserver </h1>
            </div>
                <div class="two-forms">
                    <div class="input-box">
                        <input type="text" name="nom" class="input-field" id="" placeholder="votre nom">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="text" name="prenom" class="input-field" id="" placeholder="votre prenom">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
            
            
            <div class="input-box">
                <input type="email" name="mail" class="input-field" id="" placeholder="votre email">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="input-box">
                <input type="text" name="telephone" class="input-field" id="" placeholder="votre telephone">
                <i class="fa-solid fa-phone"></i>
            </div>
            <div class="button">
                <input type="submit" class="submit" value="reserver">
            </div>
        </form>
    </section>
    <footer>
        <p>copyrigh &copy; 2025 tout droit reserver</p>
    </footer>
</body>
</html>