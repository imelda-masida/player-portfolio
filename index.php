<?php 
require_once 'config.php'; 

try {
    // On récupère le dernier match enregistré
    $query = $pdo->query("SELECT * FROM joueur_stats LIMIT 1");
    $stats = $query->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // Si la DB échoue, on crée des stats vides pour ne pas casser la page
    $stats = ['points' => 0, 'assists' => 0, 'energy_level' => 0, 'age' => 0, 'taille' => 0];
    echo "";
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
     <section id="highlights">
    <h2>MON HAKI EN ACTION (HIGHLIGHTS)</h2>
    <div class="video-container">
        <iframe width="560" height="315" 
            src="https://www.youtube.com/embed/TON_ID_VIDEO" 
            title="Basketball Highlights" 
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen>
        </iframe>
    </div>
   </section>
    <div class="bounty-card">
    <h1 class="label-wanted">FICHE TECHNIQUE</h1>
    
    <div class="grid-stats">
        <div class="column">
            <p><strong>ÂGE :</strong> <?= $stats['age'] ?> ans</p>
            <p><strong>POIDS :</strong> <?= $stats['poids'] ?> kg</p>
            <p><strong>MAIN :</strong> <?= $stats['main_forte'] ?></p>
        </div>
        <div class="column">
            <p><strong>VILLE :</strong> <?= $stats['ville'] ?></p>
            <p><strong>NATION :</strong> <?= $stats['nationalite'] ?></p>
            <p><strong>LANGUES :</strong> <?= $stats['langues'] ?></p>
        </div>
    </div>
</div>
        </div>
    </div>
</body>
</html>