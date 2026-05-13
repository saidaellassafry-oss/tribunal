<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tribunal de Sidi Bennour | Justice Digitale</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --primary: #0f172a;
            --accent: #d4af37; 
            --bg-dark: linear-gradient(135deg, #0f172a, #1e3a8a, #2563eb);
            --glass: rgba(255, 255, 255, 0.08);
            --border: rgba(255,255,255,0.1);
            --text: #ffffff;
            --text-secondary: rgba(255,255,255,0.8);
            --transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="light"] {
            --bg-dark: linear-gradient(135deg, #e2e8f0, #cbd5e1, #94a3b8);
            --text: #1e293b;
            --text-secondary: #475569;
            --glass: rgba(255, 255, 255, 0.9);
            --border: rgba(148, 163, 184, 0.3);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);
            color: var(--text);
            overflow-x: hidden;
            line-height: 1.6;
            transition: var(--transition);
            min-height: 100vh;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at 50% 50%, rgba(37, 99, 235, 0.2) 0%, transparent 80%);
            z-index: -1;
        }

        header {
            padding: 1.5rem 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(20px);
            background: rgba(255,255,255,0.08);
            border-bottom: 1px solid var(--border);
            position: sticky; top: 0; z-index: 1000;
        }

        .logo-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            letter-spacing: 1px;
            color: var(--text);
        }

        .logo-text p {
            font-size: 0.6rem;
            letter-spacing: 3px;
            color: var(--accent);
            margin: 0;
        }

        .btn-dashboard {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 1.5rem;
            background: var(--glass);
            color: var(--text);
            border: 2px solid var(--border);
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition);
            backdrop-filter: blur(20px);
            position: relative;
            overflow: hidden;
        }

        .btn-dashboard::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212,175,55,0.2), transparent);
            transition: var(--transition);
        }

        .btn-dashboard:hover::before {
            left: 100%;
        }

        .btn-dashboard:hover {
            border-color: var(--accent);
            color: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.3);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .theme-toggle {
            background: var(--glass);
            border: 2px solid var(--border);
            color: var(--text);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            backdrop-filter: blur(20px);
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .theme-toggle:hover {
            border-color: var(--accent);
            color: var(--accent);
            transform: rotate(180deg) scale(1.1);
        }

        .hero {
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 6%;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: var(--text);
        }

        .hero h1 span {
            color: var(--accent);
            display: block;
            font-size: 0.5em;
            text-transform: uppercase;
            letter-spacing: 8px;
            margin-bottom: 10px;
        }

        section { padding: 5rem 6%; }

        .section-title {
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: var(--text);
        }

        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--accent);
            margin: 1.5rem auto;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .card {
            background: var(--glass);
            border: 1px solid var(--border);
            padding: 2.5rem;
            border-radius: 20px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(15px);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), transparent);
            transform: scaleX(0);
            transition: var(--transition);
        }

        .card:hover::before {
            transform: scaleX(1);
        }

        .card:hover {
            border-color: var(--accent);
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .card i {
            font-size: 3rem;
            color: var(--accent);
            margin-bottom: 1.5rem;
            display: block;
        }

        .card h3, .card h4 {
            font-family: 'Playfair Display', serif;
            margin-bottom: 1rem;
            font-size: 1.3rem;
            color: var(--text);
        }

        .card p {
            color: var(--text-secondary);
        }

        .map-hero {
            height: 500px;
            border-radius: 25px;
            overflow: hidden;
            border: 3px solid var(--border);
            box-shadow: 0 30px 60px rgba(0,0,0,0.4);
            transition: var(--transition);
            margin: 3rem auto;
            max-width: 1000px;
            position: relative;
            backdrop-filter: blur(20px);
        }

        .map-hero:hover {
            border-color: var(--accent);
            transform: translateY(-5px);
            box-shadow: 0 40px 80px rgba(37, 99, 235, 0.3);
        }

        .map-hero iframe {
            width: 100%;
            height: 100%;
            border: 0;
            filter: grayscale(0.2) contrast(1.3) brightness(1.1);
        }

        .map-label {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--accent);
            padding: 1rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            color: var(--accent);
            z-index: 10;
        }

        .gallery-tabs {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
        }

        .gallery-tab {
            padding: 1rem 2rem;
            background: var(--glass);
            border: 2px solid var(--border);
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 600;
            color: var(--text-secondary);
            backdrop-filter: blur(15px);
        }

        .gallery-tab.active {
            background: var(--accent);
            color: #000;
            border-color: var(--accent);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .gallery-card {
            height: 350px;
            border-radius: 20px;
            overflow: hidden;
            border: 2px solid var(--border);
            position: relative;
            cursor: pointer;
            transition: var(--transition);
            background-size: cover;
            background-position: center;
        }

        .gallery-card:hover {
            transform: scale(1.05) rotate(1deg);
            border-color: var(--accent);
            box-shadow: 0 25px 50px rgba(37, 99, 235, 0.4);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(15,23,42,0.9), rgba(212,175,55,0.3));
            opacity: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            text-align: center;
            padding: 2rem;
            backdrop-filter: blur(10px);
        }

        .gallery-card:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay h4 {
            color: white;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .gallery-overlay i {
            font-size: 3rem;
            color: var(--accent);
            margin-bottom: 1rem;
        }

        .gallery-overlay p {
            color: rgba(255,255,255,0.9);
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .contact-info h3 {
            font-family: 'Playfair Display', serif;
            color: var(--accent);
            margin-bottom: 2rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: var(--glass);
            border-radius: 15px;
            border: 1px solid var(--border);
            backdrop-filter: blur(15px);
        }

        .contact-item i {
            font-size: 1.5rem;
            color: var(--accent);
            width: 50px;
            text-align: center;
            margin-right: 1rem;
        }

        .contact-item strong {
            color: var(--text);
        }

        .contact-item small {
            color: var(--text-secondary);
        }

        .timeline {
            max-width: 1000px;
            margin: 0 auto;
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(to bottom, var(--accent), var(--border));
            transform: translateX(-50%);
        }

        .timeline-item {
            display: flex;
            align-items: center;
            margin-bottom: 4rem;
            position: relative;
        }

        .timeline-item:nth-child(odd) { justify-content: flex-end; padding-right: 0; padding-left: 50%; }
        .timeline-item:nth-child(even) { justify-content: flex-start; padding-left: 0; padding-right: 50%; }

        .timeline-content {
            background: var(--glass);
            border: 2px solid var(--border);
            padding: 2.5rem;
            border-radius: 20px;
            max-width: 450px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            backdrop-filter: blur(15px);
        }

        .timeline-dot {
            width: 24px; height: 24px; background: var(--accent);
            border-radius: 50%; position: absolute; left: 50%; top: 30px;
            transform: translateX(-50%); z-index: 2; box-shadow: 0 0 0 8px var(--glass);
            transition: var(--transition);
        }

        .timeline-item:hover .timeline-dot {
            transform: translateX(-50%) scale(1.2);
            box-shadow: 0 0 0 8px var(--accent);
        }

        .timeline-date {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--accent);
            font-weight: 900;
            margin-bottom: 1rem;
        }

        .btn {
            padding: 0.8rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition);
            display: inline-block;
            cursor: pointer;
            border: none;
        }

        .btn-gold { 
            background: var(--accent); 
            color: #000; 
            backdrop-filter: blur(15px);
        }
        .btn-gold:hover { 
            background: #fff; 
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3); 
        }

        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s ease-out; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        footer { 
            padding: 4rem 6% 2rem; 
            border-top: 1px solid var(--border); 
            text-align: center; 
            opacity: 0.9; 
            background: rgba(0,0,0,0.2);
            backdrop-filter: blur(20px);
            margin-top: auto;
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            .header-actions {
                flex-wrap: wrap;
                justify-content: center;
            }
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }
    </style>
