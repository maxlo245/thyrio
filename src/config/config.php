<?php
// Configuration générale du site

// Affichage des erreurs en développement (à désactiver en prod)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Chargement automatique des bibliothèques installées avec Composer
// (Stripe, PayPal, PHPMailer, etc.)
$composerAutoload = __DIR__ . '/../../vendor/autoload.php';
if (file_exists($composerAutoload)) {
	require $composerAutoload;
}

// Constantes de base
define('BASE_URL', '/site web paiement/public'); // à adapter selon ton environnement

// Clés/API externes (à mettre idéalement dans des variables d'environnement)
// Exemple : Stripe, PayPal, etc.

// Fournisseur principal ("stripe" ou "paypal" par défaut)
define('PAYMENT_PROVIDER', 'stripe');

// Stripe (sert aussi de passerelle pour Google Pay / Apple Pay côté front)
define('STRIPE_SECRET_KEY', 'sk_test_votre_clef_ici'); // à remplacer
define('STRIPE_PUBLIC_KEY', 'pk_test_votre_clef_ici'); // à remplacer

// PayPal REST API
define('PAYPAL_CLIENT_ID', 'votre_client_id_paypal'); // à remplacer
define('PAYPAL_CLIENT_SECRET', 'votre_client_secret_paypal'); // à remplacer
define('PAYPAL_MODE', 'sandbox'); // sandbox ou live
