import './style.css';

// Renseigne ta clé publique Stripe dans un fichier .env.local :
// VITE_STRIPE_PUBLIC_KEY=pk_test_...
const stripePublicKey = import.meta.env.VITE_STRIPE_PUBLIC_KEY || '';

const apiBaseUrl = import.meta.env.VITE_API_BASE_URL || '/api';

const app = document.querySelector('#app');

app.innerHTML = `
  <main class="page">
    <section class="panel panel-left">
      <h1 class="logo">Thyrio <span>Shop</span></h1>
      <p class="tagline">Checkout minimaliste pour ton futur site de dropshipping.</p>
      <p class="hint">Ce front est construit avec <strong>Vite.js</strong> et Stripe.js.</p>
    </section>
    <section class="panel panel-right glass">
      <h2>Paiement Stripe</h2>
      <form id="checkout-form" class="card">
        <label>Montant (en euros)
          <input type="number" id="amount" value="10" min="1" step="0.50" required />
        </label>

        <label>Devise
          <select id="currency">
            <option value="eur">EUR</option>
            <option value="usd">USD</option>
          </select>
        </label>

        <label>Données carte</label>
        <div id="card-element"></div>
        <div id="card-errors"></div>

        <button type="submit">Payer</button>
        <div id="status"></div>
      </form>
    </section>
  </main>
`;

if (!window.Stripe) {
  console.error('Stripe.js n\'est pas chargé');
}

const stripe = stripePublicKey && window.Stripe ? window.Stripe(stripePublicKey) : null;
const elements = stripe ? stripe.elements() : null;
const card = elements ? elements.create('card') : null;

if (card) {
  card.mount('#card-element');
}

const form = document.querySelector('#checkout-form');
const cardErrors = document.querySelector('#card-errors');
const status = document.querySelector('#status');

form.addEventListener('submit', async (event) => {
  event.preventDefault();
  cardErrors.textContent = '';
  status.textContent = '';

  if (!stripe || !card) {
    cardErrors.textContent = 'Stripe n\'est pas correctement configuré.';
    return;
  }

  const amountEuros = parseFloat(document.getElementById('amount').value || '0');
  if (!amountEuros || amountEuros <= 0) {
    cardErrors.textContent = 'Montant invalide.';
    return;
  }

  const amountCents = Math.round(amountEuros * 100);
  const currency = document.getElementById('currency').value || 'eur';

  try {
    const res = await fetch(`${apiBaseUrl}/create-payment-intent`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ amount: amountCents, currency })
    });

    const data = await res.json();
    if (!res.ok) {
      throw new Error(data.error || 'Erreur lors de la création du PaymentIntent');
    }

    const clientSecret = data.clientSecret;

    const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
      payment_method: { card }
    });

    if (error) {
      cardErrors.textContent = error.message;
      return;
    }

    if (paymentIntent && paymentIntent.status === 'succeeded') {
      status.style.color = 'var(--green)';
      status.textContent = 'Paiement réussi !';
    } else {
      status.style.color = 'var(--red)';
      status.textContent = 'Paiement non complété.';
    }
  } catch (e) {
    console.error(e);
    status.style.color = 'var(--red)';
    status.textContent = e.message || 'Erreur inattendue.';
  }
});
