<?php
$title = 'Votre panier';
ob_start();
?>
<h2>Panier</h2>
<?php if (empty($items)): ?>
    <p>Votre panier est vide.</p>
<?php else: ?>
    <ul>
        <?php foreach ($items as $productId => $qty): ?>
            <li>Produit #<?= (int) $productId ?> - Quantité: <?= (int) $qty ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="index.php?page=checkout">Passer au paiement</a>
<?php endif; ?>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
