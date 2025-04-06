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
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <a href="#">HYHOUSE</a>
            </div>
            <ul class="links">
                <li><a href="./pages/connexion.php">se connecter</a></li>
                <li><a href="./pages/ajouter_proprietaire.php">mettre mon logement</a></li>
                <li><a href="about">a propos</a></li>
                <li><a href="contact">contact</a></li>
            </ul>
            <div class="case">
                    <a href=""><i class="fa-solid fa-user"></i></a>
                    <a href=""></a>
                </div>
            <div class="buttons">
                <a href="#" class="action-button pro">espace pro</a>
                <a href="./pages/connexion.php" class="action-button">se connecter</a>
            </div>
            <div class="burger-menu-button">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="burger-menu">
            <ul class="links">
                <li><a href="./pages/connexion.php">se connecter</a></li>
                <li><a href="./pages/ajouter_proprietaire.php">mettre mon logement</a></li>
                <li><a href="about">a propos</a></li>
                <li><a href="contact">contact</a></li>
                <div class="divider">a</div>
                <div class="buttons-burger-menu">
                    <a href="#" class="action-button pro">espace pro</a>
                    <a href="./pages/connexion.php" class="action-button">se connecter</a>
                </div>
            </ul>
        </div>
    </header>

    <section class="banner">
    <div class="transi">
        <marquee behavior="" direction=""><h1>bienvenu chez vous</h1></marquee>
    </div>
    <form action="./php/traiter_index.php" method="post">
        <div class="container">
            <div class="adresse">
                <input type="text" name="localisation" id="text-input" class="champ" placeholder="veullez saisir l'adresse" required>
            </div>
            <div class="adresse">
                <input type="date" name="debut" id="start-date" class="champ" required>
            </div>
            <div class="adresse">
                <input type="date" name="fin" id="end-date" class="champ" required>
            </div>
            <div class="adresse">
                <input type="number" name="personne" id="number-input" class="champ" placeholder="combien etes vous?" required>
            </div>
            <div class="adresse">
                <input type="submit" id="send" value="envoyer">
            </div>
        </div>
    </form>

    </section>
    

    <?php

    include("php/connexion.php");



$stmt = $bdd->prepare("    SELECT * 
    FROM logement
    WHERE Id_logement NOT IN (
        SELECT Id_logement 
        FROM reservation
        WHERE date_sortie >= NOW()
    )
");
$stmt->execute([]);

// Récupération des résultats
$appartements = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($appartements)
    ?>
   
<section class="featured">
    <?php if ($appartements) {
            foreach ($appartements as $logement) { 
                $id_loge = $logement['Id_logement'];
                // $proprio=$logement['id_user'];
        
                $prix = $logement['prix'];

                $_SESSION['house']=$id_loge;
                // $total = (int)($prix * $nbjours);?>
    <div class="property">
        
                    
        <img class="tof" src="<?php echo $logement["photo"]; ?>" alt="Logement 1" />
        <h3><?php echo $logement["nom"] ?></h3>
        <span><?php echo $logement["ville"]?></span>
        <span><?php echo $logement["adresse"]. "  " .$logement["code_postal"]; ?></span>
        
        <p><?php echo $logement["surface"] ?>m2</p>
        <span><?php echo  $logement["prix"] ?> XAF/J</span>
        <p>Type:<?php echo "  " .$logement["nature"] ?><br></p>
        <p><?php echo $logement["description"] ?></p>
        <a href="pages/reservation_visit.php?ad=<?php echo $id_loge ?>"><button >Reserver</button></a>
    </div>
    <?php } ?>
    <?php } ?>

    <script>
    function redirectToPage() {
        // Lien de redirection
        window.location.href = "pages/reservation_visit.php"; // Remplacez par l'URL de votre page
    }
</script>
    <!-- <div class="property">
        <img src="asset/cdcca441.jpg" alt="Logement 2" />
        <h3>Logement 2</h3>
        <p>Appartement moderne en centre-ville, proche de toutes commodités.</p>
        <button>Reserver</button>
    </div>
    <div class="property">
        <img src="asset/premium_photo-1676321046262-4978a752fb15.jpeg" alt="Logement 3" />
        <h3>Logement 3</h3>
        <p>Chalet confortable à la montagne, parfait pour l'hiver.</p>
        <button>Reserver</button>
    </div>
    <div class="property">
        <img src="asset/cdcca441.jpg" alt="Logement 2" />
        <h3>Logement 2</h3>
        <p>Appartement moderne en centre-ville, proche de toutes commodités.</p>
        <button>Reserver</button>
    </div>
    <div class="property">
        <img src="asset/cdcca441.jpg" alt="Logement 2" />
        <h3>Logement 2</h3>
        <p>Appartement moderne en centre-ville, proche de toutes commodités.</p>
        <button>Reserver</button>
    </div>
    <div class="property">
        <img src="asset/cdcca441.jpg" alt="Logement 2" />
        <h3>Logement 2</h3>
        <p>Appartement moderne en centre-ville, proche de toutes commodités.</p>
        <button>Reserver</button>
    </div> -->
</section>

    <script src="./javascript/select_date.js"></script>
    <script src="./javascript/garder_cinput.js"></script>
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