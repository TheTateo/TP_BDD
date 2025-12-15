<?php
require 'db_config.php';

// Vérifie que le formulaire a été envoyé en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupérer et sécuriser les données
    $titre  = $_POST['titre'] ?? '';
    $isbn   = $_POST['isbn'] ?? '';
    $annee  = $_POST['annee'] ?? '';
    $stock  = $_POST['stock'] ?? '';
    $auteur = $_POST['auteur'] ?? '';

    // Vérification simple (peut être renforcée)
    if (!empty($titre) && !empty($isbn) && !empty($annee) && !empty($stock) && !empty($auteur)) {
        try {
            // Préparer la requête INSERT
            $stmt = $pdo->prepare("INSERT INTO livres (titre, isbn, annee_publication, stock, auteur_nom) 
                                   VALUES (:titre, :isbn, :annee, :stock, :auteur)");

            // Exécuter la requête avec les valeurs
            $stmt->execute([
                ':titre' => $titre,
                ':isbn'  => $isbn,
                ':annee' => $annee,
                ':stock' => $stock,
                ':auteur' => $auteur
            ]);

            echo "Le livre a été ajouté avec succès !";

        } catch (PDOException $e) {
            die("Erreur lors de l'ajout du livre : " . $e->getMessage());
        }
    } else {
        echo "Tous les champs sont obligatoires !";
    }
} else {
    echo "Accès refusé.";
}
?>
