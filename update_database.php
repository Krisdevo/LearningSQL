<?php
require_once 'config.php';

try{
    $pdo = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $newName = "Paul";
    $userId = 1;

    $stmt = $pdo->prepare("UPDATE users SET name = :name WHERE id = :id");
    $stmt->execute([
        ':name' => $newName,
        ':id'=> $userId
    ]);

    if($stmt->rowCount()){
        echo "Utilisateur #$userId mis à jour avec succès : nouveau valeur = $newName";        
}else{
    echo "Aucun changement effectué. (ID inexistant ou même valeur";
}
}catch(PDOException $e){
    echo "Erreur lors de la mis à jour : " .$e->getMessage();
}
?>