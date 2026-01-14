<?php
$title = 'Accueil';
ob_start();
?>
<h2>Nos produits</h2>
<div class="products">
    <?php foreach ($products as $product): ?>
        <div class="product">
            <h3><?= htmlspecialchars($product['name'] ?? 'Produit') ?></h3>
            <p><?= htmlspecialchars($product['description'] ?? '') ?></p>
            <p><strong><?= htmlspecialchars($product['price'] ?? '0') ?> €</strong></p>
            <a href="index.php?page=product&id=<?= (int) $product['id'] ?>">Voir le produit</a>
            <?php if (!empty($product['shopify_checkout_url'])): ?>
                <br>
                <a href="<?= htmlspecialchars($product['shopify_checkout_url']) ?>" target="_blank">
                    Acheter directement sur Shopify
                </a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
