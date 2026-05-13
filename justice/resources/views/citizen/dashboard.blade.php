<!DOCTYPE html>
<html lang="fr" id="mainHtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citoyen | Tableau de bord</title>

    <script>
        (function() {
            const savedLang = localStorage.getItem('app_lang') || 'fr';
            document.documentElement.lang = savedLang;
            document.documentElement.dir = (savedLang === 'ar') ? 'rtl' : 'ltr';
        })();
    </script>

    <style>
        :root {
            --primary: #2563eb;
            --bg-gradient: linear-gradient(135deg, #0f172a, #1e3a8a, #2563eb);
            --card-bg: rgba(255, 255, 255, 0.06);
            --border: rgba(255, 255, 255, 0.1);
            --text-dim: rgba(255, 255, 255, 0.6);
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--bg-gradient);
            background-attachment: fixed;
            color: white;
        }

        /* Support RTL */
        [dir="rtl"] .header-left { flex-direction: row; }
        [dir="rtl"] .sidebar { border-right: none; border-left: 1px solid var(--border); }
        [dir="rtl"] th, [dir="rtl"] td { text-align: right; }
        [dir="rtl"] .sidebar a:hover { transform: translateX(-8px); } /* عكس حركة الانزلاق للعربي */

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 25px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-left { display: flex; align-items: center; gap: 15px; }

        /* الأزرار العلوية */
        .hamburger {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid var(--border);
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }
        .hamburger:hover { background: rgba(255, 255, 255, 0.2); }

        .logout-btn {
            background: #ef4444;
            border: none;
            color: white;
            padding: 8px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }
        .logout-btn:hover { background: #dc2626; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3); }

        .container { display: flex; flex: 1; }

        /* الـ Sidebar مع تأثيرات الأزرار */
        .sidebar {
            width: 260px;
            padding: 20px;
            background: rgba(0, 0, 0, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            white-space: nowrap;
            border-right: 1px solid var(--border);
        }

        .sidebar.closed { width: 0; padding: 20px 0; border: none; }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 12px 15px;
            margin: 8px 0;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-size: 15px;
        }

        /* تأثير الـ Hover على أزرار القائمة */
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(8px); /* تأثير الإزاحة الجانبية */
        }

        .main { flex: 1; padding: 40px; }

        /* البطاقات وتأثيرها */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: var(--card-bg);
            padding: 25px;
            border-radius: 16px;
            border: 1px solid var(--border);
            text-align: center;
            transition: all 0.3s ease;
            font-weight: bold;
            cursor: pointer;
        }
        .card:hover { 
            transform: translateY(-8px); 
            background: rgba(255, 255, 255, 0.12);
            border-color: var(--primary);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        /* الجداول */
        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border);
        }
        th, td { padding: 15px; border-bottom: 1px solid var(--border); text-align: left; }
        th { background: rgba(255, 255, 255, 0.05); font-size: 13px; color: var(--text-dim); text-transform: uppercase; }

        /* الإعلانات */
        .annonce {
            display: block;
            background: var(--card-bg);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 12px;
            text-decoration: none;
            color: white;
            border: 1px solid var(--border);
            transition: 0.3s;
        }
        .annonce:hover { 
            background: rgba(255, 255, 255, 0.1); 
            transform: scale(1.01); 
            border-color: var(--primary);
        }

        /* الفوتر وأزرار اللغة */
        .footer {
            background: rgba(0, 0, 0, 0.3);
            padding: 40px 0 20px 0;
            margin-top: auto;
            border-top: 1px solid var(--border);
        }
        .lang-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border);
            color: var(--text-dim);
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 12px;
            transition: 0.3s;
            margin-right: 5px;
        }
        .lang-btn.active { background: var(--primary); color: white; border-color: var(--primary); }
        .lang-btn:hover:not(.active) { background: rgba(255, 255, 255, 0.15); color: white; }
    </style>
</head>

<body>

<div class="header">
    <div class="header-left">
        <button class="hamburger" onclick="toggleSidebar()">☰</button>
        <h3 style="margin:0;"><span data-key="panel">Tableau de bord citoyen</span> 👤</h3>
    </div>

    <form method="POST" action="/logout" style="margin:0;">
        @csrf
        <button class="logout-btn" data-key="logout">Déconnexion</button>
    </form>
</div>

