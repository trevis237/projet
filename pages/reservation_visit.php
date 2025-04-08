<!DOCTYPE html>
<?php 
session_start(); ?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Réservation</title>
    <style>
        body {
            background-image: url(../asset/plein-coup-jeune-homme-femme-maison_23-2149358490.jpg);
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%; /* S'étend sur toute la largeur */
            margin-top: 10px; /* Ajoute un espace au-dessus */
        }
        button:hover {
            background-color: #2980b9;
        }
        .info {
            font-size: 12px;
            color: #666;
            margin: -5px 0 10px 0;
        }
    </style>
</head>
<body>
<?php 
include("../php/connexion.php");
if (isset($_GET['ad'])) {
    // Convertir l'ID en entier pour éviter les injections
    $lodgingId = intval($_GET['ad']);
}
$req = $bdd->query("SELECT id_user 
FROM user 
WHERE Id_logement = $lodgingId");
// $req->execute(["ad"=>$lodgingId]);
$id = $req->fetch(PDO::FETCH_ASSOC);
// echo $result=$req['id_user'];
if ($id) {
    // Accédez à l'identifiant de l'utilisateur
    $result = $id['id_user'];
} else {
    // Gestion de l'absence de résultats
    echo "Aucun utilisateur trouvé pour ce logement.";
}
echo $_SESSION['proprietaire']=$result ;

    // Stocke l'identifiant dans la session
    $_SESSION['logements'] = $lodgingId;?>
<div class="form-container">
    <h2>Formulaire de Réservation</h2>
    <form id="reservationForm" action="../php/visit.php" method="post">
        <!-- <input type="text" id="name" name="name" required placeholder="Entrez l'adresse">
        <input type="number" id="phone" name="phone" required placeholder="Entrez votre numéro de téléphone"> -->
        <input type="date" id="checkin" name="checkin" required value="<?php echo date('Y-m-d'); ?>">
        <div class="info">Date d'arrivée (aujourd'hui par défaut)</div>
        <input type="date" id="checkout" name="checkout" required placeholder="Date de Départ">
        <div class="info">Veuillez entrer votre date de départ</div>
        <button type="submit" >Réserver</button>
    </form>
</div>



</body>
</html>