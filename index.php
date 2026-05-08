<?php 
require_once 'config.php'; 

try {
    // On récupère le dernier match enregistré
    $query = $pdo->query("SELECT * FROM joueur_stats ORDER BY match_date DESC LIMIT 1");
    $stats = $query->fetch(PDO::FETCH_ASSOC);

    if (!$stats) { die("Aucune donnée trouvée dans la table joueur_stats."); }
} catch (PDOException $e) {
    die("Erreur SQL : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Stats de Pirate</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main-wrapper">
        <div class="bounty-card">
            <h1>DERNIER MATCH</h1>
            <div class="player-info">
                <p><strong>DATE:</strong> <?= htmlspecialchars($stats['match_date']) ?></p>
                <p><strong>POINTS:</strong> <?= htmlspecialchars($stats['points']) ?></p>
                <p><strong>ASSISTS:</strong> <?= htmlspecialchars($stats['assists']) ?></p>
                <p><strong>ÉNERGIE:</strong> <?= htmlspecialchars($stats['energy_level']) ?>%</p>
            </div>
        </div>

        <div class="luffy-container">
            <div class="bulle-dialogue" id="bulle-dialogue">
                <?php 
                    if($stats['energy_level'] < 30) {
                        echo "Je suis épuisé... il me faut de la viande !";
                    } else {
                        echo "J'ai marqué " . $stats['points'] . " points ! En route vers le titre !";
                    }
                ?>
            </div>
            <!-- L'image changera selon l'énergie ou le scroll plus tard -->
            <img src="assets/luffystyle.png" id="player-image" alt="Luffy">
        </div>
    </div>
</body>
</html>