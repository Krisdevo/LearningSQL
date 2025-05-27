<?php
require_once 'config.php';

try {
    $pdo = new PDO( "mysql:host=$host; dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
?>