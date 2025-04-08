<!DOCTYPE html>
<?php session_start(); ?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une propriété - MYHOUSE</title>
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
                    <input type="text" name="seach" id="search" placeholder="recherche..">
                </div>
                <div class="user">
                    <a href="dash_propriete.php" class="btn"><i class="fa-solid fa-arrow-left"></i> Retour</a>
                    <i class="fa-regular fa-bell"></i>
                </div>
                <div class="case">
                    <a href="#" class="b"><i class="fa-solid fa-user"></i><?php echo htmlspecialchars($user); ?></a>
                    <a href="#"></a>
                </div>
            </div>
        </div> 
        <div class="content">
            <div class="form-content">
                <div class="form-container">
                    <div class="title">
                        <h2>Modifier une propriété</h2>
                    </div>
                    
                    <?php
                    // Récupération de l'ID du logement
                    $id_logement = isset($_GET['id']) ? intval($_GET['id']) : 0;
                    
                    if (!$id_logement) {
                        echo '<div class="error-message">ID logement manquant.</div>';
                        echo '<div class="form-actions"><a href="dash_propriete.php" class="btn btn-primary">Retour à la liste</a></div>';
                        exit;
                    }
                    
                    // Récupération des données du logement
                    $stmt = $bdd->prepare("SELECT * FROM logement WHERE Id_logement = :id_logement");
                    $stmt->execute(['id_logement' => $id_logement]);
                    
                    if ($stmt->rowCount() === 0) {
                        echo '<div class="error-message">Propriété non trouvée.</div>';
                        echo '<div class="form-actions"><a href="dash_propriete.php" class="btn btn-primary">Retour à la liste</a></div>';
                        exit;
                    }
                    
                    $logement = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    // Traitement du formulaire
                    $errors = [];
                    
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Récupération des données
                        $nom = trim($_POST['nom'] ?? '');
                        $adresse = trim($_POST['adresse'] ?? '');
                        $surface = trim($_POST['surface'] ?? '');
                        $prix = trim($_POST['prix'] ?? '');
                        $description = trim($_POST['description'] ?? '');
                        $ville = trim($_POST['ville'] ?? '');
                        $code_postal = trim($_POST['code_postal'] ?? '');
                        
                        // Validation des données
                        if (empty($nom)) {
                            $errors[] = "Le nom est obligatoire";
                        }
                        
                        if (empty($adresse)) {
                            $errors[] = "L'adresse est obligatoire";
                        }
                        
                        if (empty($surface)) {
                            $errors[] = "La surface est obligatoire";
                        } elseif (!is_numeric($surface)) {
                            $errors[] = "La surface doit être un nombre";
                        }
                        
                        if (empty($prix)) {
                            $errors[] = "Le prix est obligatoire";
                        } elseif (!is_numeric($prix)) {
                            $errors[] = "Le prix doit être un nombre";
                        }
                        
                        if (empty($ville)) {
                            $errors[] = "La ville est obligatoire";
                        }
                        
                        if (empty($code_postal)) {
                            $errors[] = "Le code postal est obligatoire";
                        }
                        
                        // Gestion de l'upload de la photo
                        $photo = $logement['photo']; // Garder l'ancienne photo par défaut
                        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                            $uploadDir = 'uploads/';
                            
                            // Créer le répertoire d'upload s'il n'existe pas
                            if (!is_dir($uploadDir)) {
                                mkdir($uploadDir, 0755, true);
                            }
                            
                            $fileName = uniqid() . '_' . basename($_FILES['photo']['name']);
                            $uploadFile = $uploadDir . $fileName;
                            
                            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                            $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
                            
                            if (!in_array($ext, $allowed)) {
                                $errors[] = "Le format de la photo n'est pas supporté. Utilisez JPG, JPEG, PNG ou GIF.";
                            } elseif ($_FILES['photo']['size'] > 5000000) { // 5MB
                                $errors[] = "La taille de la photo ne doit pas dépasser 5MB.";
                            } elseif (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                                // Supprimer l'ancienne photo si elle existe
                                if (!empty($logement['photo']) && file_exists($logement['photo'])) {
                                    unlink($logement['photo']);
                                }
                                $photo = $uploadFile;
                            } else {
                                $errors[] = "Erreur lors de l'upload de la photo.";
                            }
                        }
                        
                        // Si pas d'erreurs, mise à jour en base de données
                        if (empty($errors)) {
                            try {
                                // Mise à jour du logement
                                $updateLogement = $bdd->prepare("
                                    UPDATE logement 
                                    SET nom = :nom, 
                                        adresse = :adresse, 
                                        surface = :surface, 
                                        prix = :prix, 
                                        photo = :photo, 
                                        description = :description, 
                                        ville = :ville, 
                                        code_postal = :code_postal
                                    WHERE Id_logement = :id_logement
                                ");
                                
                                $updateLogement->execute([
                                    'nom' => $nom,
                                    'adresse' => $adresse,
                                    'surface' => $surface,
                                    'prix' => $prix,
                                    'photo' => $photo,
                                    'description' => $description,
                                    'ville' => $ville,
                                    'code_postal' => $code_postal,
                                    'id_logement' => $id_logement
                                ]);
                                
                                // Définir un message de succès
                                $_SESSION['success_message'] = "La propriété a été mise à jour avec succès";
                                
                                // Rediriger vers la liste des propriétés
                                header('Location: dash_propriete.php');
                                exit;
                                
                            } catch (PDOException $e) {
                                $errors[] = "Erreur lors de la mise à jour de la propriété : " . $e->getMessage();
                            }
                        }
                    }
                    
                    // Afficher les erreurs s'il y en a
                    if (!empty($errors)) {
                        echo '<div class="error-message"><ul>';
                        foreach ($errors as $error) {
                            echo '<li>' . htmlspecialchars($error) . '</li>';
                        }
                        echo '</ul></div>';
                    }
                    ?>
                    
                    <form action="dash_propriete.php" method="post" class="form" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nom">Nom *</label>
                            <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($logement['nom'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="adresse">Adresse *</label>
                            <input type="text" id="adresse" name="adresse" value="<?php echo htmlspecialchars($logement['adresse'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="surface">Surface (m²) *</label>
                            <input type="number" id="surface" name="surface" value="<?php echo htmlspecialchars($logement['surface'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="prix">Prix (XAF) *</label>
                            <input type="number" id="prix" name="prix" value="<?php echo htmlspecialchars($logement['prix'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <?php if(!empty($logement['photo'])): ?>
                            <p>Photo actuelle: <a href="<?php echo htmlspecialchars($logement['photo']); ?>" target="_blank">Voir</a></p>
                            <?php endif; ?>
                            <input type="file" id="photo" name="photo">
                            <p class="hint">Laissez vide pour garder la photo actuelle</p>
                        </div>
                        
                        <div class="form-group">
                            <label for="ville">Ville *</label>
                            <input type="text" id="ville" name="ville" value="<?php echo htmlspecialchars($logement['ville'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="code_postal">Code postal *</label>
                            <input type="text" id="code_postal" name="code_postal" value="<?php echo htmlspecialchars($logement['code_postal'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="form-group" style="width: 100%;">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" rows="4"><?php echo htmlspecialchars($logement['description'] ?? ''); ?></textarea>
                        </div>
                        
                        <div class="form-actions">
                            <a href="dash_propriete.php" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/dashboard.js"></script>
</body>
</html>
