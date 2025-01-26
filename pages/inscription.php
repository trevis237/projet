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
    <link rel="stylesheet" href="../css/inscription.css">
</head>
<body>
    <div class="wrapper">
        <nav class="nav">
            <div class="nav-logo">
                <p>HOME</p>
            </div>
            <div class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="#" class="link active">home</a></li>
                    <li><a href="#" class="link">blog</a></li>
                    <li><a href="#" class="link">service</a></li>
                    <li><a href="#" class="link">about</a></li>
                </ul>
            </div>
            <div class="nav-button">
                <button class="btn white-btn" id="loginbtn" onclick="login()">sing in</button>
                <button class="btn" id="registerbtn" onclick="register()">sing up</button>
            </div>
            <div class="nav-menu-btn">
                <i class="fa-solid fa-bars" onclick="myMenuFonction()"></i>
            </div>
        </nav>
        
        <!-- formulaire -->
         <div class="form-box">
            <!-- formulaire connexion -->
                <form action="../php/traiter_connexion.php" method="post" class="login-container" id="login">
                    <div class="top">
                        <span>vous avez un compte? <a href="#" onclick="register()">connexion</a></span>
                        <header>connexion</header>
                    </div>
                   
                    <div class="input-box">
                        <input type="email" name="mail" class="input-field" id="" placeholder="votre nom ou email">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" class="input-field" id="" placeholder="votre password">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="input-box">
                        <input type="submit" name="" class="submit" id="" value="connexion">
                    <div class="two-col">
                        <div class="one">
                            <input type="checkbox" name="" class="" id="login-check">
                            <label for="login-check">se souvenir de moi</label>
                        </div>
                        <div class="two">
                            <label for=""><a href="">mot de passe oublier?</a></label>
                        </div>
                    </div>
                 </div>
                </form>

            <!-- formulaire inscription -->
<?php
            $mail=$_GET['email'];

?>

                <form action="../php/traiter_inscription.php" method="post" class="register-container" id="register">
                    <div class="top">
                        <span>avez vous un compte? <a href="#" onclick="login()">s'incrire</a></span>
                        <header>inscription</header>
                    </div>
                    <!-- <div class="two-forms">
                        <div class="input-box">
                            <input type="text" name="nom" class="input-field" id="" placeholder="votre nom">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="input-box">
                            <input type="text" name="prenom" class="input-field" id="" placeholder="votre prenom">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    </div> -->
                    
                    <div class="input-box">
                        <input type="email" name="mail" class="input-field" id="" value="<?php echo $mail; ?>" placeholder="votre email" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" class="input-field" id="" placeholder="votre password" required>
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <!-- <div class="input-box">
                        <input type="password" name="cpassword" class="input-field" id="" placeholder="confirmer votre password" required>
                        <i class="fa-solid fa-lock"></i>
                    </div> -->
                    <div class="input-box">
                        <input type="submit" name="" class="submit" id="" value="s'inscrire">
                    <div class="two-col">
                        <div class="one">
                            <input type="checkbox" name="" class="" id="register-check">
                            <label for="register-check">se souvenir de moi</label>
                        </div>
                        <div class="two">
                            <label for=""><a href="">terme et condition</a></label>
                        </div>
                    </div>
                 </div>
             </form>
            
             
    </div>

    <script>
        function myMenuFonction(){
            var i = document.getElementById("navMenu");

            if(i.className === "nav-menu") {

                i.className += " responsive"
            }else{
                i.className = "nav-menu"
            }
        }
    </script>

    <script>
        var a = document.getElementById("loginbtn");
        var b = document.getElementById("registerbtn");
        var x = document.getElementById("login");
        var y = document.getElementById("register");

        function login(){
            x.style.left = "4px";
            y.style.right = "-520px";
            a.className += " white-btn";
            a.className = "btn";
            x.style.opacity = 1;
            y.style.opacity = 0;
        }
        function register(){
            x.style.left = "-510px";
            y.style.right = "5px";
            a.className = "btn";
            a.className += " white-btn";
            x.style.opacity = 0;
            y.style.opacity = 1;
        }

    </script>

</body>
</html>