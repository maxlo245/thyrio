<?php
// Template de layout principal
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Boutique en ligne') ?></title>
    <link rel="stylesheet" href="styles.css"><!-- tu pourras ajouter un vrai CSS ici -->
</head>
<body>
<header>
    <h1>Boutique en ligne</h1>
    <nav>
        <a href="index.php?page=home">Accueil</a>
        <a href="index.php?page=cart">Panier</a>
        <a href="index.php?page=login">Connexion</a>
    </nav>
</header>
<main>
    <?= $content ?? '' ?>
</main>
<footer>
    <p>&copy; <?= date('Y') ?> - Ma boutique</p>
</footer>
</body>
</html>
