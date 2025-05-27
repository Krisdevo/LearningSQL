<?php
echo $_GET['name'];;
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

    <form action="/create_database.php" method="GET">
        <label for="name">Nom de la base de données</label>
        <input type="text">
        <input type="submit" value ="Submit">
    </form>

    
</body>
</html>