<?php 
require_once 'db.php'; 

// 1. Récupération des stats
$query = $pdo->query("SELECT * FROM player_stats LIMIT 1");
$stats = $query->fetch(PDO::FETCH_ASSOC);

// 2. Logique du personnage (Mood)
$mood = "normal";
if ($stats['points'] > 20) {
    $mood = "serieux"; // Mode Gear 4 / Combat
}
?>
<?php include 'config.php'; 
$res = $pdo->query("SELECT * FROM ta_table_joueur LIMIT 1");
$player = $res->fetch(); ?>
<!-- Ton HTML ici avec <?= $player['ton_champ'] ?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class = "player-container">
        <img src="assets/playerfocus.png" alt="Player" id="player-image">

        <div class="bulle-dialogue" id="bulle-dialogue">"YO! je cherche un équipage pour conquérir le championnat!"</div>

    </div>
</body>
</html>