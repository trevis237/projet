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

    if(isset($_SESSION['logements']) && isset($_GET['nb_jours'])){
        $id_logement=$_SESSION['logements'];
        $nb_jours=$_GET['nb_jours'];
    }else{
        echo "identifiant inconnu";
    }

    
        $identifiants= $bdd->query("SELECT * FROM logement WHERE Id_logement = '$id_logement'");
        $pdos= $identifiants->fetchAll(PDO::FETCH_ASSOC);
        ?>
    
    <section class="corps">
        <div class="conteneur">
            <div class="cadre">
            <?php 
            foreach ($pdos as $pdo ) { 
                $total= $pdo['prix']*$nb_jours;
                $_SESSION['total']=$total;
                //$_SESSION['proprietaire']=$pdo['id_user'];?>
                <div class="entete">
                    <img class="image" src="<?php echo $pdo['photo'] ?>" alt="">
                </div>
                <div class="desc">
                    <h3><?php echo $pdo['nom'] ?></h3>
                    <p><?php echo $pdo['description'] ?></p>
                    <ul class="list">
                        <li>nature: <?php echo $pdo['nature'] ?></li>
                        <li>prix: <?php echo $total ?> XAF</li>
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
        <?php   ?>
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