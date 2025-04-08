<?php
session_start();
include('../php/connexion.php');

// Récupération de l'ID du logement
$id_logement = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Vérification de l'ID
if (!$id_logement) {
    $_SESSION['error_message'] = "ID logement manquant pour la suppression";
    header('Location: dash_propriete.php');
    exit;
}

try {
    // Commencer une transaction
    $bdd->beginTransaction();
    
    // Vérifier si le logement existe
    $checkLogement = $bdd->prepare("SELECT * FROM logement WHERE Id_logement = :id_logement");
    $checkLogement->execute(['id_logement' => $id_logement]);
    
    if ($checkLogement->rowCount() === 0) {
        throw new Exception("Propriété non trouvée");
    }
    
    $logement = $checkLogement->fetch(PDO::FETCH_ASSOC);
    
    // Vérifier si le logement n'a pas de réservations actives
    $checkReservations = $bdd->prepare("
        SELECT COUNT(*) FROM reservation 
        WHERE Id_logement = :id_logement 
        AND date_sortie >= NOW()
    ");
    $checkReservations->execute(['id_logement' => $id_logement]);
    
    if ($checkReservations->fetchColumn() > 0) {
        throw new Exception("Impossible de supprimer cette propriété car elle a des réservations actives");
    }
    
    // Supprimer les réservations passées associées à ce logement
    $deleteReservations = $bdd->prepare("DELETE FROM reservation WHERE Id_logement = :id_logement");
    $deleteReservations->execute(['id_logement' => $id_logement]);
    
    // Supprimer la photo si elle existe
    if (!empty($logement['photo']) && file_exists($logement['photo'])) {
        unlink($logement['photo']);
    }
    
    // Mettre à jour les utilisateurs qui ont ce logement
    $updateUsers = $bdd->prepare("UPDATE user SET Id_logement = NULL WHERE Id_logement = :id_logement");
    $updateUsers->execute(['id_logement' => $id_logement]);
    
    // Supprimer le logement
    $deleteLogement = $bdd->prepare("DELETE FROM logement WHERE Id_logement = :id_logement");
    $deleteLogement->execute(['id_logement' => $id_logement]);
    
    // Valider la transaction
    $bdd->commit();
    
    // Message de succès
    $_SESSION['success_message'] = "La propriété a été supprimée avec succès";
    
} catch (Exception $e) {
    // Annuler la transaction en cas d'erreur
    $bdd->rollBack();
    $_SESSION['error_message'] = "Erreur lors de la suppression : " . $e->getMessage();
}

// Redirection vers la liste des propriétés
header('Location: dash_propriete.php');
exit;
