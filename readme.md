# Déploiement SQL 

![image](https://github.com/user-attachments/assets/6aae6691-a067-4e33-aa9e-ab59a9200d22)

## Résumé : 

Ce projet est un ensemble de fichiers qui résume comment créer et utiliser une base de donnée (BDD).
Chaque fichier .PHP décrit une fonction que l'on peut appliquer pour une base de donnée. La plupart des fichiers sont commentées quand le code est plus complexe.
Le fichier index.php, permet de naviguer parmis les fichiers. 

## Installation :

Pour installer le projet utilisez la commande git clone..
Installez [Xammp](https://www.apachefriends.org/fr/index.html) et clickez sur le bloc Apache et MySQl.
Connectez vous sur [PHPmyadmin](https://www.phpmyadmin.net/) en tapant sur l'URL de votre navigateur localhost:(votre numéro de port)/phpmyadmin/
Le numéro de port figure dans votre Xammp (cf image ci dessous) si ilnne reconnait pas votre port utilisez le port 3030 et taper dans votre terminal d'editeur de code "php -S localhost:3030"
![alt text](image.png)

## Déroulement

### config.php

Ce premier fichier permet de configurer la connexion à notre base de donnée 

### create_database.php

Ce fichier permet de créer la base de donnée.

### create_table.php

Permet de créer une table de donnée en lui donnant plusieurs champs comme email. On lui précise sous quel format, on veut traiter cette donnée.(Chiffres, lettres, format date...)
```
try {
    $table = 'users';
    //Création de la table users

    $sql = "
    CREATE TABLE IF NOT EXISTS $table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )ENGINE=InnoDB
    ";
    $pdo->exec($sql);
    echo"Table $table créée avec succès (ou déjà existante).";
} catch (PDOException $e) {
    echo "Erreur lor de la création de la table : ". $e->getMessage();
}
//UNIQUE sur email pour éviter les doublons
// ENGINE InnoDB pour supporter les contraintes (clés étrangères si on ajoute des relations plus tard)
```


### insert_data

Permet d'ajouter une donnée à une table comme un nouvel utilisateur. On utilise une requête préparée (prepare + execute) pour éviter les failles d'injection SQL

```
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
```
### select_data

Permet de récupérer une donnnée afin de travailler avec elle , comme l'afficher dans un tableau.

```
try{
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
```


### delete_data

Permet de supprimer une donnée d'une table en utilisant son ID.

```
try {
    $userIdToDelete = 1; // ID à Supprimer
    //Requête DELETE
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute(['id' => $userIdToDelete]);

    if($stmt ->rowCount()){
        echo"Utilisateur #$userIdToDelete supprimé avec succès.";
    }else{
        echo "Aucun utilisateur trouvé avec l'ID $userIdToDelete.";
    }
}catch(PDOException $e){
    echo"Erreur los de la suppression." .$e->getMessage();
}
// Comment détecter si la suppression a eu lieu = (rowcount()) 
```

### export_data

Permet d'exporter des données de notre site avec un format définit dans le header. On peut utiliser cette fonctionnalité pour modifier une donnée en externe, dans un tableur par exemple.

```
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
```

### group_order

Permet de récupérer un ensemble de données pour travailler sur celle-ci. La sélection de ces données sont  définies par les fonctions GROUP BY/ ORDER BY / HAVING. 

```
$sql = "
    SELECT u.name,
    COUNT(c.id) AS nb_commandes,
    SUM(c.prix) AS total
    FROM users u 
    JOIN commandes c ON u.id = c.id
    GROUP BY u.name
    HAVING total > 100
    ORDER by total DESC
";
echo "<p><strong>Requête exécutée : </strong>$sql</p>";

$stmt = $pdo ->query($sql);

echo "<table><tr><th>Nom</th><th>Commandes</th><th>Total</th></tr>";

foreach ($stmt as $row) {
    echo "<tr><td>{$row['name']}</td><td>{$row['nb_commandes']}</td><td>{$row['total']}</td></tr>";
}
echo "</table>";

```

### select_condition

Permet de faire des requêtes conditionelles avec les fonctions WHERE,LIKE,BETWEEN.

### function_sql

Permet de faire des calculs avec des données numériques avec par exemple les fonctions COUNT,AVG,SUM.

```
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
```
### update_database

Permet de mettre à jour la base de donnée comme le changement de nom d'un utilisateur.

### drop_database 

Permet de supprimer une base de donnée en spécifiant son nom.










