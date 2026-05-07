<?php
$host = 'localhost';
$dbname = 'basket_pirate';
$username = 'stone';
$password = 'ubuntu/ubuntu#';

try {
    // Create a new PDO instance /secure connection to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname; charset=utf8", $username, $password);

    //montre les erreurs de connexion à la base de données
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Show database connection error message
    die("Connection failed: " . $e->getMessage());
}
?>