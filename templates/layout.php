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
    <div style="display: flex; align-items: center; gap: 16px;">
        <img src="public/images/logo.png" alt="Logo" style="width:60px;height:60px;border-radius:50%;background:#000;object-fit:cover;" />
        <h1>Boutique en ligne</h1>
    </div>
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
