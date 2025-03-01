<!DOCTYPE html>
<?php session_start();?>
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
            <li><i class="fa-solid fa-bars"></i>&nbsp; <a href=""><span>dashboard</span></a> </li>
            <li><i class="fa-solid fa-home"></i>&nbsp; <a href=""><span>ma propriete</span></a></li>
            <li><i class="fa-solid fa-user"></i>&nbsp; <span>mes locataires</span></li>
            <li><i class="fa-solid fa-bars"></i>&nbsp; <span>statistique</span></li>
            <li><i class="fa-solid fa-money-bill"></i>&nbsp; <span>bilan mensuel</span></li>
            <li><i class="fa-solid fa-money-bill"></i>&nbsp; <span>total recette</span></li>
            <li><i class="fa-solid fa-out"></i>&nbsp; <span>quitter</span></li>
        </ul>
    </div>
    <div class="container">
        <?php 
        include('../php/connexion.php');
        if(isset($_SESSION['nom'])){
            // echo'acun';
            $name=$_SESSION['nom'];
        }else{
            $name=null;
        }
        ?>
        <div class="header">
            <div class="nav">
                <div class="seach">
                    <input type="text" name="" id="" placeholder="recherche..">
                    <button type="submit" value=""><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div class="user">
                    <a href="#" class="btn">add new</a>
                    <i class="fa-regular fa-bell"></i>
                </div>
                <div class="case">
                    <a href=""><i class="fa-solid fa-user"><?php echo $name ?></i></a>
                </div>
            </div>
        </div> 
        <div class="content">
            <div class="cards">
                <div class="card">
                        <div class="box">     
                            <h1>2194</h1>
                            <h3>locataires</h3>
                        </div>
                            
                        <div class="icon-case">
                            <!-- <img src="../asset/th (1).jpg" alt=""> -->
                            <i class="fa-solid fa-person"></i>
                        </div>
                </div>
                
                <div class="card">
                        <div class="box">     
                            <h1>219406 XAF</h1>
                            <h3>revenu</h3>
                        </div>
                            
                        <div class="icon-case">
                            <!-- <img src="../asset/th (1).jpg" alt=""> -->
                            <i class="fa-solid fa-money-bill"></i>
                        </div>
                </div>
                
                <div class="card">
                    <div class="box">     
                        <h1>4</h1>
                        <h3>appart libre</h3>
                    </div>
                        
                    <div class="icon-case">
                        <!-- <img src="../asset/th (1).jpg" alt=""> -->
                        <i class="fa-solid fa-home"></i>
                    </div>
                </div>
                
                <div class="card">
                    <div class="box">     
                        <h1>4</h1>
                        <h3>appart libre</h3>
                    </div>
                        
                    <div class="icon-case">
                        <!-- <img src="../asset/th (1).jpg" alt=""> -->
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

                    <?php
                    
                    include('../php/connexion.php');
                    if(isset($_SESSION['id'])){
                        // echo'acun';
                        $user=$_SESSION['id'];
                    }else{
                        $user=null;
                    }
                    $reservation= $bdd->prepare("SELECT u.nom, u.prenom, u.email, u.telephone, r.date_debut, r.date_sortie, r.cout, l.adresse
                     FROM user u, reservation r, logement l
                     WHERE r.id_user = u.id_user AND r.id_reservation = l.id_reservation AND u.statut = 0 AND a.id_user = :user");

                    $reservation->execute(["user"=>$user]);

                    if($reservation->rowCount() > 0){

                    $locataires=$reservation->fetchAll(PDO::FETCH_ASSOC);
                }else{
                    echo "aucun locataire trouve";
                }
                    
?>
                    <table>
                        <tr>
                            <th>nom</th>
                            <th>prenom</th>
                            <th>email</th>
                            <th>telephone</th>
                            <th>date d'entree</th>
                            <th>date de sortie</th>
                            <th>cout</th>
                            <th>adresse</th>
                        </tr>
                        <?php foreach($locataires as $locataire){ ?>
                        <tr>
                            <td><?php echo htmlspecialchars( $locataire['nom']); ?></td>
                            <td><?php echo $loge['prenom'] ?></td>
                            <td><?php echo $loge['email'] ?></td>
                            <td><?php echo $loge['telephone'] ?></td>
                            <td><a href="#" class="btn">voir</a><?php echo $loge['date_debut'] ?></td>
                            <td><?php echo $loge['date_sortie'] ?></td>
                            <td><?php echo $loge['cout'] ?></td>
                            <td><?php echo $loge['adresse'] ?></td>
                        </tr>
                        <?php } ?>
                        <!-- <tr>
                            <td>sonna</td>
                            <td>05/01/2025</td>
                            <td>100000 XAF</td>
                            <td>05/01/2025</td>
                            <td><a href="#" class="btn">voir</a></td>
                            <td>4</td>
                            <td>05/01/2025</td>
                            <td>05/01/2025</td>
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
                        </tr> -->
                    </table>
                </div>
                <!-- <div class="new-locataire">
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
                </div> -->
            </div>
        </div>
    </div>
</body>
</html>