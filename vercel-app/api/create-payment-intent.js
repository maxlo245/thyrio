// API serverless Vercel pour créer un PaymentIntent Stripe
// Endpoint: POST /api/create-payment-intent

const Stripe = require('stripe');

// La clé doit être configurée dans Vercel (Environment Variables)
const stripeSecretKey = process.env.STRIPE_SECRET_KEY;

if (!stripeSecretKey) {
  console.warn('STRIPE_SECRET_KEY n\'est pas défini dans les variables d\'environnement.');
}

const stripe = new Stripe(stripeSecretKey || '', {
  apiVersion: '2023-10-16'
});

module.exports = async (req, res) => {
  if (req.method !== 'POST') {
    res.statusCode = 405;
    res.setHeader('Allow', 'POST');
    return res.json({ error: 'Méthode non autorisée' });
  }

  try {
    const { amount, currency } = req.body || {};

    if (!amount || !currency) {
      return res.status(400).json({ error: 'amount et currency sont requis' });
    }

    const paymentIntent = await stripe.paymentIntents.create({
      amount,
      currency
    });

    return res.status(200).json({
      clientSecret: paymentIntent.client_secret
    });
  } catch (err) {
    console.error(err);
    return res.status(500).json({ error: err.message || 'Erreur serveur lors de la création du PaymentIntent' });
  }
};
