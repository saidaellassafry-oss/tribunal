<!DOCTYPE html>
<html lang="fr" id="mainHtml">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Dashboard</title>

<script>
    (function() {
        const savedLang = localStorage.getItem('app_lang') || 'fr';
        document.documentElement.lang = savedLang;
        document.documentElement.dir = (savedLang === 'ar') ? 'rtl' : 'ltr';
    })();
</script>

<style>
body{
    margin:0;
    font-family: 'Segoe UI', Arial, sans-serif;
    min-height:100vh;
    display:flex;
    flex-direction:column;
    background: linear-gradient(135deg, #0f172a, #1e3a8a, #2563eb);
    color:white;
}

/* Config RTL */
[dir="rtl"] .header-left { flex-direction: row; }
[dir="rtl"] .sidebar { border-right: none; border-left: 1px solid rgba(255,255,255,0.1); }

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 25px;
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(15px);
    border-bottom: 1px solid rgba(255,255,255,0.1);
    position: sticky;
    top: 0;
    z-index: 100;
}

.header-left{
    display:flex;
    align-items:center;
    gap:15px;
}

.hamburger{
    background:rgba(255,255,255,0.1);
    border:1px solid rgba(255,255,255,0.2);
    color:white;
    padding:8px 12px;
    border-radius:8px;
    cursor:pointer;
    font-size:18px;
    transition: 0.3s;
}

.hamburger:hover{ background:rgba(255,255,255,0.2); }

.logout-btn{
    background:#ef4444;
    border:none;
    color:white;
    padding:8px 14px;
    border-radius:8px;
    cursor:pointer;
    font-weight: 600;
}

.container{
    display:flex;
    flex:1;
}

.sidebar{
    width:260px;
    padding:20px;
    background:rgba(0,0,0,0.2);
    transition: all 0.3s ease;
    overflow:hidden;
    white-space:nowrap;
    border-right: 1px solid rgba(255,255,255,0.05);
}

/* حالة الإغلاق */
.sidebar.closed{
    width:0;
    padding:0;
    border:none;
}

.sidebar h3 { 
    font-size:14px; 
    text-transform: uppercase; 
    letter-spacing: 1px; 
    color:rgba(255,255,255,0.5);
    margin-bottom: 20px;
}

.sidebar a{
    display:flex;
    align-items: center;
    gap: 10px;
    color:rgba(255,255,255,0.8);
    text-decoration:none;
    padding:12px;
    margin:8px 0;
    border-radius:10px;
    transition: 0.3s;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.1);
    color: white;
    transform: translateX(5px);
}
[dir="rtl"] .sidebar a:hover { transform: translateX(-5px); }

.main{
    flex:1;
    padding:40px;
}

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));
    gap:20px;
    margin-bottom: 30px;
}

.card{
    background:rgba(255,255,255,0.06);
    padding:25px;
    border-radius:16px;
    border:1px solid rgba(255,255,255,0.1);
    text-align:center;
    transition: 0.3s;
}
.card:hover { transform: translateY(-5px); background: rgba(255,255,255,0.12); }

.card h4 { margin: 0; font-size: 14px; color: rgba(255,255,255,0.6); text-transform: uppercase; }
.card p { margin: 10px 0 0; font-size: 32px; font-weight: bold; }

.box{
    margin-top:20px;
    background:rgba(255,255,255,0.05);
    padding:25px;
    border-radius:16px;
    border: 1px solid rgba(255,255,255,0.1);
}

/* FOOTER */
.footer {
    background: rgba(0, 0, 0, 0.3);
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    padding: 50px 0 20px 0;
    margin-top: auto;
    position: relative;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 30px;
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1.5fr;
    gap: 40px;
    margin-bottom: 40px;
}

.footer-section h4 {
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: #a78bfa;
    margin-bottom: 20px;
}

.footer-section ul { list-style: none; padding: 0; }
.footer-section ul li { margin-bottom: 12px; }
.footer-section ul li a {
    color: rgba(255, 255, 255, 0.6);
    text-decoration: none;
    transition: 0.3s;
    display: inline-block;
}
.footer-section ul li a:hover { color: white; transform: translateX(5px); }

