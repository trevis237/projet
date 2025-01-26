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
    <link rel="stylesheet" href="../css/ajouter_prorietaire.css">
</head>
<body>
    <section class="corps">
        <form class="container" action="../php/traiter_proprio.php" method="post">
            <div>
                <h1>veullez remplir ce formulaire pour vous enregistrer </h1>
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
                <input type="submit" class="submit" value="confirmer">
            </div>
        </form>
    </section>
    <footer>
        <p>copyrigh &copy; 2025 tout droit reserver</p>
    </footer>
</body>
</html>