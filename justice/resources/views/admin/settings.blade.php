<!DOCTYPE html>
<html lang="fr" id="mainHtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration Système Avancée</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&family=Cairo:wght@400;600;700&display=swap');

        :root {
            --bg-overlay: rgba(2, 6, 23, 0.88);
            --card: rgba(30, 41, 59, 0.7);
            --primary: #38bdf8;
            --primary-hover: #0ea5e9;
            --text-main: #f1f5f9;
            --text-dim: #94a3b8;
            --glass: rgba(255, 255, 255, 0.08);
            --input-bg: rgba(15, 23, 42, 0.6);
        }

        /* Config RTL / LTR */
        [dir="rtl"] { font-family: 'Cairo', sans-serif; }
        [dir="rtl"] .btn-back { flex-direction: row-reverse; }
        [dir="rtl"] .tab-btn { flex-direction: row-reverse; text-align: right; }
        [dir="rtl"] .settings-wrapper { grid-template-columns: 1fr 280px; }
        [dir="rtl"] .flex-row { flex-direction: row-reverse; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(var(--bg-overlay), var(--bg-overlay)), 
                        url('https://images.unsplash.com/photo-1557683316-973673baf926?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover; background-attachment: fixed; color: var(--text-main); margin: 0; padding: 20px;
            -webkit-font-smoothing: antialiased;
        }

        .container { max-width: 1100px; margin: 40px auto; }
        
        .top-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
        .top-header h1 { font-weight: 700; letter-spacing: -1px; display: flex; align-items: center; gap: 15px; }

        .btn-back {
            text-decoration: none; color: var(--text-main); background: var(--glass);
            padding: 10px 18px; border-radius: 12px; display: flex; align-items: center; gap: 10px; 
            transition: all 0.3s ease; border: 1px solid var(--glass); font-weight: 600; font-size: 0.9rem;
        }
        .btn-back:hover { background: rgba(255,255,255,0.15); transform: translateX(-5px); }

        .settings-wrapper { display: grid; grid-template-columns: 280px 1fr; gap: 30px; align-items: start; }

        /* Menu Latéral */
        .tabs-menu { 
            background: var(--card); padding: 15px; border-radius: 24px; 
            border: 1px solid var(--glass); backdrop-filter: blur(12px);
            position: sticky; top: 20px;
        }

        .tab-btn {
            display: flex; align-items: center; gap: 12px; padding: 14px 18px; width: 100%;
            border: none; background: transparent; color: var(--text-dim); cursor: pointer; 
            border-radius: 15px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600; margin-bottom: 5px;
        }

        .tab-btn:hover { background: var(--glass); color: var(--text-main); }
        .tab-btn.active { 
            background: var(--primary); color: #020617; 
            box-shadow: 0 10px 20px -5px rgba(56, 189, 248, 0.4);
        }

        /* Contenu Principal */
        .tab-content {
            background: var(--card); border-radius: 28px; padding: 40px; 
            border: 1px solid var(--glass); backdrop-filter: blur(16px);
            display: none; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
        }
        .tab-content.active { display: block; animation: slideIn 0.4s ease-out; }

        @keyframes slideIn { 
            from { opacity: 0; transform: translateY(10px); } 
            to { opacity: 1; transform: translateY(0); } 
        }

        .section-title { 
            font-size: 1.3rem; font-weight: 700; color: var(--primary); 
            margin-bottom: 30px; padding-bottom: 15px; border-bottom: 1px solid var(--glass);
        }

        /* Formulaires */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; }
        .full { grid-column: span 2; }
        .input-group { margin-bottom: 20px; }
        
        label { display: block; font-size: 0.85rem; color: var(--text-dim); margin-bottom: 10px; font-weight: 600; }
        
        input, select {
            width: 100%; padding: 14px 16px; border-radius: 12px; border: 1px solid var(--glass);
            background: var(--input-bg); color: white; outline: none; transition: all 0.3s;
            font-size: 0.95rem; box-sizing: border-box;
        }

        input:focus, select:focus {
            border-color: var(--primary); background: rgba(15, 23, 42, 0.8);
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.15);
        }

        .btn-save {
            background: var(--primary); color: #020617; border: none; padding: 16px 25px;
            border-radius: 16px; font-weight: 800; cursor: pointer; margin-top: 30px; 
            width: 100%; transition: all 0.3s; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .btn-save:hover { background: var(--primary-hover); transform: translateY(-2px); box-shadow: 0 10px 20px -5px rgba(56, 189, 248, 0.4); }
        .btn-save:active { transform: translateY(0); }

        /* Switches & Rows */
        .flex-row { 
            display: flex; justify-content: space-between; align-items: center; 
            padding: 20px; background: var(--glass); border-radius: 16px; margin-top: 10px;
        }

        .switch { position: relative; display: inline-block; width: 48px; height: 26px; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .slider { 
            position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; 
            background-color: #334155; transition: .4s; border-radius: 34px; 
        }
        .slider:before { 
            position: absolute; content: ""; height: 18px; width: 18px; left: 4px; bottom: 4px; 
            background-color: white; transition: .4s; border-radius: 50%; 
        }
        input:checked + .slider { background-color: var(--primary); }
        input:checked + .slider:before { transform: translateX(22px); }

        .alert-success {
            display: none; background: #10b981; color: white; padding: 15px 25px; border-radius: 15px; 
            margin-bottom: 25px; align-items: center; gap: 12px; font-weight: 600;
            animation: fadeIn 0.3s ease;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="top-header">
        <a href="/dashboard" class="btn-back">⬅ <span data-key="back">Retour Dashboard</span></a>
        <h1><span>⚙️</span> <span data-key="main-title">Paramètres Global</span></h1>
        <div style="width: 50px;"></div> 
    </div>

    <div class="settings-wrapper">
        <div class="tabs-menu">
            <button class="tab-btn active" onclick="openTab(event, 'profile')">👤 <span data-key="tab-profile">Profile Admin</span></button>
            <button class="tab-btn" onclick="openTab(event, 'tribunal')">⚖️ <span data-key="tab-tribunal">Tribunal</span></button>
            <button class="tab-btn" onclick="openTab(event, 'system')">📁 <span data-key="tab-system">Système</span></button>
        </div>

        <div class="main-content">
            <div id="custom-alert" class="alert-success">✅ <span data-key="alert-msg">Paramètres mis à jour avec succès</span></div>

            <form id="settingsForm">
                <div id="profile" class="tab-content active">
                    <div class="section-title" data-key="title-profile">Informations du Profil</div>
                    <div class="form-grid">
                        <div class="input-group">
                            <label data-key="lbl-name">Nom Complet</label>
                            <input type="text" id="input-admin-name" value="Admin" placeholder="Ex: Jean Dupont">
                        </div>
                        <div class="input-group">
                            <label data-key="lbl-email">Email Adresse</label>
                            <input type="email" value="admin@tribunal.ma" placeholder="admin@exemple.com">
                        </div>
                    </div>
                    <button type="submit" class="btn-save" data-key="btn-save-profile">Enregistrer Profil</button>
                </div>

                <div id="tribunal" class="tab-content">
                    <div class="section-title" data-key="title-tribunal">Paramètres du Tribunal</div>
                    <div class="form-grid">
                        <div class="input-group full">
                            <label data-key="lbl-inst">Nom de l'institution</label>
                            <input type="text" value="Tribunal de sidi bennour">
                        </div>
                        <div class="input-group">
                            <label data-key="lbl-rooms">Salles de session</label>
                            <input type="text" data-key-placeholder="ph-rooms" placeholder="Salle 1, Salle 2">
                        </div>
                        <div class="input-group">
                            <label data-key="lbl-phone">Téléphone</label>
                            <input type="text" value="+212 536 ...">
                        </div>
                    </div>
                    <button type="submit" class="btn-save" data-key="btn-save-trib">Sauvegarder Infos Tribunal</button>
                </div>

                <div id="system" class="tab-content">
                    <div class="section-title" data-key="title-system">Configuration Système</div>
                    <div class="form-grid">
                        <div class="input-group">
                            <label data-key="lbl-max">Max dossiers / Jour</label>
                            <input type="number" value="20">
                        </div>
                        <div class="input-group">
                            <label data-key="lbl-lang">Langue Système</label>
                            <select id="langSelect">
                                <option value="fr">Français</option>
                                <option value="ar">العربية</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex-row">
                        <span data-key="opt-backup" style="font-weight: 600;">Activer les sauvegardes automatiques</span>
                        <label class="switch"><input type="checkbox" checked><span class="slider"></span></label>
                    </div>
                    <button type="submit" class="btn-save" data-key="btn-apply-sys">Appliquer les limites</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const translations = {
        fr: {
            "back": "Retour Dashboard",
            "main-title": "Paramètres Global",
            "tab-profile": "Profile Admin",
            "tab-tribunal": "Tribunal",
            "tab-system": "Système",
            "title-profile": "Informations du Profil",
            "title-tribunal": "Paramètres du Tribunal",
            "title-system": "Configuration Système",
            "lbl-name": "Nom Complet",
            "lbl-email": "Email Adresse",
            "lbl-inst": "Nom de l'institution",
            "lbl-rooms": "Salles de session",
            "lbl-phone": "Téléphone",
            "lbl-max": "Max dossiers / Jour",
            "lbl-lang": "Langue Système",
            "opt-backup": "Sauvegardes automatiques",
            "btn-save-profile": "Enregistrer Profil",
            "btn-save-trib": "Sauvegarder Tribunal",
            "btn-apply-sys": "Appliquer",
            "alert-msg": "Paramètres mis à jour",
            "ph-rooms": "Salle 1, Salle 2..."
        },
        ar: {
            "back": "العودة للوحة التحكم",
            "main-title": "الإعدادات العامة",
            "tab-profile": "ملف المسؤول",
            "tab-tribunal": "المحكمة",
            "tab-system": "النظام",
            "title-profile": "معلومات الملف الشخصي",
            "title-tribunal": "إعدادات المحكمة",
            "title-system": "إعدادات النظام",
            "lbl-name": "الاسم الكامل",
            "lbl-email": "البريد الإلكتروني",
            "lbl-inst": "اسم المؤسسة",
            "lbl-rooms": "قاعات الجلسات",
            "lbl-phone": "الهاتف",
            "lbl-max": "أقصى عدد ملفات / يوم",
            "lbl-lang": "لغة النظام",
            "opt-backup": "تفعيل النسخ الاحتياطي التلقائي",
            "btn-save-profile": "حفظ الملف الشخصي",
            "btn-save-trib": "حفظ معلومات المحكمة",
            "btn-apply-sys": "تطبيق الحدود",
            "alert-msg": "تم تحديث الإعدادات بنجاح",
            "ph-rooms": "القاعة 1، القاعة 2..."
        }
    };

    function openTab(evt, tabName) {
        let i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabcontent.length; i++) tabcontent[i].style.display = "none";
        tablinks = document.getElementsByClassName("tab-btn");
        for (i = 0; i < tablinks.length; i++) tablinks[i].classList.remove("active");
        
        const targetTab = document.getElementById(tabName);
        targetTab.style.display = "block";
        targetTab.classList.add("active");
        evt.currentTarget.classList.add("active");
    }

    document.getElementById('settingsForm').addEventListener('submit', function(e) {
        e.preventDefault(); 
        
        const lang = document.getElementById('langSelect').value;
        const htmlTag = document.getElementById('mainHtml');

        htmlTag.dir = (lang === 'ar') ? 'rtl' : 'ltr';

        document.querySelectorAll('[data-key]').forEach(el => {
            const key = el.getAttribute('data-key');
            if(translations[lang][key]) el.innerText = translations[lang][key];
        });

        document.querySelectorAll('[data-key-placeholder]').forEach(el => {
            const key = el.getAttribute('data-key-placeholder');
            if(translations[lang][key]) el.placeholder = translations[lang][key];
        });

        const alert = document.getElementById('custom-alert');
        alert.style.display = 'flex';
        setTimeout(() => { alert.style.display = 'none'; }, 3000);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>

</body>
</html>