<?php
require_once 'config.php';

//déclare le type de contenu dans le Header

header('Content-Type : text/csv');
header('Content-Disposition: attachment; filename=commandes_export.csv');

//on ouvre le fichier a télécharger en mode écriture "w"
$output =fopen("php://output", "w");

//On ajoute le nom des colonnes dans notre fichier
fputcsv($output, ['ID', 'Utilisateur','Montant', 'Date']);


$sql = "SELECT c.id, u.name, c.prix, c.date_commande
        FROM commandes c
        JOIN users u 
        ON c.user_id = u.id";

//On parcours le résultat de la requête et on remplit "csv"

$stmt = $pdo ->query($sql);
while ($row = $stmt -> fetch()){
    fputcsv($output, $row);
    }
    //On sauvegarde le fichier
    fclose($output);
    exit;


?>