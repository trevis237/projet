<!DOCTYPE html>
<?php session_start(); ?>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Votre Réservation</title>
  <link rel="stylesheet" href="../css/carref.css">
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
  <!-- <div>Réservation Appart</div>
  <div>
    <a href="/login">Connexion</a>
    <a href="/register">Inscription</a>
  </div> -->
</header>
<?php
include("../php/connexion.php");
if(isset($_SESSION['id']) && isset($_SESSION['logements'])){
     $user = $_SESSION['id'];
     $loge = $_SESSION['logements'];
}else{
    echo "vide";
}
   //information du logement
        $identifiants= $bdd->query("SELECT * FROM logement WHERE Id_logement = '$loge'");
        $pdos= $identifiants->fetchAll(PDO::FETCH_ASSOC);

        //information sur l'utilisteur
        $utilisateur= $bdd->query("SELECT * FROM user u, reservation r WHERE u.id_user=r.id_user
         AND r.Id_logement= '$loge' AND r.id_user= '$user'");
         $rows= $utilisateur->fetchAll(PDO::FETCH_ASSOC);

         

 
         foreach($rows as $row){
            $total = $row['cout'];
            $date = $row['date_debut'];
          $nom = $row['nom']." ".$row['prenom'] 
           
                 
?>

<div class="container">
  <div class="user-info">
    Bonjour, <strong id="username"><?php ?></strong> – voici votre réservation :
  </div>

  <div class="apartment">
  <?php foreach ($pdos as $pdo ) {?>
    <!-- <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80" alt="Appartement Meublé"> -->
     <img src="<?php echo $pdo['photo'] ?>" alt="Appartement Meublé">
    
    <div class="apartment-details">
      <h2><?php echo $pdo['nature']."  " .$pdo['nom'] ?></h2>
      <p><strong>Description :</strong> <?php echo $pdo['description'] ?>.</p>
      <p><strong>Adresse :</strong><?php echo $pdo['ville']."  ".$pdo['code_postal'] ?></p>
      <p><strong>Prix :</strong><?php echo $total ?> XAF / nuit</p>
      <p><strong>Date de réservation :</strong><?php echo $date ?></p>

      <button class="delete-btn" onclick="supprimerReservation()">Supprimer la réservation</button>
    </div>
  </div>
  <?php } ?>
  <?php } ?>
</div>

<script>
  // Simuler des données dynamiques
  const utilisateurNom = "<?php echo $nom ?>";
  document.getElementById("username").innerText = utilisateurNom;

  function supprimerReservation() {
    if (confirm("Êtes-vous sûr de vouloir annuler votre réservation ?")) {
      alert("Votre réservation a été supprimée.");
      // Tu peux ici faire un appel fetch/post vers ton API pour supprimer
      // fetch('/api/deleteReservation', { method: 'POST', body: JSON.stringify({ userId: 123 }) })
    }
  }
</script>

</body>
</html>
