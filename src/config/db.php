<?php
// Connexion à la base de données (exemple MySQL)

$host = 'localhost';
$dbname = 'boutique_en_ligne';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion: ' . $e->getMessage());
}
