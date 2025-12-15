<?php
require 'db_config.php';

// Requête pour récupérer les auteurs
$stmt = $pdo->prepare('SELECT nom, prenom FROM auteurs');
$stmt->execute();
$auteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'ajout de livres</title>
</head>
<body>
    <form action="reponse.php" method="POST">
        <h1>Formulaire d'ajout de livres</h1>
        
        <!-- Champs -->
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required> <br>

        <label for="isbn">ISBN :</label>
        <input type="text" id="isbn" name="isbn" required> <br>

        <label for="annee">Année de publication :</label>
        <input type="text" id="annee" name="annee" required> <br>

        <label for="stock">Stock :</label>
        <input type="text" id="stock" name="stock" required> <br>

        <!-- Sélection de l'auteur -->
        <label for="auteur">Auteur :</label>
        <select name="auteur" id="auteur" required>
            <?php foreach ($auteurs as $auteur): ?>
                <option value="<?= htmlspecialchars($auteur['nom']) ?>">
                    <?= htmlspecialchars($auteur['nom'] . ' ' . $auteur['prenom']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="submit" value="Envoyer">
    </form>
</body>
</html>
