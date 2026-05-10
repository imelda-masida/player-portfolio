<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Récupération des données du formulaire
    $nom = $_POST['expediteur'];
    $club = $_POST['club'];
    $msg = $_POST['contenu'];

    try {
        // 2. Préparation de la requête (Sécurité contre injection SQL)
        $sql = "INSERT INTO messages (expediteur, club, contenu) VALUES (:nom, :club, :msg)";
        $stmt = $pdo->prepare($sql);
        
        // 3. Exécution avec les vraies valeurs
        $stmt->execute(['nom' => $nom, 'club' => $club, 'msg' => $msg]);

        echo "✅ Message envoyé au capitaine ! Redirection...";
        header("Refresh: 2; URL=index.php"); // Revient à l'accueil après 2 sec
    } catch (PDOException $e) {
        die("❌ Erreur de transmission : " . $e->getMessage());
    }
}
?>