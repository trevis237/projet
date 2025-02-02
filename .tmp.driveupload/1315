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
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <div class="side-menu">
        <div class="brand-name">
            <h1>brand</h1>
        </div>
        <ul>
            <li><i class="fa-solid fa-bars"></i>&nbsp; <span>dashboard</span></li>
            <li><i class="fa-solid fa-home"></i>&nbsp; <a href="dash_propriete.php"><span>ma propriete</span></a></li>
            <li><i class="fa-solid fa-user"></i>&nbsp; <a href="dash_locataire.php"><span>mes locataires</span></a></li>
            <li><i class="fa-solid fa-bars"></i>&nbsp; <span>statistique</span></li>
            <li><i class="fa-solid fa-money-bill"></i>&nbsp; <span>bilan mensuel</span></li>
            <li><i class="fa-solid fa-money-bill"></i>&nbsp; <span>total recette</span></li>
            <li><i class="fa-solid fa-out"></i>&nbsp; <a href="../php/deconexion.php"><span>quitter</span></a></li>
        </ul>
    </div>
    <div class="container">
    <?php
                    include('../php/connexion.php');
                    if(isset($_SESSION['nom'])){
                        // echo'acun';
                        $user=$_SESSION['nom'];
                    }else{
                        $user=null;
                    }
                    ?>
        <div class="header">
            <div class="nav">
                <div class="seach">
                    <input type="text" name="seach" id="" placeholder="recherche..">
                    <button type="submit" value=""><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div class="user">
                    <a href="#" class="btn">add new</a>
                    <i class="fa-regular fa-bell"></i>
                </div>
                <div class="case">
                    <a href=""><i class="fa-solid fa-user"><?php echo $user ?></i></a>
                    <a href=""></a>
                </div>
            </div>
        </div> 
        <!-- <div class="content">
            <div class="cards">
                <div class="card">
                        <div class="box">     
                            <h1>2194</h1>
                            <h3>locataires</h3>
                        </div>
                            
                        <div class="icon-case">
                            <i class="fa-solid fa-person"></i>
                        </div>
                </div>
                
                <div class="card">
                        <div class="box">     
                            <h1>219406 XAF</h1>
                            <h3>revenu</h3>
                        </div>
                            
                        <div class="icon-case">
                            <i class="fa-solid fa-money-bill"></i>
                        </div>
                </div>
                
                <div class="card">
                    <div class="box">     
                        <h1>4</h1>
                        <h3>appart libre</h3>
                    </div>
                        
                    <div class="icon-case">
                        <i class="fa-solid fa-home"></i>
                    </div>
                </div>
                
                <div class="card">
                    <div class="box">     
                        <h1>4</h1>
                        <h3>appart libre</h3>
                    </div>
                        
                    <div class="icon-case">
                        <i class="fa-solid fa-person"></i>
                    </div>
                </div>
            </div>
            <div class="content-2">
                <div class="recent-payments">
                    <div class="title">
                        <h2>payement recents</h2>
                        <a href="#" class="btn">view all</a>
                    </div>
                    
                    <table>
                        <tr>
                            <th>nom</th>
                            <th>date</th>
                            <th>montant</th>
                            <th>nature</th>
                            <th>nombre de jours</th>
                        </tr>
                        <tr>
                            <td>sonna</td>
                            <td>05/01/2025</td>
                            <td>100000 XAF</td>
                            <td><a href="#" class="btn">voir</a></td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>sonna</td>
                            <td>05/01/2025</td>
                            <td>100000 XAF</td>
                            <td><a href="#" class="btn">voir</a></td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>sonna</td>
                            <td>05/01/2025</td>
                            <td>100000 XAF</td>
                            <td><a href="#" class="btn">voir</a></td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>sonna</td>
                            <td>05/01/2025</td>
                            <td>100000 XAF</td>
                            <td><a href="#" class="btn">voir</a></td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>sonna</td>
                            <td>05/01/2025</td>
                            <td>100000 XAF</td>
                            <td><a href="#" class="btn">voir</a></td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>sonna</td>
                            <td>05/01/2025</td>
                            <td>100000 XAF</td>
                            <td><a href="#" class="btn">voir</a></td>
                            <td>4</td>
                        </tr>
                    </table>
                </div>
                <div class="new-locataire">
                    <div class="title">
                        <h2>nouveau locataire</h2>
                        <a href="#" class="btn">view all</a>
                    </div>
                    <table>
                        <tr>
                            <th>profil</th>
                            <th>nom</th>
                            <th>date entree</th>
                            <th>date depart</th>
                            <th>nombre de jours</th>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-user"></i></td>
                            <td>sonna</td>
                            <td>05/01/2025</td>
                            <td>09/01/2025</td>
                            <td>04</td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-user"></i></td>
                            <td>sonna</td>
                            <td>05/01/2025</td>
                            <td>09/01/2025</td>
                            <td>04</td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-user"></i></td>
                            <td>sonna</td>
                            <td>05/01/2025</td>
                            <td>09/01/2025</td>
                            <td>04</td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-user"></i></td>
                            <td>sonna</td>
                            <td>05/01/2025</td>
                            <td>09/01/2025</td>
                            <td>04</td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-user"></i></td>
                            <td>sonna</td>
                            <td>05/01/2025</td>
                            <td>09/01/2025</td>
                            <td>04</td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-user"></i></td>
                            <td>sonna</td>
                            <td>05/01/2025</td>
                            <td>09/01/2025</td>
                            <td>04</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div> -->
    </div>
</body>
</html>