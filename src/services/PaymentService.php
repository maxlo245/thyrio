<?php
// Service de paiement : point central pour appeler les APIs externes
// Ici tu pourras brancher Stripe, PayPal, etc.

class PaymentService
{
    private string $provider;

    public function __construct(string $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Exemple de méthode générique pour traiter un paiement.
     * $amount en centimes (ex : 1000 = 10.00 €)
     */
    public function processPayment(int $amount, string $currency = 'eur', array $options = []): bool
    {
        // TODO : brancher ici votre fournisseur de paiement réel.
        // Les montants sont en centimes (1000 = 10.00 €).

        switch ($this->provider) {
            case 'stripe':
                return $this->processWithStripe($amount, $currency, $options);

            case 'paypal':
                return $this->processWithPaypal($amount, $currency, $options);

            default:
                // Fournisseur non supporté
                return false;
        }
    }

    /**
     * Paiement via Stripe (peut servir de base pour Google Pay / Apple Pay
     * via les Payment Request Buttons côté front).
     *
     * Nécessite :
     *   composer require stripe/stripe-php
     */
    private function processWithStripe(int $amount, string $currency, array $options): bool
    {
        // Ici tu peux utiliser le SDK officiel Stripe.
        // Assure-toi d'avoir installé la bibliothèque et d'avoir
        // configuré STRIPE_SECRET_KEY dans config.php.

        if (!class_exists('\\Stripe\\Stripe')) {
            // SDK non installé : on lève une exception claire.
            throw new RuntimeException('SDK Stripe non disponible. Installe stripe/stripe-php avec Composer.');
        }

        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

        // Exemple simplifié : on crée une intention de paiement.
        // Dans un vrai projet, tu géreras aussi le client, les méthodes
        // de paiement, les éventuelles confirmations côté front, etc.

        $params = [
            'amount' => $amount,
            'currency' => $currency,
        ];

        if (!empty($options['payment_method_id'])) {
            $params['payment_method'] = $options['payment_method_id'];
            $params['confirm'] = true;
            $params['confirmation_method'] = 'automatic';
        }

        $intent = \Stripe\PaymentIntent::create($params);

        return isset($intent->status) && $intent->status === 'succeeded';
    }

    /**
     * Paiement via PayPal REST API.
     *
     * Nécessite :
     *   composer require paypal/rest-api-sdk-php
     * ou le SDK recommandé par la doc officielle actuelle.
     */
    private function processWithPaypal(int $amount, string $currency, array $options): bool
    {
        // Pour PayPal, l'intégration classique web passe par une redirection
        // ou un bouton JavaScript sur la page de paiement. Ici, côté serveur,
        // tu peux créer l'ordre de paiement via leur SDK.

        // Comme PayPal propose plusieurs SDK et versions, le code exact
        // dépendra du package que tu installes. L'idée générale :
        //  - initialiser le client avec PAYPAL_CLIENT_ID / PAYPAL_CLIENT_SECRET
        //  - créer un ordre de paiement pour $amount
        //  - gérer ensuite la validation/retour sur une autre route.

        // Pour garder cet exemple simple et sans dépendance forte,
        // on indique ici que le paiement n'est pas réellement traité :
        throw new RuntimeException('Intégration PayPal à implémenter selon le SDK choisi.');
    }
}
