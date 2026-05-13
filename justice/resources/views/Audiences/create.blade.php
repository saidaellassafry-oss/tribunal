<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Audience | Justice System</title>

    <style>
        :root {
            --bg: #0f172a;
            --panel: rgba(30, 41, 59, 0.7);
            --primary: #38bdf8;
            --accent: #818cf8;
            --success: #22c55e;
            --text-muted: #94a3b8;
        }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, sans-serif;
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
            color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .glass-container {
            width: 100%;
            max-width: 700px;
            background: var(--panel);
            backdrop-filter: blur(12px);
            padding: 40px;
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .header-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding-bottom: 15px;
        }

        h2 {
            margin: 0;
            font-size: 1.6rem;
            background: linear-gradient(to right, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-back {
            text-decoration: none;
            color: var(--text-muted);
            font-size: 0.85rem;
            transition: 0.3s;
        }

        .btn-back:hover { color: white; }

        /* تصفيف الحقول في شبكة (Grid) */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .full-width { grid-column: span 2; }

        label {
            display: block;
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 6px;
            margin-left: 4px;
        }

        input, select, textarea {
            width: 100%;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 12px;
            border-radius: 12px;
            color: white;
            font-size: 0.9rem;
            transition: 0.3s;
            box-sizing: border-box;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.1);
        }

        .section-title {
            grid-column: span 2;
            font-size: 0.85rem;
            font-weight: bold;
            color: var(--primary);
            margin-top: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        button[type="submit"] {
            margin-top: 30px;
            padding: 15px;
            background: linear-gradient(135deg, #0284c7, #38bdf8);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 800;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
            box-shadow: 0 10px 15px -3px rgba(56, 189, 248, 0.3);
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
            box-shadow: 0 15px 20px -3px rgba(56, 189, 248, 0.4);
        }

        @media (max-width: 600px) {
            .form-grid { grid-template-columns: 1fr; }
            .full-width, .section-title { grid-column: span 1; }
        }
    </style>
</head>

<body>

<div class="glass-container">

    <div class="header-area">
        <h2>⚖️ Nouvelle Audience</h2>
        <a href="/audiences" class="btn-back">← Retour</a>
    </div>
    <form method="POST" action="{{ route('audiences.store') }}">
@csrf

<input type="text" name="type" placeholder="Type audience">



</form>

    <form method="POST" action="/audiences/store">
        @csrf

        <div class="form-grid">
            <div class="full-width">
                <label>Dossier lié</label>
                <select name="dossier_id" required>
                    <option value="">-- Sélectionner le dossier --</option>
                    @foreach($dossiers as $d)
                        <option value="{{ $d->id }}">{{ $d->title }} (Ref: {{ $d->numero_dossier }})</option>
                    @endforeach
                </select>
            </div>

            <div class="section-title">📍 Détails du Tribunal</div>

            <div class="full-width">
                <label>Titre de l'audience</label>
                <input type="text" name="titre" placeholder="ex: Audience de plaidoirie" required>
            </div>

            <div>
                <label>Tribunal</label>
                <input type="text" name="tribunal" placeholder="ex: Tribunal de 1ère Instance">
            </div>

            <div>
                <label>Salle</label>
                <input type="text" name="salle" placeholder="ex: Salle n°4">
            </div>

            <div>
                <label>Date</label>
                <input type="date" name="date_audience">
            </div>

            <div>
                <label>Heure</label>
                <input type="time" name="heure">
            </div>

            <div class="section-title">👥 Personnes Concernées</div>

            <div>
                <label>Juge</label>
                <input type="text" name="juge" placeholder="Nom du juge">
            </div>

            <div>
                <label>Statut</label>
                <select name="status">
                    <option value="planifie">📅 Planifiée</option>
                    <option value="reportee">⏳ Reportée</option>
                    <option value="terminee">✅ Terminée</option>
                </select>
            </div>

            <label>Défenseur</label>
<input type="text" name="defenseur">
<label>Accusé</label>
<input type="text" name="accuse">
            <div class="full-width">
                <label>Notes complémentaires</label>
                <textarea name="notes" rows="3" placeholder="Informations importantes..."></textarea>
            </div>

            <div class="full-width">
                <button type="submit">💾 ENREGISTRER L'AUDIENCE</button>
            </div>
        </div>

    </form>

</div>

</body>
</html>