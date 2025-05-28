<?php
require_once 'config.php';

try{


    //Données à insérer

    $name = "Arthur Boyle";
    $email = "ab@example.com";

    //Requête préparée (sécurité contre les injections SQL)

    $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    $stmt->execute([
        ':name' => $name,
        ':email'=> $email
    ]);

    echo "Utilisateur inséré avec succès : $name - $email";
}catch(PDOException $e){
    echo "Erreur lors de l'insertion". $e->getMessage();
}

// On utilise une requête préparée (prepare + execute) pour éviter les failles d'injection SQL
// A FAIRE = relancer le script avec la même adresse mail(conflit UNIQUE sur email)
?>