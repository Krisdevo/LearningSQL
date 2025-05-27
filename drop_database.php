<?php
require_once 'config.php';

try{
    $dbname = 'dbClotho';

    //Requête pour supprimer la base

    $sql = "DROP DATABASE IF EXISTS $dbname";
    $pdo -> exec($sql);

    echo"Base de données '$dbname' supprimé (si elle existait).";
}catch(PDOException $e){
    echo"Erreur lors de la suppression de la base :" .$e->getMessage();  
}
?>