<div class="container">
    <div class="sidebar" id="sidebar">
        <a href="/citizen/dashboard"><span>🏠</span> <span data-key="dash">Accueil</span></a>
        <a href="/tribunal"><span>🏛</span> <span>Explorer Tribunal</span></a>
        <a href="/dossiers"><span>📁</span> <span data-key="dos">Mes dossiers</span></a>
        <a href="/demandes"><span>📄</span> <span data-key="dem">Mes demandes</span></a>
        <a href="/annonces"><span>📢</span> <span data-key="ann">Annonces</span></a>
        <a href="/citizen/audiences"><span>⚖</span> <span data-key="aud">Audiences</span></a>
    </div>

    <div class="main">
        <h2 style="margin-bottom: 30px; font-weight: 300;">
            <span data-key="wel">Bienvenue</span>, <b style="color: #a78bfa;">{{ $user['email'] }}</b> 👋
        </h2>

        <div class="cards">
            <div class="card" data-key="card1">📁 Mes dossiers</div>
            <div class="card" data-key="card2">📄 Mes demandes</div>
            <div class="card" data-key="card3">⚖ Suivi des affaires</div>
        </div>

        <h3 style="margin-top:40px; font-weight: 600; display: flex; align-items: center; gap: 10px;">
            <span>📁</span> <span data-key="last_dos">Derniers dossiers</span>
        </h3>
        
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>#️⃣ N°</th>
                    <th>📂 Type</th>
                    <th>👤 Client</th>
                    <th>⚖ Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse(\App\Models\Dossier::latest()->take(5)->get() as $dossier)
                <tr>
                    <td>{{ $dossier->title }}</td>
                    <td>{{ $dossier->numero_dossier }}</td>
                    <td>{{ $dossier->type_affaire }}</td>
                    <td>{{ $dossier->client }}</td>
                    <td>{{ $dossier->status }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; opacity: 0.5;" data-key="empty">Aucun dossier disponible</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <h3 style="margin-top:40px; font-weight: 600; display: flex; align-items: center; gap: 10px;">
            <span>📢</span> <span data-key="last_ann">Dernières annonces</span>
        </h3>
        <div style="margin-top:15px;">
            @forelse(\App\Models\Announcement::latest()->take(3)->get() as $a)
            <a href="/annonces/{{ $a->id }}" class="annonce">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <h4 style="margin:0;">{{ $a->title }}</h4>
                    <span style="font-size:10px; background:var(--primary); padding:4px 10px; border-radius:20px;">{{ $a->type }}</span>
                </div>
                <p style="font-size:13px; color:#cbd5e1; margin:0;">{{ Str::limit($a->content, 120) }}</p>
            </a>
            @empty
            <p style="opacity: 0.5;" data-key="no_ann">Aucune annonce disponible</p>
            @endforelse
        </div>
    </div>
</div>

<footer class="footer">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 30px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
        <div>
            <h4 style="color: #a78bfa; margin-bottom: 10px;">⚖ Tribunal Digital</h4>
            <p style="font-size: 13px; color: rgba(255,255,255,0.4);" data-key="f-desc">Services en ligne pour les citoyens.</p>
        </div>
        <div>
            <button class="lang-btn" onclick="changeLang('fr')" id="btn-fr">FR</button>
            <button class="lang-btn" onclick="changeLang('ar')" id="btn-ar">عربي</button>
        </div>
    </div>
    <div style="text-align: center; margin-top: 30px; font-size: 12px; color: rgba(255, 255, 255, 0.3); border-top: 1px solid var(--border); padding-top: 20px;">
        &copy; 2026 Tribunal Digital System. <span data-key="f-copy">Tous droits réservés.</span>
    </div>
</footer>

<script>
    const translations = {
        fr: {
            "panel": "Tableau de bord citoyen", "logout": "Déconnexion", "dash": "Accueil",
            "dos": "Mes dossiers", "dem": "Mes demandes", "ann": "Annonces", "aud": "Audiences",
            "wel": "Bienvenue", "card1": "📁 Mes dossiers", "card2": "📄 Mes demandes",
            "card3": "⚖ Suivi des affaires", "last_dos": "Derniers dossiers",
            "last_ann": "Dernières annonces", "f-desc": "Services en ligne pour les citoyens.", 
            "f-copy": "Tous droits réservés", "empty": "Aucun dossier disponible", "no_ann": "Aucune annonce disponible"
        },
        ar: {
            "panel": "لوحة المواطن", "logout": "خروج", "dash": "الرئيسية",
            "dos": "ملفاتي", "dem": "طلباتي", "ann": "الإعلانات", "aud": "الجلسات",
            "wel": "مرحباً", "card1": "📁 ملفاتي", "card2": "📄 طلباتي",
            "card3": "⚖ تتبع القضايا", "last_dos": "آخر الملفات",
            "last_ann": "آخر الإعلانات", "f-desc": "الخدمات الإلكترونية للمواطنين.", 
            "f-copy": "جميع الحقوق محفوظة", "empty": "لا توجد ملفات", "no_ann": "لا توجد إعلانات"
        }
    };

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const isClosed = sidebar.classList.toggle('closed');
        localStorage.setItem('citizen_sidebar_open', !isClosed);
    }

    function changeLang(lang) {
        localStorage.setItem('app_lang', lang);
        location.reload();
    }

    window.onload = function() {
        const lang = localStorage.getItem('app_lang') || 'fr';
        if(document.getElementById('btn-' + lang)) document.getElementById('btn-' + lang).classList.add('active');
        
        document.querySelectorAll('[data-key]').forEach(el => {
            const key = el.getAttribute('data-key');
            if (translations[lang][key]) el.innerText = translations[lang][key];
        });

        const sidebar = document.getElementById('sidebar');
        const sidebarState = localStorage.getItem('citizen_sidebar_open');
        if (sidebarState === 'false') sidebar.classList.add('closed');
    };
</script>

</body>
</html>