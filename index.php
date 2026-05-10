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
            <h1>WANTED</h1>
            <div class="player-info">
                <p><strong>DATE:</strong> <?= htmlspecialchars($stats['match_date']) ?></p>
                <p><strong>POINTS:</strong> <?= htmlspecialchars($stats['points']) ?></p>
                <p><strong>ASSISTS:</strong> <?= htmlspecialchars($stats['assists']) ?></p>
                <p><strong>ÉNERGIE:</strong> <?= htmlspecialchars($stats['energy_level']) ?>%</p>
            </div>
        </div>

        <div class="luffy-container">
            <div class="bulle-dialogue" id="bulle-dialogue">
               
        <script>
        // On passe la variable PHP à JavaScript / pour afficher un message différent selon le niveau d'énergie
         const energy = <?= intval($stats['energy_level']) ?>;
        </script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <div class="chart-container" style="position: relative; height:40vh; width:80vw; margin: auto;">
              <canvas id="radarChart"></canvas>
            </div>
            </div>
            <!-- L'image changera selon l'énergie ou le scroll plus tard -->
            <img src="assets/playerfocus.png" id="player-image" alt="Luffy">
            <section id="contact">
          <h2>REJOINDRE L'ÉQUIPAGE</h2>
       <form action="send_message.php" method="POST" class="manga-form">
           <input type="text" name="expediteur" placeholder="Ton Nom" required>
           <input type="text" name="club" placeholder="Ton Club / Organisation">
           <textarea name="contenu" placeholder="Ton message pour le futur Roi du Terrain..." required></textarea>
          <button type="submit" class="btn-pirate">ENVOYER LE MESSAGE</button>
      </form>
     </section>
        </div>
    </div>
</body>
</html>