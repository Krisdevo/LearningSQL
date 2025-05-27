<?php include 'db.php'; ?>

<h2>Ajouter un utilisateur</h2>
<form action="insert.php" method="post">
    Nom: <input type="text" name="nom" required>
    <button type="submit">Ajouter</button>
</form>

<h2>Utilisateurs</h2>
<ul>
    <?php
    $stmt = $pdo->query("SELECT * FROM users");
    while ($row = $stmt->fetch()){
        echo"<li>{$row['Name']}
        <a href ='delete.php?id={$row['ID']}Supprimer</a>
        <a href ='update.php?id={$row['ID']}'>Modifier</a>
        </li>";
    }
    ?>
</ul>