<?php
//Informations de connexion à la base de données
$host = 'localhost'; // Ou l'address IP du serveur MySQl
$dbname = 'dbClotho';        // Nom de la base (laisser vide si tu veux seulement créer la base)
$username = 'root';  //utilisateur MySQl
$password = '';      //MDP MySQl

try {
    //Connexion à MySQl sans spécifier de base pour permettre la création
    $pdo = new PDO( dsn: "mysql:host = $host; dbname=$dbname", username: $username,password: $password);
    $pdo->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION );
} catch (PDOException $e) {
    die("Erreur de connexion à labase de données :". $e->getMessage());
}
?>