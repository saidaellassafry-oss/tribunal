<!DOCTYPE html>
<html lang="fr" id="mainHtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Premium</title>
    
    <script>
        (function() {
            const savedLang = localStorage.getItem('app_lang') || 'fr';
            document.documentElement.lang = savedLang;
            document.documentElement.dir = (savedLang === 'ar') ? 'rtl' : 'ltr';
            
            // Initialisation Dark Mode
            const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>

    <style>
        :root {
            --primary: #2563eb;
            --bg-gradient: linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
            --sidebar-bg: rgba(0,0,0,0.2);
            --card-bg: rgba(255,255,255,0.06);
            --text-main: #ffffff;
            --text-dim: rgba(255,255,255,0.6);
            --border: rgba(255,255,255,0.1);
        }

        [data-theme="light"] {
            --bg-gradient: linear-gradient(135deg, #f8fafc, #e2e8f0, #cbd5e1);
            --sidebar-bg: rgba(255,255,255,0.7);
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-dim: #64748b;
            --border: #cbd5e1;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; 
            background: var(--bg-gradient);
            background-attachment: fixed;
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: background 0.3s ease;
        }

        [dir="rtl"] th, [dir="rtl"] td { text-align: right; }
        [dir="rtl"] .footer-section { border-right: none; border-left: 1px solid var(--border); padding-left: 0; padding-right: 30px; }
        [dir="rtl"] .back-to-top { right: auto; left: 20px; }

        #menu-toggle { display: none; }

        .header {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 25px; background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
            position: sticky; top: 0; z-index: 10;
            border-bottom: 1px solid var(--border);
        }
        [data-theme="light"] .header { background: rgba(255,255,255,0.5); }

        .header-left { display: flex; align-items: center; gap: 15px; }
        .header-right { display: flex; align-items: center; gap: 12px; }

        .header-icon-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid var(--border);
            color: var(--text-main);
            width: 38px; height: 38px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: 0.3s; text-decoration: none; font-size: 18px;
        }

        .lang-switch-mini {
            display: flex; background: rgba(0, 0, 0, 0.2);
            padding: 3px; border-radius: 8px; gap: 2px;
        }

        .mini-btn {
            background: transparent; border: none; color: var(--text-dim);
            padding: 5px 10px; border-radius: 6px; cursor: pointer;
            font-size: 12px; font-weight: bold; transition: 0.3s;
        }
        .mini-btn.active { background: var(--primary); color: white; }

        .hamburger-label {
            cursor: pointer; display: flex; flex-direction: column;
            gap: 5px; padding: 6px; border-radius: 6px;
            background: rgba(255,255,255,0.1); border: 1px solid var(--border);
        }
        .hamburger-label span { display: block; width: 22px; height: 2px; background: var(--text-main); border-radius: 2px; }

        .container { display: flex; flex: 1; }
        .sidebar {
            width: 0; overflow: hidden; background: var(--sidebar-bg);
            transition: width 0.3s ease; white-space: nowrap;
            border-inline-end: 1px solid var(--border);
        }
        #menu-toggle:checked ~ .container .sidebar { width: 260px; padding: 25px 20px; }
        
        .sidebar h3 { margin-bottom: 20px; font-size: 14px; text-transform: uppercase; color: var(--text-dim); }
        .sidebar a {
            display: flex; align-items: center; gap: 10px;
            color: var(--text-main); padding: 12px 15px; text-decoration: none;
            margin: 8px 0; border-radius: 10px; font-size: 15px; transition: 0.3s;
        }
        .sidebar a:hover { background: rgba(255,255,255,0.1); transform: translateX(5px); }

        .main { flex: 1; padding: 40px; }
        .welcome { margin-bottom: 30px; font-size: 20px; font-weight: 300; }
        .welcome b { font-weight: 700; color: #a78bfa; }

        .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .card { background: var(--card-bg); padding: 25px; border-radius: 16px; border: 1px solid var(--border); transition: 0.3s; }
        .card span { font-size: 14px; color: var(--text-dim); text-transform: uppercase; }
        /* ✅ CHIFFRES SUPER PETITS : 18px */
        .card b { 
            display: block; 
            font-size: 18px;
            margin-top: 10px; 
            font-weight: 700; 
        }

        table { width: 100%; border-collapse: collapse; background: rgba(0,0,0,0.1); border-radius: 12px; overflow: hidden; border: 1px solid var(--border); }
        th, td { padding: 15px 20px; border-bottom: 1px solid var(--border); text-align: left; }
        th { background: rgba(255,255,255,0.03); color: var(--text-dim); font-size: 12px; text-transform: uppercase; }

        .logout { background: #ef4444; color: white; border: none; padding: 10px 18px; border-radius: 8px; cursor: pointer; font-weight: 600; }

        .footer { background: rgba(0, 0, 0, 0.3); border-top: 1px solid var(--border); padding: 50px 0 20px 0; margin-top: auto; position: relative; }
        .footer-container { max-width: 1200px; margin: 0 auto; padding: 0 30px; display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 40px; margin-bottom: 40px; }
        .footer-section h4 { font-size: 16px; text-transform: uppercase; letter-spacing: 2px; color: #a78bfa; margin-bottom: 20px; font-weight: 700; }
        .footer-section ul { list-style: none; }
        .footer-section ul li { margin-bottom: 12px; }
        .footer-section ul li a { color: var(--text-dim); text-decoration: none; font-size: 15px; transition: all 0.3s ease; display: inline-block; }
        .footer-section ul li a:hover { color: var(--text-main); transform: translateX(5px); }
        .lang-switcher-footer { display: flex; gap: 10px; margin-top: 15px; }
        .lang-btn { background: rgba(255, 255, 255, 0.05); border: 1px solid var(--border); color: var(--text-dim); padding: 8px 15px; border-radius: 20px; cursor: pointer; font-size: 13px; transition: 0.3s; }
        .lang-btn.active { background: var(--primary); color: white; }
        .footer-bottom { max-width: 1200px; margin: 0 auto; padding: 20px 30px 0 30px; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; font-size: 14px; color: var(--text-dim); }
        .back-to-top { position: absolute; top: -25px; right: 50px; background: var(--primary); color: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); }

        .theme-btn { font-size: 18px; background: none; border: none; cursor: pointer; color: var(--text-main); }
    </style>
</head>
<body>

<input type="checkbox" id="menu-toggle">

<div class="header">
    <div class="header-left">
        <label class="hamburger-label" for="menu-toggle">
            <span></span><span></span><span></span>
        </label>
        <h3 style="margin:0; font-weight: 600; display: flex; align-items: center; gap: 10px;">
            <span style="font-size: 20px;">⚖</span>
            <span data-key="panel">Admin Panel</span>
        </h3>
    </div>

    <div class="header-right">
        <button class="theme-btn" onclick="toggleTheme()" title="Mode Sombre/Clair">🌓</button>

        <div class="lang-switch-mini">
            <button class="mini-btn" onclick="changeAppLang('fr')" id="h-btn-fr">FR</button>
            <button class="mini-btn" onclick="changeAppLang('ar')" id="h-btn-ar">AR</button>
        </div>

        <a href="/admin/settings" class="header-icon-btn" title="Mon Profil">👤</a>
        
        <form method="POST" action="/logout" style="margin:0;">
            @csrf
            <button class="logout" data-key="logout">Déconnexion</button>
        </form>
    </div>
</div>

<div class="container">
    <div class="sidebar">
        <h3 data-key="menu">Menu</h3>
        <a href="/dashboard"><span>🏠</span> <span data-key="dash">Dashboard</span></a>
        <a href="/tribunal" class="menu-explore"><span>🏛</span> <span>Explorer Tribunal</span></a>
        <a href="/annonces"><span>📢</span> <span data-key="ann">Annonces</span></a>
        <a href="/dossiers"><span>📁</span> <span data-key="dos">Dossiers</span></a>
        <a href="/audiences"><span>⚖</span> <span data-key="aud">Audiences</span></a>
        <a href="/demandes"><span>📄</span> <span data-key="dem">Demandes</span></a>
        <a href="/admin/statistiques"><span>📊</span> <span data-key="stat">Statistiques</span></a>
        <a href="/admin/settings"><span>⚙</span> <span data-key="set">Paramètres</span></a>
    </div>

    <div class="main" id="main-content">
        <div class="welcome">
            <span data-key="wel">Bienvenue</span>, <b>{{ $user['email'] ?? 'Administrateur' }}</b> 👋
        </div>

        <div class="cards">
            <div class="card"><span data-key="c1">Total Dossiers</span><b>{{ $total ?? '152' }}</b></div>
            <div class="card"><span data-key="c2">En cours</span><b style="color: #f59e0b;">{{ $enCours ?? '45' }}</b></div>
            <div class="card"><span data-key="c3">Terminés</span><b style="color: #10b981;">{{ $termine ?? '98' }}</b></div>
            <div class="card"><span data-key="c4">En Attente</span><b style="color: #ef4444;">{{ $attente ?? '9' }}</b></div>
        </div>

        <h3 style="margin-bottom:20px; font-weight: 600; display: flex; align-items: center; gap: 10px;" data-key="title-table">
            <span>🕒</span> Derniers dossiers mis à jour
        </h3>

        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>#️⃣ N°</th>
                    <th>📂 Type</th>
                    <th>👤 Justiciable</th>
                    <th>⚖ Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latest as $d)
                <tr>
                    <td>{{ $d->title }}</td>
                    <td>{{ $d->numero_dossier ?? '---' }}</td>
                    <td>{{ $d->type_affaire ?? '---' }}</td>
                    <td>{{ $d->client ?? '---' }}</td>
                    <td>
                        @if($d->status == 'en_cours') En cours
                        @elseif($d->status == 'termine') Terminé
                        @else En attente @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; opacity:0.5;">Aucun dossier disponible</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<footer class="footer">
    <a href="#" class="back-to-top" title="Retour en haut">↑</a>
    <div class="footer-container">
        <div class="footer-section footer-about">
            <h4>⚖ Admin Panel</h4>
            <p data-key="f-desc">Plateforme professionnelle de gestion de cabinet juridique.</p>
            <div class="lang-switcher-footer">
                <button class="lang-btn" onclick="changeAppLang('fr')" id="btn-fr">FR</button>
                <button class="lang-btn" onclick="changeAppLang('ar')" id="btn-ar">عربي</button>
            </div>
        </div>
        <div class="footer-section">
            <h4 data-key="f-nav">Navigation</h4>
            <ul>
                <li><a href="/dashboard" data-key="dash">Dashboard</a></li>
                <li><a href="/dossiers" data-key="dos">Dossiers</a></li>
                <li><a href="/audiences" data-key="aud">Audiences</a></li>
                <li><a href="/admin/statistiques" data-key="stat">Statistiques</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4 data-key="f-legal">Légal</h4>
            <ul>
                <li><a href="#" data-key="f-priv">Confidentialité</a></li>
                <li><a href="#" data-key="f-terms">Conditions</a></li>
                <li><a href="#" data-key="f-help">Aide</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4 data-key="f-contact">Contact</h4>
            <p style="font-size: 14px; opacity: 0.8; margin-bottom: 8px;">📍 sidi bennour, Maroc</p>
            <p style="font-size: 14px; opacity: 0.8; margin-bottom: 8px;">📧 support@cabinet.ma</p>
            <p style="font-size: 14px; opacity: 0.8;">📞 +212 5XX XXX XXX</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2026 Cabinet Juridique Premium. <span data-key="f-copy">Tous droits réservés.</span></p>
        <p style="font-size: 12px; opacity: 0.7;">v1.2.0</p>
    </div>
</footer>

<script>
    const translations = {
        fr: {
            "panel": "Cabinet Juridique", "logout": "Déconnexion", "menu": "Menu Principal", "dash": "Tableau de Bord",
            "ann": "Annonces", "dos": "Dossiers", "aud": "Audiences", "dem": "Demandes", "stat": "Statistiques", 
            "set": "Paramètres", "wel": "Bienvenue", "c1": "Total Dossiers", "c2": "En cours", "c3": "Terminés", "c4": "Attente",
            "title-table": "Derniers dossiers", "f-desc": "Plateforme professionnelle de gestion juridique.", "f-nav": "Navigation", "f-legal": "Légal", "f-contact": "Contact", "f-copy": "Tous droits réservés."
        },
        ar: {
            "panel": "المكتب القانوني", "logout": "خروج", "menu": "القائمة الرئيسية", "dash": "لوحة القيادة",
            "ann": "الإعلانات", "dos": "الملفات", "aud": "الجلسات", "dem": "الطلبات", "stat": "الإحصائيات", 
            "set": "الإعدادات", "wel": "مرحباً", "c1": "مجموع الملفات", "c2": "قيد المعالجة", "c3": "منتهية", "c4": "انتظار",
            "title-table": "آخر الملفات", "f-desc": "منصة احترافية للإدارة القانونية.", "f-nav": "تنقل", "f-legal": "قانوني", "f-contact": "اتصال", "f-copy": "جميع الحقوق محفوظة."
        }
    };

    function updateInterface(lang) {
        document.querySelectorAll("[data-key]").forEach(el => {
            const key = el.getAttribute("data-key");
            if(translations[lang][key]) el.innerText = translations[lang][key];
        });
        document.documentElement.lang = lang;
        document.documentElement.dir = (lang === 'ar') ? 'rtl' : 'ltr';

        document.querySelectorAll('.mini-btn, .lang-btn').forEach(btn => btn.classList.remove('active'));
        if(document.getElementById(`h-btn-${lang}`)) document.getElementById(`h-btn-${lang}`).classList.add('active');
        if(document.getElementById(`btn-${lang}`)) document.getElementById(`btn-${lang}`).classList.add('active');
    }

    function changeAppLang(lang) {
        localStorage.setItem('app_lang', lang);
        updateInterface(lang);
    }

    function toggleTheme() {
        const current = document.documentElement.getAttribute('data-theme');
        const next = current === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', next);
        localStorage.setItem('theme', next);
    }

    window.onload = function() {
        // 1. إدارة اللغة
        updateInterface(localStorage.getItem('app_lang') || 'fr');

        // 2. إدارة حالة الـ Sidebar
        const menuToggle = document.getElementById('menu-toggle');
        const sidebarState = localStorage.getItem('sidebar_open');

        // إذا كانت أول مرة يدخل (NULL) اجعله مفتوحاً افتراضياً
        if (sidebarState === null || sidebarState === 'true') {
            menuToggle.checked = true;
        } else {
            menuToggle.checked = false;
        }

        // حفظ الحالة عند تغييرها يدوياً
        menuToggle.addEventListener('change', function() {
            localStorage.setItem('sidebar_open', menuToggle.checked);
        });
    };
</script>
</body>
</html>