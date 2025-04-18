<!DOCTYPE html>
<?php 
        session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/appart_dispo.css">
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

    <div class="transi">
        <marquee behavior="" direction=""><h1>bienvenu chez vous</h1></marquee>
    </div>
    <form action="">
        <div class="container">
            <div class="adresse">
                <input type="text" name="localisation" id="" class="champ" placeholder="veullez saisir l'adresse">
            </div>
            <div class="adresse">
                <input type="date" name="debut" id="" class="champ">
            </div>
            <div class="adresse">
                <input type="date" name="fin" id="" class="champ">
            </div>
            <div class="adresse">
                <input type="number" name="personne" id="" class="champ" placeholder="combien etes vous?">
            </div>
            <div class="adresse">
                <input type="submit" id="send" value="envoyer">
            </div>
        </div>
    </form>

    <section class="corps">
        <div class="filtrer">
            <div class="legend">
                <h3 class="checkbox">filtre</h3>
            </div>
            <label for="" class="checkbox">prix</label>
            <input type="range" class="checkbox" name="" id=""><br><br><br>
            <input type="checkbox" class="checkbox" name="" id="">
            <span>menagere</span><br>
            <input type="checkbox" name="" id=""class="checkbox">
            <span>parking</span><br>
            <input type="checkbox" name="" id="" class="checkbox">
            <span>gardien</span><br>
            <input type="checkbox" name="" id="" class="checkbox">
            <span>groupe electrogene</span><br>
            <input type="checkbox" name="" id="" class="checkbox">
            <span>beignoire</span><br>
            <input type="checkbox" name="" id="" class="checkbox">
            <span></span>
        </div>

        <?php 
        include("../php/connexion.php");
       // $user=0;

        $id=$_GET['ids'] ?? null;
        //convertir la chaine en tableau
      $idArray= explode(',', $id);
       $nbjours=$_GET['nbjours'];
        $debut=$_GET['debut'];
        $fin=$_GET['fin'];
        if($id=== null || empty($id)){
            die("manque");
        }

        // echo $total;
        if(!empty($idArray)){
            $placeholders = str_repeat('?,', count($idArray) -1) . '?';
        $requetes = $bdd->prepare("SELECT * FROM logement l WHERE Id_logement  IN ($placeholders)
        AND NOT EXISTS (SELECT 1 FROM reservation r 
        WHERE r.Id_logement = l.Id_logement AND r.date_sortie >= NOW())
        ORDER BY prix ASC LIMIT 25");


        $requetes->execute($idArray);
        $logements=$requetes->fetchAll(PDO::FETCH_ASSOC);
    }else{
        $logements = [];
    }


         ?>


        <div class="content">
            <?php

            // if($logements){
            // foreach($logements as $logement) {
            //     $id_loge = $logement['Id_logement'];
            //     $proprio=$logement['id_user'];
            //      $prix= $logement['prix'];
            //      $total = (int)$prix * $nbjours;


// Fonction pour chiffrer une valeur
function encrypt($data, $key) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}

// Génération d'une clé sécurisée (à conserver de manière sécurisée)
$key = '2c6ee24b09816a6f14f95d1698b24eadc4b1e2e6d4c4f8c6a5a9e6723c3c3f5a'; // À ne pas changer à chaque exécution

if ($logements) {
    foreach ($logements as $logement) {
        $id_loge = $logement['Id_logement'];
        // Chiffrez l'ID logement
        $encrypted_id_logement = encrypt($id_loge, $key);
        // $proprio=$logement['id_user'];

        $prix = $logement['prix'];
        $total = (int)($prix * $nbjours);

        // Stockez le prix dans la session
        $_SESSION['prix'] = $total;

        // Créez l'URL sans passer le prix
        $link = "./reservation.php?id_loge={$encrypted_id_logement}";

        // Affichez ou utilisez le lien
       // echo $link;
    


                // $link="./reservation.php?id_loge=".$id_loge."&pu=".$total;

                //conservavtion des detail de la table reservation
                $_SESSION['debut'] = $debut;
                $_SESSION['fin'] = $fin;
                $_SESSION['total'] = $total;
                $_SESSION['logements'] = $id_loge;
                 
              // $_SESSION['proprietaire']=$proprio; ?>
                 


            
            <div class="s">
                <div>
                    <a href="<?php echo $link ?>"><img src="<?php echo $logement["photo"]; ?>" alt="" class="tof"></a>
                
                </div>
                <div class="desc">
                    <h1><?php echo $logement["nom"] ?></h1>
                    <a href="">localisation : <?php echo $logement["adresse"]; ?></a>
                    <div class="span">
                        
                        <span>ville : <?php echo $logement["ville"]. " " .$logement["code_postal"]; ?></span>
                        <!-- <span><?php echo $logement["code_postal"]; ?></span> -->
                    </div>
                    <span>surface:<?php echo $logement["surface"] ?>m2</span>
                    <span>prix total= <?php echo  $logement["prix"] ?> XAF</span>
                    <p>nature: <?php echo $logement["nature"] ?><br><?php echo $logement["description"] ?></p>
                    <a href="<?php echo $link ?>" ><input type="submit"  class="bouton" value="reserver"></a>
                </div>
            </div>
        <?php } ?>

        <?php }else{
            echo "Les logement correspondant a cette adresse ne sont pas disponible pour le moment.<br> Veullez changer d'adresse ou repasser plus tard.<br> Merci et a bientot";
        }
        
        ?>
            <!-- <div class="s">
                <div>
                    <img src="../asset/premium_photo-1676321046262-4978a752fb15.jpeg" alt="" class="tof">
                
                </div>
                <div class="desc">
                    <h1>residence cyrille</h1>
                    <a href="">ouvrir l'emplacement sur la carte</a>
                    <p>appartement 1 salon 2 chambre 2 douche 1 cuisine 1 salle a amnge</p>
                    <input type="submit" class="bouton" value="rechercher">
                </div>
            </div> -->
        </div>
    </section>
    <section id="bas">
        <div class="city">
            <img src="../asset/cdcca441.jpg" alt="" class="tof">
            <h5>douala</h5>
        </div>
        <div class="city">
            <img src="../asset/photo-1499916078039-922301b0eb9b.jpeg" alt="" class="tof">
            <h5>yaounde</h5>
        </div>
        <div class="city">
            <img src="../asset/photo-1512918728675-ed5a9ecdebfd.jpeg" alt="" class="tof">
            <h5>douala</h5>
        </div>
        <div class="city">
            <img src="../asset/photo-1512918728675-ed5a9ecdebfd.jpeg" alt="" class="tof">
            <h5>douala</h5>
        </div>
        <div class="city">
            <img src="../asset/photo-1512918728675-ed5a9ecdebfd.jpeg" alt="" class="tof">
            <h5>douala</h5>
        </div>
        <script>
            const burgerMenuButton = document.querySelector('.burger-menu-button')
            const burgerMenuButtonIcon = document.querySelector('.burger-menu-button i')
            const burgerMenu = document.querySelector('.burger-menu')
    
            burgerMenuButton.onclick = function(){
                burgerMenu.classList.toggle('open')
                const isOpen = burgerMenu.classList.contains('open')
                burgerMenuButtonIcon.classList = isOpen ? 'fa-solid fa-xmark' : 'fa-solid fa-bars'
            }
    
        </script>
</body>
</html>