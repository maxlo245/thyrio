<?php

require_once __DIR__ . '/../services/PaymentService.php';
require_once __DIR__ . '/../models/Cart.php';
require_once __DIR__ . '/../models/Product.php';

class OrderController
{
    public function checkout(): void
    {
        // Calcul du total réel du panier à partir des produits
        global $pdo; // connexion définie dans db.php

        $cart = new Cart();
        $items = $cart->all(); // [productId => qty]

        $productModel = new Product($pdo);

        $amount = 0; // total en centimes
        $cartDetails = [];

        foreach ($items as $productId => $qty) {
            $product = $productModel->getById((int) $productId);
            if (!$product) {
                continue;
            }

            $price = (float) ($product['price'] ?? 0); // prix en euros
            $lineTotal = (int) round($price * 100) * (int) $qty; // en centimes

            $amount += $lineTotal;

            $cartDetails[] = [
                'product' => $product,
                'qty' => (int) $qty,
                'line_total' => $lineTotal,
            ];
        }

        $paymentOk = null;
        $paymentError = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Choix du fournisseur : Stripe / PayPal
            $provider = $_POST['provider'] ?? PAYMENT_PROVIDER;

            $paymentService = new PaymentService($provider);

            // Options transmises au service (Stripe : payment_method_id, etc.)
            $options = [
                'payment_method_id' => $_POST['payment_method_id'] ?? null,
            ];

            try {
                $paymentOk = $paymentService->processPayment($amount, 'eur', $options);
            } catch (Exception $e) {
                $paymentOk = false;
                $paymentError = $e->getMessage();
            }
        }

        // Variables passées à la vue : $amount, $paymentOk, $paymentError, $cartDetails
        include __DIR__ . '/../../templates/checkout.php';
    }
}
