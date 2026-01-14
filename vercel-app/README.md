# API Paiement Vercel (Stripe)

Ce dossier contient une petite API Node prête à être déployée sur Vercel pour gérer les paiements Stripe.

## Structure

- `api/create-payment-intent.js` : fonction serverless Vercel
- `package.json` : dépendances (Stripe)
- `vercel.json` : configuration basique pour Vercel

## Utilisation

1. Dans ce dossier :

```bash
npm install
```

2. Sur Vercel (dashboard ou CLI), crée un nouveau projet à partir de ce dossier.

3. Dans les **Environment Variables** du projet Vercel, ajoute :

- `STRIPE_SECRET_KEY` : ta clé secrète Stripe (commence par `sk_live_` ou `sk_test_`).

4. Déploie. L\'endpoint sera disponible à l\'adresse :

```text
https://ton-projet.vercel.app/api/create-payment-intent
```

Tu peux l\'appeler en POST JSON :

```json
{
  "amount": 1000,
  "currency": "eur"
}
```

Il renverra :

```json
{
  "clientSecret": "..."
}
```

que tu pourras utiliser côté front avec Stripe.js.

## Exemple de frontend (index.html)

Un fichier `index.html` est fourni à la racine du dossier. Il :

- charge Stripe.js (`https://js.stripe.com/v3`),
- affiche un formulaire avec un montant, une devise et un élément carte,
- appelle `/api/create-payment-intent` pour créer le PaymentIntent,
- confirme le paiement avec `stripe.confirmCardPayment`.

Avant de déployer, édite `index.html` et remplace `pk_test_votre_clef_publique_ici` par ta **clé publique Stripe** (publishable key).