.lang-switcher-footer { display: flex; gap: 10px; margin-top: 15px; }
.lang-btn {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    cursor: pointer;
    font-size: 12px;
}
.lang-btn.active { background: #2563eb; border-color: #2563eb; }

.footer-bottom {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px 30px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    color: rgba(255, 255, 255, 0.4);
}

@media (max-width: 900px) {
    .footer-container { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 600px) {
    .footer-container { grid-template-columns: 1fr; text-align: center; }
    .footer-bottom { flex-direction: column; align-items: center; gap: 10px; }
    .lang-switcher-footer { justify-content: center; }
}
</style>
</head>

<body>

<div class="header">
    <div class="header-left">
        <button class="hamburger" onclick="toggleSidebar()">☰</button>
        <h3 style="margin:0;"><span data-key="panel">Employee Panel</span> 🧑‍💼</h3>
    </div>

    <form method="POST" action="/logout">
        @csrf
        <button class="logout-btn" data-key="logout">Déconnexion</button>
    </form>
</div>

<div class="container">
    <!-- الـ Sidebar يبدأ بدون كلاس closed برمجياً عبر JS -->
    <div class="sidebar" id="sidebar">
        <h3 data-key="menu">⚖ Tribunal</h3>
        <a href="/employee/dashboard">🏠 <span data-key="dash">Dashboard</span></a>
        <a href="/tribunal" class="menu-explore"><span>🏛</span> <span>Explorer Tribunal</span></a>
        <a href="/dossiers">📁 <span data-key="dos">Dossiers</span></a>
        <a href="/audiences">⚖ <span data-key="aud">Audiences</span></a>
        <a href="/archives">📁 <span data-key="arch">Archives</span></a>
        <a href="/certificats">📄 <span data-key="cert">Certificats</span></a>
        <a href="/demandes">📄 <span data-key="dem">Demandes</span></a>
    </div>

    <div class="main">
        <h2 style="margin-bottom: 30px;"><span data-key="wel">Bienvenue</span> {{ $user['email'] ?? 'Employé' }} 👤</h2>

        <div class="cards">
            <div class="card">
                <h4 data-key="c1">Total Dossiers</h4>
                <p>{{ $total ?? 0 }}</p>
            </div>
            <div class="card">
                <h4 data-key="c2">En cours</h4>
                <p style="color: #facc15;">{{ $enCours ?? 0 }}</p>
            </div>
            <div class="card">
                <h4 data-key="c3">Terminés</h4>
                <p style="color: #22c55e;">{{ $termine ?? 0 }}</p>
            </div>
            <div class="card">
                <h4 data-key="c4">En attente</h4>
                <p style="color: #60a5fa;">{{ $attente ?? 0 }}</p>
            </div>
        </div>

        <div class="box">
            <h3 data-key="title-table">📁 Derniers Dossiers</h3>
            <table style="width:100%; margin-top:20px; border-collapse: collapse; background:rgba(255,255,255,0.05); border-radius:12px; overflow:hidden;">
                <thead>
                    <tr style="background:rgba(255,255,255,0.08); text-align:left;">
                        <th style="padding:12px;">📁 Titre</th>
                        <th style="padding:12px;">#️⃣ N°</th>
                        <th style="padding:12px;">📂 Type</th>
                        <th style="padding:12px;">👤 Justicaible</th>
                        <th style="padding:12px;">⚖ Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latest as $d)
                        <tr style="border-top:1px solid rgba(255,255,255,0.05);">
                            <td style="padding:12px;">{{ $d->title }}</td>
                            <td style="padding:12px;">{{ $d->numero_dossier }}</td>
                            <td style="padding:12px;">{{ $d->type_affaire }}</td>
                            <td style="padding:12px;">{{ $d->client }}</td>
                            <td style="padding:12px; font-weight:bold;">{{ $d->status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding:15px; opacity:0.6;">Aucun dossier disponible</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-section">
            <h4>⚖ Tribunal Digital</h4>
            <p style="font-size: 14px; color: rgba(255,255,255,0.5); line-height: 1.6;" data-key="f-desc">Espace de gestion dédié aux fonctionnaires.</p>
            <div class="lang-switcher-footer">
                <button class="lang-btn" onclick="changeLang('fr')" id="btn-fr">FR</button>
                <button class="lang-btn" onclick="changeLang('ar')" id="btn-ar">عربي</button>
            </div>
        </div>
        <div class="footer-section">
            <h4 data-key="f-nav">Navigation</h4>
            <ul>
                <li><a href="#" data-key="dos">Dossiers</a></li>
                <li><a href="#" data-key="aud">Audiences</a></li>
                <li><a href="#" data-key="arch">Archives</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4 data-key="f-legal">Légal</h4>
            <ul>
                <li><a href="#" data-key="f-priv">Confidentialité</a></li>
                <li><a href="#" data-key="f-help">Aide</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4 data-key="f-contact">Support</h4>
            <p style="font-size: 13px; color: rgba(255,255,255,0.5);">📧 support.tech@tribunal.ma</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2026 Tribunal Digital System. <span data-key="f-copy">Tous droits réservés.</span></p>
        <p>v2.1.0</p>
    </div>
</footer>

<script>
    const translations = {
        fr: {
            "panel": "Employee Panel", "logout": "Déconnexion", "menu": "Menu Tribunal",
            "dash": "Tableau de Bord", "dos": "Dossiers", "aud": "Audiences", "arch": "Archives",
            "cert": "Certificats", "dem": "Demandes", "wel": "Bienvenue",
            "c1": "Total Dossiers", "c2": "En cours", "c3": "Terminés", "c4": "En attente",
            "title-table": "Derniers Dossiers", "f-desc": "Espace de gestion dédié aux fonctionnaires du tribunal.",
            "f-nav": "Navigation", "f-legal": "Légal", "f-contact": "Support", "f-copy": "Tous droits réservés",
            "f-priv": "Confidentialité", "f-help": "Aide"
        },
        ar: {
            "panel": "لوحة الموظف", "logout": "خروج", "menu": "قائمة المحكمة",
            "dash": "الرئيسية", "dos": "الملفات", "aud": "الجلسات", "arch": "الأرشيف",
            "cert": "الشهادات", "dem": "الطلبات", "wel": "مرحباً",
            "c1": "مجموع الملفات", "c2": "قيد المعالجة", "c3": "المنتهية", "c4": "في الانتظار",
            "title-table": "آخر الملفات", "f-desc": "فضاء التدبير المخصص لموظفي المحكمة.",
            "f-nav": "تنقل", "f-legal": "قانوني", "f-contact": "الدعم", "f-copy": "جميع الحقوق محفوظة",
            "f-priv": "الخصوصية", "f-help": "مساعدة"
        }
    };

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const isClosed = sidebar.classList.toggle('closed');
        // حفظ الحالة: إذا كان مغلقاً نحفظ false، إذا كان مفتوحاً نحفظ true
        localStorage.setItem('sidebar_open', !isClosed);
    }

    function changeLang(lang) {
        localStorage.setItem('app_lang', lang);
        location.reload();
    }

    window.onload = function() {
        // 1. إدارة اللغة
        const lang = localStorage.getItem('app_lang') || 'fr';
        if(document.getElementById('btn-' + lang)) document.getElementById('btn-' + lang).classList.add('active');

        document.querySelectorAll('[data-key]').forEach(el => {
            const key = el.getAttribute('data-key');
            if (translations[lang][key]) el.innerText = translations[lang][key];
        });

        // 2. إدارة حالة الـ Sidebar عند التحميل
        const sidebar = document.getElementById('sidebar');
        const sidebarState = localStorage.getItem('sidebar_open');

        // إذا كان يدخل لأول مرة (null) أو كانت القيمة true، نجعله مفتوحاً
        if (sidebarState === null || sidebarState === 'true') {
            sidebar.classList.remove('closed');
        } else {
            sidebar.classList.add('closed');
        }
    };
</script>

</body>
</html>