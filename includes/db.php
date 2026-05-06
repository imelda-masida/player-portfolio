<?php
$host = 'localhost';
$dbname = 'basket_pirate';
$username = 'root';
$password = '12 mamere monmonde';

try {
    // Create a new PDO instance /secure connection to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    //montre les erreurs de connexion à la base de données
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Show database connection error message
    die("Connection failed: " . $e->getMessage());
}
?>