<?php
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requêtes conditionnelles</title>
</head>
<body>
    <h1>Requêtes avec conditions(WHERE,LIKE,BETWEEN)</h1>
    
    <?php
    $sql = "SELECT * FROM users WHERE name LIKE 'A%' OR name LIKE 'C%'";
    echo "<p><strong>Requête exécutée : </strong> $sql</p>"; // système de debug
    
    $stmt= $pdo -> query($sql);

    echo"<table><tr><th>ID</th><th>Nom</th><th>Email</th><th>Date d'inscription</th></tr>";
    foreach($stmt as $row){
        echo"<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['created_at']}</td></tr>";
    }
    echo "</table>";
    ?>
</body>
</html>