<section class="about-section">
    <h2>À propos de Thyrio</h2>
    <p class="about-intro">
        Bienvenue sur <strong>Thyrio</strong>, votre boutique en ligne nouvelle génération !<br>
        Notre mission : offrir une expérience d’achat unique, moderne et sécurisée, portée par la technologie et la passion du service client.
    </p>
    <div class="about-content">
        <img src="public/images/logo.png" alt="Logo Thyrio" class="about-logo">
        <ul class="about-values">
            <li>Large choix de produits sélectionnés</li>
            <li>Paiement rapide et sécurisé</li>
            <li>Interface moderne et animations uniques</li>
            <li>Support client réactif</li>
        </ul>
    </div>
    <section class="about-story">
        <h3>Notre histoire</h3>
        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <strong>2024</strong> — Lancement de Thyrio, avec une vision : réinventer l’e-commerce.
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <strong>2025</strong> — Première version publique, premiers clients, premiers retours enthousiastes !
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <strong>2026</strong> — Nouvelles fonctionnalités, animations uniques, et une communauté qui grandit.
                </div>
            </div>
        </div>
    </section>
    <section class="about-team">
        <h3>L’équipe Thyrio</h3>
        <div class="team-list">
            <div class="team-member">
                <div class="avatar" style="background:#222;"></div>
                <div class="name">Maxime</div>
                <div class="role">Fondateur & Développeur</div>
            </div>
            <div class="team-member">
                <div class="avatar" style="background:#222;"></div>
                <div class="name">Sophie</div>
                <div class="role">Design & Expérience</div>
            </div>
            <div class="team-member">
                <div class="avatar" style="background:#222;"></div>
                <div class="name">Lucas</div>
                <div class="role">Support & Relation client</div>
            </div>
        </div>
    </section>
    <p class="about-thanks">
        Merci de votre confiance et bonne visite sur Thyrio !
    </p>
</section>
<style>
.about-section {
    max-width: 800px;
    margin: 0 auto;
    padding: 2.5rem 1.5rem 3rem;
    background: rgba(255,255,255,0.03);
    border-radius: 18px;
    box-shadow: 0 8px 32px #00ffe722;
    animation: fadeInUp 1.2s cubic-bezier(.77,0,.18,1);
}
.about-logo {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: #000;
    margin: 2rem 0;
    box-shadow: 0 0 32px #00ffe7cc;
    display: block;
    transition: transform 0.5s cubic-bezier(.77,0,.18,1);
}
.about-logo:hover {
    transform: scale(1.08) rotate(-6deg);
    box-shadow: 0 0 64px #00ffe7cc;
}
.about-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
}
.about-values {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 1.2rem 2.5rem;
    justify-content: center;
}
.about-values li {
    font-size: 1.1rem;
    background: rgba(0,0,0,0.18);
    border-radius: 999px;
    padding: 0.5rem 1.2rem;
    box-shadow: 0 2px 8px #00ffe733;
    display: flex;
    align-items: center;
    gap: 0.7em;
    transition: background 0.3s;
}
.about-values li span {
    font-size: 1.3em;
}
.about-values li:hover {
    background: #00ffe7cc;
    color: #000;
}
.about-story {
    margin: 2.5rem 0 1.5rem;
}
.timeline {
    border-left: 3px solid #00ffe7cc;
    margin-left: 1.5rem;
    padding-left: 1.5rem;
    position: relative;
}
.timeline-item {
    margin-bottom: 1.5rem;
    position: relative;
}
.timeline-dot {
    width: 18px;
    height: 18px;
    background: #00ffe7;
    border-radius: 50%;
    position: absolute;
    left: -2.1rem;
    top: 0.2rem;
    box-shadow: 0 0 16px #00ffe7cc;
    border: 3px solid #fff;
}
.timeline-content {
    font-size: 1.05rem;
    color: #e0f7fa;
    background: rgba(0,0,0,0.18);
    border-radius: 8px;
    padding: 0.7rem 1.1rem;
    margin-left: 0.5rem;
    box-shadow: 0 2px 8px #00ffe733;
}
.about-team {
    margin: 2.5rem 0 1.5rem;
}
.team-list {
    display: flex;
    gap: 2.5rem;
    justify-content: center;
    flex-wrap: wrap;
}
.team-member {
    display: flex;
    flex-direction: column;
    align-items: center;
    background: rgba(0,0,0,0.18);
    border-radius: 16px;
    padding: 1.2rem 1.5rem;
    box-shadow: 0 2px 8px #00ffe733;
    min-width: 120px;
    margin-bottom: 1rem;
    transition: transform 0.3s;
}
.team-member:hover {
    transform: translateY(-8px) scale(1.04);
    box-shadow: 0 8px 32px #00ffe7cc;
}
.avatar {
    width: 54px;
    height: 54px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.1em;
    margin-bottom: 0.5rem;
    background: #111;
    box-shadow: 0 0 12px #00ffe7cc;
}
.name {
    font-weight: bold;
    margin-bottom: 0.2rem;
}
.role {
    font-size: 0.95em;
    color: #00ffe7;
}
.about-intro {
    font-size: 1.15em;
    text-align: center;
    margin-bottom: 2rem;
}
.about-thanks {
    text-align: center;
    margin-top: 2.5rem;
    font-size: 1.1em;
    color: #00ffe7;
    letter-spacing: 0.04em;
}
@media (max-width: 700px) {
    .about-content, .team-list {
        flex-direction: column;
        gap: 1.5rem;
    }
    .about-section {
        padding: 1.2rem 0.2rem 2rem;
    }
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>