</head>
<body data-theme="dark">

<header>
    <div class="logo">
        <div class="logo-text">
            <h1>SIDI BENNOUR</h1>
            <p>TRIBUNAL DE PREMIÈRE INSTANCE</p>
        </div>
    </div>
    <div class="header-actions">
        <a href="/back-to-dashboard" class="btn-dashboard">
    <i class="fas fa-arrow-left"></i>
    Retour Dashboard
</a>
        <button onclick="toggleTheme()" class="theme-toggle" title="Changer le thème">
            <i class="fas fa-moon"></i>
        </button>
    </div>
</header>

<main>
    <!-- HERO -->
    <section class="hero reveal">
        <div class="hero-content">
            <h1><span>Institution de l'État</span><div>Justice Moderne & Digitale</div></h1>
            <p style="max-width: 600px; margin: 0 auto 2.5rem; opacity: 0.8;">Service judiciaire de proximité pour les citoyens de la province.</p>
            <div class="hero-buttons">
                <a href="#decouvrir" class="btn btn-gold">Découvrir</a>
                <a href="#services" class="btn" style="color: var(--text-secondary); border: 2px solid var(--border); margin-left: 10px;">Services</a>
            </div>
        </div>
    </section>

    <!-- 🏛️ INTRODUCTION -->
    <section id="decouvrir" class="reveal">
        <h2 class="section-title">🏛️ Introduction à la Cour</h2>
        <div class="grid-3">
            <div class="card">
                <i class="fas fa-landmark"></i>
                <h3>Qu'est-ce que le Tribunal ?</h3>
                <p>Tribunal de Première Instance de Sidi Bennour - Pilier de la justice dans la province.</p>
            </div>
            <div class="card">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Où se trouve-t-il ?</h3>
                <p>Centre-ville de Sidi Bennour, facilement accessible.</p>
            </div>
            <div class="card">
                <i class="fas fa-gavel"></i>
                <h3>Quel est son rôle ?</h3>
                <p>Juger les affaires civiles, pénales et commerciales.</p>
            </div>
        </div>
    </section>

    <!-- ⚖️ MISSIONS -->
    <section class="reveal">
        <h2 class="section-title">⚖️ Missions</h2>
        <div class="grid-3">
            <div class="card"><i class="fas fa-balance-scale"></i><h3>Justice</h3><p>Jugements équitables et transparents.</p></div>
            <div class="card"><i class="fas fa-shield-alt"></i><h3>Droits</h3><p>Protection des droits fondamentaux.</p></div>
            <div class="card"><i class="fas fa-file-contract"></i><h3>Affaires</h3><p>Traitement efficace des litiges.</p></div>
        </div>
    </section>

    <!-- 👥 ORGANISATION -->
    <section id="organisation" class="reveal">
        <h2 class="section-title">👥 Organisation</h2>
        <div class="grid-3">
            <div class="card"><i class="fas fa-user-tie"></i><h3>Juges</h3><p>Magistrats indépendants.</p></div>
            <div class="card"><i class="fas fa-file-alt"></i><h3>Greffe</h3><p>Gestion des dossiers.</p></div>
            <div class="card"><i class="fas fa-users-cog"></i><h3>Administration</h3><p>Services administratifs.</p></div>
        </div>
    </section>

    <!-- 🕰️ HISTORIQUE RÉDUIT (5 ÉVÉNEMENTS CLÉS) -->
    <section class="reveal">
        <h2 class="section-title">🕰️ Historique</h2>
        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="timeline-date">1960</div>
                    <h4>Création</h4>
                    <p>Création officielle du Tribunal de Sidi Bennour.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="timeline-date">1995</div>
                    <h4>Modernisation</h4>
                    <p>Première informatique des dossiers.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="timeline-date">2015</div>
                    <h4>Rénovation</h4>
                    <p>Rénovation complète et accès PMR.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="timeline-date">2023</div>
                    <h4>Digitalisation</h4>
                    <p>Plateforme digitale complète.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="timeline-date">2026</div>
                    <h4>Justice 4.0</h4>
                    <p>Tribunal entièrement digitalisé.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 📸 GALERIE -->
    <section id="galerie" class="reveal">
        <h2 class="section-title">📸 Galerie Photos</h2>
        <div class="gallery-tabs">
            <div class="gallery-tab active" data-gallery="sidi-bennour">🏛️ Sidi Bennour</div>
        </div>
        
        <!-- GALERIE SIDI BENNOUR -->
        <div id="gallery-sidi-bennour" class="gallery-grid">
            <div class="gallery-card" style="background-image: url('https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=800&auto=format&fit=crop');">
                <div class="gallery-overlay">
                    <i class="fas fa-landmark"></i>
                    <h4>Tribunal Sidi Bennour</h4>
                    <p>Architecture judiciaire moderne</p>
                </div>
            </div>
            <div class="gallery-card" style="background-image: url('https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&auto=format&fit=crop');">
                <div class="gallery-overlay">
                    <i class="fas fa-gavel"></i>
                    <h4>Salle d'Audience</h4>
                    <p>Ambiance solennelle Sidi Bennour</p>
                </div>
            </div>
            <div class="gallery-card" style="background-image: url('https://images.unsplash.com/photo-1618564004693-382dd392ca2d?w=800&auto=format&fit=crop');">
                <div class="gallery-overlay">
                    <i class="fas fa-users"></i>
                    <h4>Équipe Judiciaire</h4>
                    <p>Professionnels dévoués SB</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 📍 MAP + SERVICES -->
    <section id="services" class="reveal">
        <h2 class="section-title">🗺️ Localisation & Services</h2>
        <div class="map-hero">
            <div class="map-label">📍 Tribunal de Sidi Bennour</div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3345.5678901234567!2d-8.433333333333334!3d32.65!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzLCsDM5JzAwLjAiTiA4wrAyNicwMC4wIlc!5e0!3m2!1sfr!2sma!4v1700000000000!5m2!1sfr!2sma" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="grid-3">
            <div class="card"><i class="fas fa-file-signature"></i><h4>Casier Judiciaire</h4><p>Demande en ligne.</p></div>
            <div class="card"><i class="fas fa-search"></i><h4>Suivi Dossiers</h4><p>Temps réel.</p></div>
            <div class="card"><i class="fas fa-gavel"></i><h4>Registre Commerce</h4><p>Entreprises.</p></div>
        </div>
    </section>

    <!-- 📞 CONTACT -->
    <section id="contact" class="reveal">
        <h2 class="section-title">📞 Contact & Horaires</h2>
        <div class="contact-grid">
            <div class="contact-info">
                <h3>Nous Contacter</h3>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <strong>+212 523 45 67 89</strong><br>
                        <small>Lundi - Vendredi</small>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <strong>08:30 - 16:30</strong><br>
                        <small>Fermé le weekend</small>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <strong>tribunal.sidi.bennour@justice.ma</strong><br>
                        <small>contact@justice.ma</small>
                    </div>
                </div>
                <form method="POST" action="/contact">
    @csrf

    
</form>
            </div>
            <div style="height: 400px; border-radius: 20px; overflow: hidden; border: 2px solid var(--border);">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&auto=format&fit=crop" alt="Tribunal Building" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        </div>
    </section>
</main>

<footer>
    <p>© 2026 Tribunal de Sidi Bennour — Excellence Judiciaire</p>
</footer>

<script>
    function toggleTheme() {
        const body = document.body;
        const current = body.getAttribute('data-theme');
        const next = current === 'dark' ? 'light' : 'dark';
        body.setAttribute('data-theme', next);
        const icon = document.querySelector('.theme-toggle i');
        icon.className = next === 'dark' ? 'fas fa-moon' : 'fas fa-sun';
    }

    // GALERIE TABS
    document.querySelectorAll('.gallery-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.gallery-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.gallery-grid').forEach(g => g.style.display = 'none');
            
            tab.classList.add('active');
            
            const galleryId = tab.getAttribute('data-gallery');
            document.getElementById(`gallery-${galleryId}`).style.display = 'grid';
        });
    });

    // Scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => { 
            if(e.isIntersecting) e.target.classList.add('visible'); 
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if(target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
</script>

</body>
</html>