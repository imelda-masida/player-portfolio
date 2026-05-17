<?php 
require_once 'config.php'; 

try {
    $query = $pdo->query("SELECT * FROM joueur_stats LIMIT 1");
    $stats = $query->fetch(PDO::FETCH_ASSOC);

    // Logique de l'image dynamique
    $image_joueur = "assets/luffystyle.png"; 
    if ($stats['energy_level'] > 80) {
        $image_joueur = "assets/playerfocus.png"; 
    } elseif ($stats['energy_level'] < 30) {
        $image_joueur = "assets/smilestyle.png"; 
    }
} catch (Exception $e) {
    $stats = ['points' => 0, 'assists' => 0, 'energy_level' => 0, 'age' => 0, 'taille' => 0, 'style_jeu' => 'Non défini'];
    $image_joueur = "assets/luffystyle.png";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Stats de Pirate</title>
    <!-- Chargement de la bibliothèque d'icônes Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- DEBUT DU RUBAN -->
<div class="top-ribbon">
    <div class="ribbon-text">
        <!-- Message principal du ruban -->
        <span>🏴‍☠️ RECRUTEMENT DE L'ÉQUIPAGE OUVERT - SAISON 2026 🏀</span>
    </div>
</div>
<!-- FIN DU RUBAN  -->
    <div class="main-wrapper">

        <!--  Le haut de la page (WANTED - PERSO - FORMULAIRE) -->
        <div class="top-layout">
            
            <!--  La carte Wanted -->
            <section id="bounty">
                <div class="bounty-card">
                    <h1 class="wanted-title">WANTED</h1>
                    <div class="bounty-content">
                        <div class="stats-col">
                            <p><strong>ÂGE:</strong> <?= htmlspecialchars($stats['age'] ?? '0') ?> ANS</p>
                            <p><strong>TAILLE:</strong> <?= htmlspecialchars($stats['taille'] ?? '0') ?> CM</p>
                            <p><strong>POIDS:</strong> <?= htmlspecialchars($stats['poids'] ?? '0') ?> KG</p>
                            <p><strong>MAIN:</strong> <?= htmlspecialchars($stats['main_forte'] ?? 'Droite') ?></p>
                        </div>
                        <div class="stats-col">
                            <p><strong>VILLE:</strong> <?= htmlspecialchars($stats['ville'] ?? 'Inconnue') ?></p>
                            <p><strong>NATION:</strong> <?= htmlspecialchars($stats['nationalite'] ?? 'Inconnue') ?></p>
                            <p><strong>POSTE:</strong> <?= htmlspecialchars($stats['position'] ?? 'Meneur') ?></p>
                            <p><strong>LANGUES:</strong> <?= htmlspecialchars($stats['langues'] ?? 'Français') ?></p>
                        </div>
                    </div>
                    <div class="skills-highlight">
                        <p><strong>STYLE DE JEU:</strong> <?= htmlspecialchars($stats['style_jeu'] ?? 'All-Around') ?></p>
                    </div>
                    <div class="bounty-footer">
                        <p><strong>DEAD OR ALIVE - RECRUITING</strong></p>
                    </div>
                </div>
            </section> 

            <!--  Le Personnage et sa Bulle -->
            <div class="luffy-container">
                <div class="bulle-dialogue" id="bulle-dialogue">
                    "Je suis prêt pour le prochain match !"
                </div>
                <img src="<?= $image_joueur ?>" id="player-image" alt="Joueur">
            </div>

            <!--  Envoyer un message -->
            <section id="contact">
                <h2>REJOINDRE L'ÉQUIPAGE</h2>
                <form action="send_message.php" method="POST" class="manga-form">
                    <input type="text" name="expediteur" placeholder="Ton Nom" required>
                    <input type="text" name="club" placeholder="Ton Club / Organisation">
                    <textarea name="contenu" placeholder="Ton message pour le futur Roi du Terrain..." required></textarea>
                    <button type="submit" class="btn-pirate">ENVOYER LE MESSAGE</button>
                </form>
            </section>

        </div> <!-- Fin de la top-layout -->

        <!--  La Vidéo au milieu à l'horizontale -->
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

        <!--  La Carte de performance (Le Radar Chart) -->
        <section id="performance">
            <h2>PERFORMANCE SUR LE TERRAIN</h2>
            <div class="chart-container">
                <canvas id="radarChart"></canvas>
            </div>
        </section>

    </div> <!-- Fin du main-wrapper -->

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('radarChart').getContext('2d');
        const radarChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['Points', 'Assists', 'Énergie', 'Vitesse', 'Mental'],
                datasets: [{
                    label:'Stats Actuelles',
                    data: [
                        <?= intval($stats['points'] ?? 0) ?>, 
                        <?= intval($stats['assists'] ?? 0) ?>, 
                        <?= intval($stats['energy_level'] ?? 0) ?>, 
                        85, 
                        90  
                    ],
                    backgroundColor: 'rgba(239, 35, 60, 0.2)',
                    borderColor: '#EF233C',
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: { suggestMin: 0, suggestMax: 100 }
                },
                plugins: {
                    legend: {
                        display: false // On cache la légende d'origine pour mettre notre badge orange HTML
                    }
                }
            }
        });

        document.addEventListener("DOMContentLoaded", () => {
            const bulle = document.getElementById('bulle-dialogue');
            const nrg = <?= intval($stats['energy_level'] ?? 0) ?>;

            if (nrg > 80) {
                bulle.innerText = "Je suis bouillant pour le prochain match ! 🏀";
            } else if (nrg < 40) {
                bulle.innerText = "Besoin de repos... et de viande ! 🍖";
            }
        });
    </script>
   <footer class="footer-pirate">
    <div class="footer-content">
        <!--  Copyright -->
        <div class="footer-left">
            <p>&copy; 2026 Stats de Pirate. Tous droits réservés | Développé par <span class="highlight">Stone</span></p>
        </div>

        <!-- les Canaux de Contact avec les vrais logos -->
<div class="footer-right">
    <a href="mailto:tonadresse@email.com" class="social-link email" title="E-mail">
        <i class="fa-solid fa-envelope"></i> <span></span>
    </a>
    <a href="https://wa.me/243XXXXXXXXX" target="_blank" class="social-link whatsapp" title="WhatsApp">
        <i class="fa-brands fa-whatsapp"></i> <span></span>
    </a>
    <a href="https://t.me/ton_username" target="_blank" class="social-link telegram" title="Telegram">
        <i class="fa-brands fa-telegram"></i> <span></span>
    </a>
    <a href="https://instagram.com/ton_compte" target="_blank" class="social-link instagram" title="Instagram">
        <i class="fa-brands fa-instagram"></i> <span></span>
    </a>
    <a href="https://tiktok.com/@ton_compte" target="_blank" class="social-link tiktok" title="TikTok">
        <i class="fa-brands fa-tiktok"></i> <span></span>
    </a>
   </div>
    </div>
</footer>
</body>
</html>