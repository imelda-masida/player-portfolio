<?php 
require_once 'config.php'; 

try {
    $query = $pdo->query("SELECT * FROM joueur_stats LIMIT 1");
    $stats = $query->fetch(PDO::FETCH_ASSOC);

    // --- LOGIQUE DE L'IMAGE DYNAMIQUE ---
    $image_joueur = "assets/playerfocus.png"; // Image par défaut si aucune condition n'est remplie

    if ($stats['energy_level'] > 80) {
        $image_joueur = "assets/smilestyle.png"; // Mode Focus (ton image actuelle)
    } elseif ($stats['energy_level'] < 30) {
        $image_joueur = "assets/luffystyle.png"; // Mode Fatigué
    }

} catch (Exception $e) {
    $stats = ['points' => 0, 'assists' => 0, 'energy_level' => 0, 'age' => 0, 'taille' => 0];
    $image_joueur = "assets/playerfocus.png";
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
                <p><strong>ORIGINE:</strong> <?= htmlspecialchars($stats['nationalite']) ?></p>
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
<section id="contact">
          <h2>REJOINDRE L'ÉQUIPAGE</h2>
       <form action="send_message.php" method="POST" class="manga-form">
           <input type="text" name="expediteur" placeholder="Ton Nom" required>
           <input type="text" name="club" placeholder="Ton Club / Organisation">
           <textarea name="contenu" placeholder="Ton message pour le futur Roi du Terrain..." required></textarea>
          <button type="submit" class="btn-pirate">ENVOYER LE MESSAGE</button>
      </form>
     </section>
<div class="luffy-container">
    <div class="bulle-dialogue" id="bulle-dialogue">
        "Je suis prêt pour le prochain match !"
    </div>
    <img src="<?= $image_joueur ?>" id="player-image" alt="Statut Joueur">
</div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
           <div class="chart-container" style="position: relative; height:40vh; width:80vw; margin: auto;">
              <canvas id="radarChart"></canvas>
            </div>
            </div>
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
            
   <script>
    // Configuration du Graphique Radar avec tes données PHP
    const ctx = document.getElementById('radarChart').getContext('2d');
    const radarChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['Points', 'Assists', 'Énergie', 'Vitesse', 'Mental'],
            datasets: [{
                label: 'Stats Actuelles',
                data: [
                    <?= intval($stats['points']) ?>, 
                    <?= intval($stats['assists']) ?>, 
                    <?= intval($stats['energy_level']) ?>, 
                    85, // Tu pourras ajouter une colonne 'vitesse' en DB plus tard
                    90  // Haki du conquérant
                ],
                backgroundColor: 'rgba(239, 35, 60, 0.2)',
                borderColor: '#EF233C',
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                r: { suggestMin: 0, suggestMax: 100 }
            }
        }
    });

    // Animation de la Bulle de dialogue
    document.addEventListener("DOMContentLoaded", () => {
        const bulle = document.getElementById('bulle-dialogue');
        const nrg = <?= intval($stats['energy_level']) ?>;

        // On change le texte selon l'énergie
        if (nrg > 80) {
            bulle.innerText = "Je suis bouillant pour le prochain match ! 🏀";
        } else if (nrg < 40) {
            bulle.innerText = "Besoin de repos... et de viande ! 🍖";
        }

        // Petit effet d'apparition
        bulle.style.opacity = "0";
        setTimeout(() => {
            bulle.style.transition = "opacity 0.5s ease-in-out";
            bulle.style.opacity = "1";
        }, 800);
    });
</script>
    </div>
</body>
</html>