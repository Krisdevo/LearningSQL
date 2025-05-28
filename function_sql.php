<?php
require_once 'config.php'
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fonctions SQL</title>
</head>
<body>

<h1>Fonctions SQL (COUNT,AVG,SUM)</h1>

<!-- fabrication de la requête SQL -->
<?php 
$sql = "SELECT
         COUNT(*) AS total_commandes,
         AVG(prix) AS moyenne,
         SUM(prix)  AS total
        FROM commandes";
// Système de debug
        echo"<p><strong>Requête exécutée !</strong>$sql</p>";
        
// execute la requete et récupère les données avec un fetch 
        $stmt = $pdo ->query($sql);
        $row = $stmt->fetch();

        echo"<ul>
                <li><strong>Totale de commandes : </strong> {$row['total_commandes']}</li>
                <li><strong>Moyenne des montants : </strong> {$row['moyenne']}</li>
                <li><strong>Somme totale :  </strong> {$row['total']}</li>
            </ul>
                ";
?>
    
</body>
</html>