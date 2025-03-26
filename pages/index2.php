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
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <header>
        <?php
        include('../php/connexion.php');
        if(isset($_SESSION['email_loc'])){
            // echo'acun';
            $mail=$_SESSION['email_loc'];
          //  $mail=$_SESSION['email_loc'];
        }else{
            $mail=null;
        }
        
        ?>
        <div class="navbar">
            <div class="logo">
                <a href="#">HYHOUSE</a>
            </div>
            <ul class="links">
                <li><a href="connexion.php">se connecter</a></li>
                <li><a href="ajouter_proprietaire.php">mettre mon logement</a></li>
                <li><a href="about">a propos</a></li>
                <li><a href="contact">contact</a></li>
            </ul>
            <div class="case">
                    <a href=""><i class="fa-solid fa-user"></i></a>
                    <a href=""><?php echo $mail ?></a>
                </div>
            <div class="buttons">
                <a href="#" class="action-button pro">espace pro</a>
                <a href="connexion.php" class="action-button">se connecter</a>
            </div>
            <div class="burger-menu-button">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="burger-menu">
            <ul class="links">
                <li><a href="connexion.php">se connecter</a></li>
                <li><a href="ajouter_proprietaire.php">mettre mon logement</a></li>
                <li><a href="about">a propos</a></li>
                <li><a href="contact">contact</a></li>
                <div class="divider">a</div>
                <div class="buttons-burger-menu">
                    <a href="#" class="action-button pro">espace pro</a>
                    <a href="connexion.php" class="action-button">se connecter</a>
                </div>
            </ul>
        </div>
    </header>

    <div class="transi">
        <marquee behavior="" direction=""><h1>bienvenu chez vous</h1></marquee>
    </div>
    <form action="./php/traiter_index.php" method="post">
        <div class="container">
            <div class="adresse">
                <input type="text" name="localisation" id="" class="champ" placeholder="veullez saisir l'adresse" required>
            </div>
            <div class="adresse">
                <input type="date" name="debut" id="" class="champ" required>
            </div>
            <div class="adresse">
                <input type="date" name="fin" id="" class="champ" required>
            </div>
            <div class="adresse">
                <input type="number" name="personne" id="" class="champ" placeholder="combien etes vous?" required>
            </div>
            <div class="adresse">
                <input type="submit" id="send" value="envoyer">
            </div>
        </div>
    </form>
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