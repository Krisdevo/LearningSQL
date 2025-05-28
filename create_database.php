<?php
    //create_database.php

    require_once 'config.php';

    $message ="";

    // On demande si le formulaire est de type post et que post contient "dbname"
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dbname'])){

        //
        $createdDB =preg_replace('/[^a-zA-Z0-9_]/','', $_POST['dbname']);

            try {
        //Requête SQL pour créer la base "test_db" si elle n'existe pas
        $sql = "CREATE DATABASE IF NOT EXISTS $createdDB CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
        $pdo->exec(statement: $sql);
        echo "Base de données '$createdDB' créée (ou déjaà existante)." ;  
        } catch(PDOException $e) {
            echo "Erreur lors de la création de la base de données". $e->getMessage();
        }
        //utf8mb4 est l'encodage recommandé aujourd'hui pour supporter les émojis et caractères spéciaux.
        //CREATE DATABASE IF NOT EXISTS évite les erreurs si la base est présente.
    }

   


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-MySQl</title>
</head>
<body>
    <h1>Page de création de base de donnée</h1>

    <form action="" method="post">
        <label for="dbname">Nom de la base de données</label>
        <input type="text" id="dbname" name="dbname" required>
        <input type="submit" value ="Créer la base de données">
    </form>

<!-- Système pour prévenir du doucle click sur le bouton -->
<?php if(!empty($message)): ?>
<div class="message"><?= $message?></div>
<?php endif; ?>
</body>
</html>