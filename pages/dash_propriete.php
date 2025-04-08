<!DOCTYPE html>
<?php session_start(); ?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes propriétés - MYHOUSE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <div class="side-menu">
        <div class="brand-name">
            <h1>MYHOUSE</h1>
        </div>
        <ul>
            <li><i class="fa-solid fa-bars"></i>&nbsp; <a href="dashboard.php"><span>dashboard</span></a></li>
            <li class="active"><i class="fa-solid fa-home"></i>&nbsp; <a href="dash_propriete.php"><span>ma propriete</span></a></li>
            <li><i class="fa-solid fa-user"></i>&nbsp; <a href="dash_locataire.php"><span>mes locataires</span></a></li>
            <li><i class="fa-solid fa-chart-simple"></i>&nbsp; <a href="#"><span>statistique</span></a></li>
            <li><i class="fa-solid fa-calendar"></i>&nbsp; <a href="#"><span>bilan mensuel</span></a></li>
            <li><i class="fa-solid fa-money-bill"></i>&nbsp; <a href="#"><span>total recette</span></a></li>
            <li><i class="fa-solid fa-circle-xmark"></i>&nbsp; <a href="php/deconexion.php"><span>quitter</span></a></li>
        </ul>
    </div>
    <div class="container">
    <?php
        include('../php/connexion.php');
        if(isset($_SESSION['nom'])){
            $user = $_SESSION['nom'];
        } else {
            echo "non definit";
            $user = "invite";
        }
    ?>
        <div class="header">
            <div class="nav">
                <div class="seach">
                    <input type="text" name="seach" id="search" placeholder="recherche.." oninput="filterTable()">
                    <button type="submit" value=""><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div class="user">
                    <a href="ajouter_logement.php" class="btn"><i class="fa-solid fa-plus"></i> Ajouter propriété</a>
                    <i class="fa-regular fa-bell"></i>
                </div>
                <div class="case">
                    <a href="#" class="b"><i class="fa-solid fa-user"></i><?php echo htmlspecialchars($user); ?></a>
                    <a href="#"></a>
                </div>
            </div>
        </div> 
        <div class="content">
            <div class="cards">
                <div class="card">
                    <?php
                    if(isset($_SESSION['id'])){
                        $user = $_SESSION['id'];
                    } else {
                        $user = null;
                    }
                    $nbres = $bdd->prepare("SELECT COUNT(u.id_user) 
                    FROM user u, reservation r, logement l
                    WHERE u.id_user=r.id_user AND l.Id_logement=r.Id_logement AND u.id_user= :user AND u.statut='0'");

                    $nbres->execute(["user" => $user]);
                    $total = $nbres->fetchColumn();
                    ?>
                    <div class="box">
                        <h2><?php echo $total; ?></h2>
                        <p>Locataires</p>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                
                <div class="card">
                    <div class="box">
                    <?php
                    if(isset($_SESSION['id'])){
                        $user = $_SESSION['id'];
                    } else {
                        $user = null;
                    }
                    $som = $bdd->prepare("SELECT SUM(r.cout) 
                    FROM user u, reservation r, logement l
                    WHERE u.id_user=r.id_user AND l.Id_logement=r.Id_logement AND u.id_user= :user AND u.statut='0'");

                    $som->execute(["user" => $user]);
                    $sommes = $som->fetchColumn();
                    
                    if($sommes < 1){
                        $sommes = 0;
                    }
                    ?>
                        <h2><?php echo number_format($sommes, 0, ',', ' '); ?> XAF</h2>
                        <p>Revenus</p>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-money-bill"></i>
                    </div>
                </div>
                
                <div class="card">    
                <?php
                    if(isset($_SESSION['id'])){
                        $user = $_SESSION['id'];
                    } else {
                        $user = null;
                    }
                    $biens = $bdd->prepare("SELECT COUNT(*) as total_non_occupe
                    FROM user WHERE id_user= :user");
                    $biens->execute(["user" => $user]);
                    $all = $biens->fetchColumn();
                ?>
                    <div class="box">     
                        <h2><?php echo $all; ?></h2>
                        <p>Nombre d'appartements</p>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-home"></i>
                    </div>
                </div>
                
                <div class="card"> 
                <?php
                    if(isset($_SESSION['id'])){
                        $user = $_SESSION['id'];
                    } else {
                        $user = null;
                    }
                    $loge = $bdd->prepare("SELECT COUNT(*) AS nombre_appartements_libres 
                    FROM logement l 
                    LEFT JOIN reservation r ON l.Id_logement = r.Id_logement 
                    LEFT JOIN user u ON l.Id_logement = u.Id_logement 
                    WHERE u.id_user = :user
                    AND (r.date_sortie < NOW() OR r.id_reservation IS NULL)");

                    $loge->execute(["user" => $user]);
                    $maison = $loge->fetch(PDO::FETCH_ASSOC);
                    $total_vide = $maison['nombre_appartements_libres'];
                ?>
                    <div class="box">     
                        <h2><?php echo $total_vide; ?></h2>
                        <p>Appart. libres</p>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-door-open"></i>
                    </div>
                </div>
            </div>
            
            <div class="content-2">
                <div class="recent-payments">
                    <div class="title">
                        <h2>Mes propriétés</h2>
                        <a href="ajouter_logement.php" class="btn">Ajouter propriété</a>
                    </div>

                    <?php
                    // Messages de notification
                    if (isset($_SESSION['success_message'])) {
                        echo '<div class="notification success">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
                        unset($_SESSION['success_message']);
                    }
                    if (isset($_SESSION['error_message'])) {
                        echo '<div class="notification error">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
                        unset($_SESSION['error_message']);
                    }
                    
                    include('../php/connexion.php');
                    if(isset($_SESSION['id'])){
                        $user = $_SESSION['id'];
                    } else {
                        $user = null;
                    }
                    
                    $home = $bdd->prepare("SELECT l.*, 
                        CASE  
                            WHEN COUNT(r.id_reservation) > 0 AND MAX(r.date_sortie) >= NOW() THEN 'occupe'
                            ELSE 'libre' 
                        END AS statut 
                        FROM logement l 
                        LEFT JOIN reservation r ON l.Id_logement = r.Id_logement 
                        LEFT JOIN user u ON l.Id_logement = u.Id_logement 
                        WHERE u.id_user = :user
                        GROUP BY l.Id_logement");

                    $home->execute(["user" => $user]);
                    
                    if ($home->rowCount() > 0) {
                        $logements = $home->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <table id="propertyTable">
                        <tr>
                            <th>Nom</th>
                            <th>Adresse</th>
                            <th>Surface</th>
                            <th>Prix</th>
                            <th>Photo</th>
                            <th>Description</th>
                            <th>Ville</th>
                            <th>Code postal</th>
                            <th>Statut</th>
                            <th>action</th>
                        </tr>
                        <?php foreach($logements as $logement){ ?>
                        <tr>
                            <td><?php echo htmlspecialchars($logement['nom'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($logement['adresse'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($logement['surface'] ?? 'N/A'); ?> m²</td>
                            <td><?php echo htmlspecialchars($logement['prix'] ?? 'N/A'); ?> XAF</td>
                            <td>
                                <?php if(isset($logement['photo']) && !empty($logement['photo'])): ?>
                                <a href="<?php echo htmlspecialchars($logement['photo']); ?>" class="btn btn-view" target="_blank">Voir</a>
                                <?php else: ?>
                                N/A
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($logement['description'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($logement['ville'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($logement['code_postal'] ?? 'N/A'); ?></td>
                            <td class="status-<?php echo strtolower($logement['statut']); ?>"><?php echo htmlspecialchars($logement['statut']); ?></td>
                            <td class="actions">
                                <a href="ajouter_logement.php" class="btn btn-primary" title="Ajouter"><i class="fa fa-plus"></i></a>
                                <a href="modifier_logement.php?id=<?php echo $logement['Id_logement']; ?>" class="btn btn-edit" title="Modifier"><i class="fa fa-pen"></i></a>
                                <a href="supprimer_logement.php?id=<?php echo $logement['Id_logement']; ?>" class="btn btn-delete" title="Supprimer" onclick="return confirmDelete('Êtes-vous sûr de vouloir supprimer cette propriété ?');"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php 
                        }
                    } else {
                    ?>
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fa fa-home"></i>
                            </div>
                            <p>Aucune propriété trouvée. Commencez par ajouter une nouvelle propriété.</p>
                            <a href="pro/ajouter_logement.php" class="btn btn-primary">Ajouter une propriété</a>
                        </div>
                    <?php
                    }
                    ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="js/dashboard.js"></script>
</body>
</html>
