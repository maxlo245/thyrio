<?php
$title = 'Paiement';
ob_start();
?>
<h2>Paiement</h2>
<?php if (!empty($cartDetails)): ?>
    <h3>Récapitulatif du panier</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix unitaire</th>
            <th>Total ligne</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cartDetails as $line): ?>
            <?php $p = $line['product']; ?>
            <tr>
                <td><?= htmlspecialchars($p['name'] ?? 'Produit') ?></td>
                <td><?= (int) $line['qty'] ?></td>
                <td><?= number_format((float) ($p['price'] ?? 0), 2, ',', ' ') ?> €</td>
                <td><?= number_format($line['line_total'] / 100, 2, ',', ' ') ?> €</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Votre panier est vide.</p>
<?php endif; ?>

<p>Montant à payer : <strong><?= number_format($amount / 100, 2, ',', ' ') ?> €</strong></p>

<?php if (isset($paymentOk) && $paymentOk === true): ?>
    <p style="color: green;">Paiement accepté. Merci pour votre achat !</p>
<?php elseif (isset($paymentOk) && $paymentOk === false): ?>
    <p style="color: red;">Le paiement a échoué.
        <?php if (!empty($paymentError)): ?>
            <br><?= htmlspecialchars($paymentError) ?>
        <?php endif; ?>
    </p>
<?php endif; ?>

<form id="payment-form" method="post" action="">
    <fieldset>
        <legend>Moyen de paiement</legend>
        <label>
            <input type="radio" name="provider" value="stripe" checked>
            Carte bancaire (Stripe / Google Pay / Apple Pay côté front)
        </label><br>
        <label>
            <input type="radio" name="provider" value="paypal">
            PayPal
        </label>
    </fieldset>

    <fieldset id="stripe-card-section">
        <legend>Carte bancaire (Stripe)</legend>
        <p><em>Les informations de carte sont gérées par Stripe (Elements).</em></p>
        <div id="card-element" style="padding:0.5rem; border:1px solid #ccc; background:#fff;"></div>
        <div id="card-errors" style="color:red; margin-top:0.5rem;"></div>
    </fieldset>

    <input type="hidden" name="payment_method_id" id="payment_method_id">

    <button type="submit">Payer</button>
</form>

<script src="https://js.stripe.com/v3"></script>
<script>
    const stripePublicKey = "<?= htmlspecialchars(STRIPE_PUBLIC_KEY, ENT_QUOTES, 'UTF-8') ?>";

    if (stripePublicKey && window.Stripe) {
        const stripe = Stripe(stripePublicKey);
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        const cardErrors = document.getElementById('card-errors');

        form.addEventListener('submit', async function (event) {
            const provider = form.querySelector('input[name="provider"]:checked')?.value || 'stripe';
            if (provider !== 'stripe') {
                // Pour PayPal, on laisse le formulaire partir tel quel (gestion séparée à implémenter).
                return;
            }

            event.preventDefault();
            cardErrors.textContent = '';

            const {error, paymentMethod} = await stripe.createPaymentMethod({
                type: 'card',
                card: card
            });

            if (error) {
                cardErrors.textContent = error.message;
                return;
            }

            document.getElementById('payment_method_id').value = paymentMethod.id;
            form.submit();
        });
    }
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
