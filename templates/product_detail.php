<?php
$title = $product['name'] ?? 'Détail produit';
ob_start();
?>
<?php if ($product): ?>
    <h2><?= htmlspecialchars($product['name']) ?></h2>
    <p><?= htmlspecialchars($product['description']) ?></p>
    <p><strong><?= htmlspecialchars($product['price']) ?> €</strong></p>
    <form method="post" action="index.php?page=cart&action=add">
        <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">
        <input type="number" name="qty" value="1" min="1">
        <button type="submit">Ajouter au panier</button>
    </form>
    <?php if (!empty($product['shopify_checkout_url'])): ?>
        <p>
            <a href="<?= htmlspecialchars($product['shopify_checkout_url']) ?>" target="_blank">
                Acheter ce produit sur Shopify
            </a>
        </p>
    <?php endif; ?>
<?php else: ?>
    <p>Produit introuvable.</p>
<?php endif; ?>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
