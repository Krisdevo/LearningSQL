<?php
require_once 'config.php';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Données à insérer

    $name = "Raymond Blin";
    $email = "leray@example.com";

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