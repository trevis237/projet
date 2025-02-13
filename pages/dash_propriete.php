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
    <script src="../javascript/filtre.js"></script>
</head>
<body>
    <div class="side-menu">
        <div class="brand-name">
            <h1>brand</h1>
        </div>
        <ul>
            <li><i class="fa-solid fa-bars"></i>&nbsp; <a href=""><span>dashboard</span></a> </li>
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
            $name=$_SESSION['nom'];
        }else{
            $name=null;
        }
        ?>
        <div class="header">
            <div class="nav">
                <div class="seach">
                    <input type="text" name="" id="search" placeholder="recherche.." onkeyup="filterTable()">
                    <button onclick="filterTable()" type="submit" value=""><i class="fa-solid fa-magnifying-glass"></i></button>
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
                    
                <?php
                    if(isset($_SESSION['id'])){
                        // echo'acun';
                        $user=$_SESSION['id'];
                    }else{
                        $user=null;
                    }
                    $nbres=$bdd->prepare("SELECT COUNT(u.id_user) 
                    FROM user u, reservation r, logement l
                     WHERE  u.id_user=r.id_user AND l.Id_logement=r.Id_logement AND l.id_user= :user AND u.statut='0'");

                    $nbres->execute(["user"=>$user]);
                    $total=$nbres->fetchColumn();
                    

                    ?>
                        <div class="box">
                            <h1><?php echo $total ?></h1>
                            <h3>locataires</h3>
                        </div>
                            
                        <div class="icon-case">
                            <!-- <img src="../asset/th (1).jpg" alt=""> -->
                            <i class="fa-solid fa-person"></i>
                        </div>
                </div>
                
                <div class="card">
                        <div class="box">
                        <?php
                    if(isset($_SESSION['id'])){
                        // echo'acun';
                        $user=$_SESSION['id'];
                    }else{
                        $user=null;
                    }
                    $som=$bdd->prepare("SELECT SUM(r.cout) 
                    FROM user u, reservation r, logement l
                     WHERE  u.id_user=r.id_user AND l.Id_logement=r.Id_logement AND l.id_user= :user AND u.statut='0'");

                    $som->execute(["user"=>$user]);
                    $sommes=$som->fetchColumn();
                    

                    ?>     
                            <h1><?php echo $sommes ?> XAF</h1>
                            <h3>revenu</h3>
                        </div>
                            
                        <div class="icon-case">
                            <!-- <img src="../asset/th (1).jpg" alt=""> -->
                            <i class="fa-solid fa-money-bill"></i>
                        </div>
                </div>
                
                <div class="card">    
                <?php
                    if(isset($_SESSION['id'])){
                        // echo'acun';
                        $user=$_SESSION['id'];
                    }else{
                        $user=null;
                    }
                    $biens=$bdd->prepare("SELECT COUNT(*) as total_non_occupe
                    FROM logement l
                     WHERE l.id_user= :user");
                    $biens->execute(["user"=>$user]);
                    $all=$biens->fetchColumn();
                    

                    ?>
                    <div class="box">     
                        <h1><?php echo $all ?></h1>
                        <h3>nombre d'appartement</h3>
                    </div>
                        
                    <div class="icon-case">
                        <i class="fa-solid fa-home"></i>
                    </div>
                </div>
                
                <div class="card"> 
                <?php
                    if(isset($_SESSION['id'])){
                        // echo'acun';
                        $user=$_SESSION['id'];
                    }else{
                        $user=null;
                    }
                    $loge=$bdd->prepare("SELECT COUNT(*) as total_non_occupe
                    FROM logement l, reservation r
                     WHERE l.id_user =:user AND r.id_reservation is null");

                    $loge->execute(["user"=>$user]);
                    $maison=$loge->fetch(PDO::FETCH_ASSOC);
                    $total_vide = $maison['total_non_occupe'];
                    

                    ?>
                    <div class="box">     
                        <h1><?php echo $total_vide ?></h1>
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
                        <h2>mes proprietes</h2>
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
                    $home= $bdd->prepare("SELECT l.*, 
                    CASE  
                    WHEN COUNT(r.id_reservation) > 0 AND MAX(r.date_sortie) >= NOW() THEN 'occupe'
                    ELSE 'libre' END AS statut FROM logement l LEFT JOIN reservation r 
                    ON l.Id_logement = r.Id_logement WHERE l.id_user = :user
                    GROUP BY l.Id_logement");

                    $home->execute(["user"=>$user]);

                    if($home->rowCount() > 0){

                    $logement=$home->fetchAll(PDO::FETCH_ASSOC);
                }else{
                    echo "aucun logement trouve";
                }
                    
?>
                    <table>
                        <tr>
                            <th>nom</th>
                            <th>adresse</th>
                            <th>surface</th>
                            <th>prix</th>
                            <th>photo</th>
                            <th>description</th>
                            <th>ville</th>
                            <th>code_postal</th>
                            <th>statut</th>
                        </tr>
                        <?php foreach($logement as $loge){ ?>
                        <tr>
                            <td><?php echo $loge['nom'] ?></td>
                            <td><?php echo $loge['adresse'] ?></td>
                            <td><?php echo $loge['surface'] ?></td>
                            <td><?php echo $loge['prix'] ?></td>
                            <td><a href="<?php echo $loge['photo'] ?>" class="btn">voir</a></td>
                            <td><?php echo $loge['description'] ?></td>
                            <td><?php echo $loge['ville'] ?></td>
                            <td><?php echo $loge['code_postal'] ?></td>
                            <td><?php echo $loge['statut'] ?></td>
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