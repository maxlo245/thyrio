import './style.css';

// Renseigne ta clé publique Stripe dans un fichier .env.local :
// VITE_STRIPE_PUBLIC_KEY=pk_test_...
const stripePublicKey = import.meta.env.VITE_STRIPE_PUBLIC_KEY || '';

const apiBaseUrl = import.meta.env.VITE_API_BASE_URL || '/api';

const app = document.querySelector('#app');

app.innerHTML = `
  <div class="shell">
    <header class="site-header glass">
      <div class="brand">
        <span class="brand-mark">TS</span>
        <span class="brand-text">Thyrio <strong>Shop</strong></span>
      </div>
      <nav class="nav">
        <button class="nav-link active" data-page="home">Accueil</button>
        <button class="nav-link" data-page="shop">Boutique</button>
        <button class="nav-link" data-page="checkout">Paiement</button>
        <button class="nav-link" data-page="about">À propos</button>
      </nav>
    </header>

    <main class="page">
      <section class="page-section" data-page="home">
        <section class="panel panel-left">
          <h1 class="logo">Thyrio <span>Shop</span></h1>
          <p class="tagline">Crée ton tunnel de vente moderne pour le dropshipping.</p>
          <p class="hint">Page d'accueil minimaliste en noir & blanc, prête à être reliée à Shopify ou Stripe.</p>
        </section>
      </section>

      <section class="page-section hidden" data-page="shop">
        <section class="panel panel-full glass">
          <h2>Boutique</h2>
          <p>Liste de produits à venir. Tu pourras ici afficher tes produits Shopify ou une API externe.</p>
        </section>
      </section>

      <section class="page-section hidden" data-page="checkout">
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
      </section>

      <section class="page-section hidden" data-page="about">
        <section class="panel panel-full glass">
          <h2>À propos</h2>
          <p>Thyrio Shop est un template léger pensé pour tester ton concept de boutique en ligne, avec un design noir & blanc et un checkout Stripe/Shopify.</p>
          <p>Tu pourras personnaliser cette section avec ton histoire, ta marque et tes réseaux sociaux.</p>
        </section>
      </section>
    </main>
  </div>
`;

// Navigation simple entre sections
const navLinks = document.querySelectorAll('.nav-link');
const sections = document.querySelectorAll('.page-section');

function setActivePage(page) {
  navLinks.forEach((btn) => {
    btn.classList.toggle('active', btn.dataset.page === page);
  });

  sections.forEach((section) => {
    section.classList.toggle('hidden', section.dataset.page !== page);
  });
}

navLinks.forEach((btn) => {
  btn.addEventListener('click', () => {
    const page = btn.dataset.page;
    setActivePage(page);
  });
});

// Stripe / paiement (section checkout)
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
