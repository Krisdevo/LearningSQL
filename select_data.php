<?php

$host = 'localhost';
$dbname = 'dbClotho';
$user = 'root';
$pass = '';

try{
    // Connexion à la BDD
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Fabrication de la requête SQL

    $sql = "SELECT * FROM users ORDER BY created_at DESC";
    $stmt = $pdo->query($sql);

    // Affichage des résultats
    echo"<h2>Liste des Utilisateurs</h2>";
    echo"<table border ='1' cellpadding='8' cellspacing='0'";
    echo "<tr><th>ID</th><th>Nom</th><th>Email</th><th>Créé le</th></tr>";

    foreach($stmt as $row){
        echo"<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['created_at']}</td>";
        echo "</tr>";    
    }
    echo "</table>";
} catch(PDOException $e){
    echo"Erreur lors de la lecture : " .$e->getMessage();
}  
?>