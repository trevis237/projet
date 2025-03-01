<!DOCTYPE html>
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
                <a class="lien" href="#">HOME</a>
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

        // $id=$_GET['id'];
        // $nbjours=$_GET['nbjours'];
        // $pu=$_GET['pu'];

        // $total = (int)$pu * $nbjours;
        // echo $total;

        $requetes = $bdd->query("SELECT * FROM logement");


        $requetes->fetch();

         ?>


        <div class="content">
            <?php
            foreach($requetes as $requete) {?>

            
            <div class="s">
                <div>
                    <a href="./reservation.php"><img src="<?php echo $requete["photo"]; ?>" alt="" class="tof"></a>
                
                </div>
                <div class="desc">
                    <h1><?php echo $requete["nom"] ?></h1>
                    <a href="">localisation : <?php echo $requete["adresse"]; ?></a>
                    <div class="span">
                        
                        <span>ville : <?php echo $requete["ville"]. " " .$requete["code_postal"]; ?></span>
                        <!-- <span><?php echo $requete["code_postal"]; ?></span> -->
                    </div>
                    <span>surface:<?php echo $requete["surface"] ?>m2</span>
                    <span>prix = <?php echo $requete["prix"] ?> XAF</span>
                    <p>nature: <?php echo $requete["nature"] ?><br><?php echo $requete["description"] ?></p>
                    <a href="./reservation.php"><input type="submit"  class="bouton" value="rechercher"></a>
                </div>
            </div>
        <?php } ?>
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