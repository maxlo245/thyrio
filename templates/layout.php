<?php
// Template de layout principal
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Boutique en ligne') ?></title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="public/swup-animations.css">
    <!-- Swup CDN -->
    <script src="https://unpkg.com/swup@4.6.2/dist/swup.min.js"></script>
</head>
<body>
<header>
    <div style="display: flex; align-items: center; gap: 16px;">
        <img src="public/images/logo.png" alt="Logo" style="width:60px;height:60px;border-radius:50%;background:#000;object-fit:cover;" />
        <h1>Boutique en ligne</h1>
    </div>
    <nav>
        <a href="index.php?page=home">Accueil</a>
        <a href="index.php?page=about">Présentation</a>
        <a href="index.php?page=cart">Panier</a>
        <a href="index.php?page=login">Connexion</a>
    </nav>
</header>
<div id="swup" class="transition-fade">
    <main>
        <?= $content ?? '' ?>
    </main>
</div>
<footer>
    <p>&copy; <?= date('Y') ?> - Ma boutique</p>
</footer>
<script>
    // Animation Swup avancée
    const swup = new Swup({});

    // Animation lettre par lettre sur le titre de la page de présentation
    function animateTitle() {
        const aboutTitle = document.querySelector('.about-section h2');
        if (aboutTitle && !aboutTitle.classList.contains('animated-title')) {
            const text = aboutTitle.textContent;
            aboutTitle.innerHTML = '';
            aboutTitle.classList.add('animated-title');
            [...text].forEach((char, i) => {
                const span = document.createElement('span');
                span.textContent = char;
                aboutTitle.appendChild(span);
                setTimeout(() => span.classList.add('visible'), 60 * i);
            });
        }
    }

    // Animation de particules autour du logo
    function createParticles() {
        const logo = document.querySelector('img[alt="Logo"], img[alt="Logo Thyrio"]');
        if (!logo) return;
        let container = document.getElementById('logo-particles');
        if (!container) {
            container = document.createElement('div');
            container.id = 'logo-particles';
            container.style.position = 'absolute';
            container.style.pointerEvents = 'none';
            container.style.left = 0;
            container.style.top = 0;
            container.style.width = '100vw';
            container.style.height = '100vh';
            document.body.appendChild(container);
        }
        container.innerHTML = '';
        const rect = logo.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;
        for (let i = 0; i < 18; i++) {
            const p = document.createElement('div');
            const angle = (i / 18) * 2 * Math.PI;
            const radius = 60 + Math.random() * 24;
            p.style.position = 'absolute';
            p.style.left = (centerX + Math.cos(angle) * radius) + 'px';
            p.style.top = (centerY + Math.sin(angle) * radius) + 'px';
            p.style.width = p.style.height = (6 + Math.random() * 6) + 'px';
            p.style.borderRadius = '50%';
            p.style.background = 'rgba(0,255,231,0.7)';
            p.style.boxShadow = '0 0 16px #00ffe7cc';
            p.style.opacity = 0.7 + 0.3 * Math.random();
            p.style.transition = 'all 0.7s cubic-bezier(.77,0,.18,1)';
            container.appendChild(p);
        }
        setTimeout(() => { if (container) container.innerHTML = ''; }, 900);
    }

    // Effet glitch JS sur le titre principal de la page de présentation
    function glitchTitle() {
        const aboutTitle = document.querySelector('.about-section h2');
        if (!aboutTitle) return;
        let glitchInterval = aboutTitle.getAttribute('data-glitch-interval');
        if (glitchInterval) return; // déjà lancé
        glitchInterval = setInterval(() => {
            if (Math.random() > 0.7) {
                aboutTitle.style.transform = `skewX(${(Math.random()-0.5)*12}deg) translateX(${(Math.random()-0.5)*8}px)`;
                aboutTitle.style.filter = 'contrast(1.5)';
                aboutTitle.style.opacity = 0.7 + Math.random()*0.3;
                setTimeout(() => {
                    aboutTitle.style.transform = '';
                    aboutTitle.style.filter = '';
                    aboutTitle.style.opacity = '';
                }, 120 + Math.random()*120);
            }
        }, 350);
        aboutTitle.setAttribute('data-glitch-interval', glitchInterval);
    }

    // Ajout d'un background "scanlines" animé
    function addScanlines() {
        if (document.getElementById('scanlines-bg')) return;
        const scan = document.createElement('div');
        scan.id = 'scanlines-bg';
        scan.style.position = 'fixed';
        scan.style.left = 0;
        scan.style.top = 0;
        scan.style.width = '100vw';
        scan.style.height = '100vh';
        scan.style.pointerEvents = 'none';
        scan.style.zIndex = 1;
        scan.style.background = 'repeating-linear-gradient(180deg, transparent, transparent 2px, rgba(0,255,231,0.08) 3px, transparent 4px)';
        scan.style.opacity = 0.5;
        scan.style.mixBlendMode = 'screen';
        document.body.appendChild(scan);
    }

    // Hook Swup pour relancer les animations à chaque transition
    function runAnimations() {
        animateTitle();
        createParticles();
        glitchTitle();
        addScanlines();
    }
    document.addEventListener('swup:contentReplaced', runAnimations);
    window.addEventListener('DOMContentLoaded', runAnimations);
</script>
</body>
</html>
