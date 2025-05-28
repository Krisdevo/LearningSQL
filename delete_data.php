<?php
require_once 'config.php';

try {
    $userIdToDelete = 1; // ID à Supprimer
    //Requête DELETE
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute(['id' => $userIdToDelete]);

    if($stmt ->rowCount()){
        echo"Utilisateur #$userIdToDelete supprimé avec succès.";
    }else{
        echo "Aucun utilisateur trouvé avec l'ID $userIdToDelete.";
    }
}catch(PDOException $e){
    echo"Erreur los de la suppression." .$e->getMessage();
}
// Comment détecter si la suppression a eu lieu = (rowcount()) 
?>

