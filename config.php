<?php
$pdo = new PDO("mysql:host=localhost;dbname=basket_pirate", "stone", "ubuntu/ubuntu#");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Test rapide pour le terminal
if ($pdo) { echo "Connexion réussie au Grand Line ! \n"; }
?>