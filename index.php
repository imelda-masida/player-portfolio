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
       <section id="bounty">
    <div class="bounty-card">
        <h1 class="wanted-title">WANTED</h1>
        
        <div class="bounty-content">
            <div class="stats-col">
                <p><strong>ÂGE:</strong> <?= htmlspecialchars($stats['age']) ?> ANS</p>
                <p><strong>TAILLE:</strong> <?= htmlspecialchars($stats['taille']) ?> CM</p>
                <p><strong>POIDS:</strong> <?= htmlspecialchars($stats['poids']) ?> KG</p>
                <p><strong>MAIN:</strong> <?= htmlspecialchars($stats['main_forte']) ?></p>
            </div>
            
            <div class="stats-col">
                <p><strong>VILLE:</strong> <?= htmlspecialchars($stats['ville']) ?></p>
                <p><strong>NATION:</strong> <?= htmlspecialchars($stats['nationalite']) ?></p>
                <p><strong>POSTE:</strong> <?= htmlspecialchars($stats['position']) ?></p>
                <p><strong>LANGUES:</strong> <?= htmlspecialchars($stats['langues']) ?></p>
            </div>
        </div>

        <div class="skills-highlight">
            <p><strong>STYLE DE JEU:</strong> <?= htmlspecialchars($stats['style_jeu']) ?></p>
        </div>

        <div class="bounty-footer">
            <p><strong>DEAD OR ALIVE - RECRUITING</strong></p>
        </div>
    </div>
</section> 
</div>

<div class="luffy-container">
    <div class="bulle-dialogue" id="bulle-dialogue">
        "Je suis prêt pour le prochain match !"
    </div>
    <img src="assets/playerfocus.png" id="player-image" alt="Luffy">
</div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
           <div class="chart-container" style="position: relative; height:40vh; width:80vw; margin: auto;">
              <canvas id="radarChart"></canvas>
            </div>
            </div>
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
    </div>
</body>
</html>