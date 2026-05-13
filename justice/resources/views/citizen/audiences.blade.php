<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Audiences - Citoyen</title>

<style>
:root {
    --primary: #38bdf8;
    --bg-dark: #0f172a;
    --card-bg: #1e293b;
}

body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: var(--bg-dark);
    color: white;
    padding: 20px;
}

.container {
    max-width: 1000px;
    margin: auto;
}

/* HEADER */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 30px;
}

h2 { margin: 0; font-size: 1.5rem; }

.btn-back {
    background: rgba(255,255,255,0.05);
    color: white;
    padding: 10px 15px;
    border-radius: 10px;
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.1);
}

/* SEARCH */
.search-form {
    display: flex;
    gap: 8px;
    flex: 1;
    min-width: 250px;
}

.search-input {
    flex: 1;
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #334155;
    background: var(--card-bg);
    color: white;
}

.btn-search {
    background: var(--primary);
    border: none;
    padding: 10px 15px;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
}

/* CARD */
.card {
    background: var(--card-bg);
    padding: 20px;
    border-radius: 15px;
    margin-bottom: 15px;
    border-left: 5px solid var(--primary);
}

.title {
    color: var(--primary);
    font-weight: bold;
    margin-bottom: 15px;
}

/* GRID */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 10px;
}

.row {
    color: #cbd5e1;
    font-size: 14px;
}

/* STATUS */
.badge {
    display: inline-block;
    margin-top: 12px;
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 12px;
    text-transform: uppercase;
}

.planifie {
    background: rgba(245,158,11,0.2);
    color: #f59e0b;
}

.terminee {
    background: rgba(34,197,94,0.2);
    color: #22c55e;
}

.reportee {
    background: rgba(239,68,68,0.2);
    color: #ef4444;
}

/* MESSAGE */
.message {
    margin-top: 10px;
    font-size: 13px;
    color: #94a3b8;
}
</style>
</head>

<body>

<div class="container">

    <div class="header">
        <a href="/citizen/dashboard" class="btn-back">⬅ Dashboard</a>
        <h2>⚖ Audiences</h2>

        <form action="/citizen/audiences/search" method="GET" class="search-form">
            <input type="text" name="q" class="search-input" placeholder="Tribunal, titre, date...">
            <button type="submit" class="btn-search">Rechercher</button>
        </form>
    </div>

    @forelse($audiences as $a)

    <div class="card">

        <div class="title">⚖ {{ $a->titre ?? 'Sans titre' }}</div>

        <div class="info-grid">

            <div class="row">📁 <b>Dossier ID:</b> {{ $a->dossier_id ?? 'Non défini' }}</div>

            <div class="row">👤 <b>Accusé:</b> {{ $a->accuse ?? 'Non défini' }}</div>

            <div class="row">🛡 <b>Défenseur:</b> {{ $a->defenseur ?? 'Non défini' }}</div>

            <div class="row">🏛 <b>Tribunal:</b> {{ $a->tribunal ?? 'Non défini' }}</div>

            <div class="row">👨‍⚖️ <b>Juge:</b> {{ $a->juge ?? 'Non défini' }}</div>

            <div class="row">📅 <b>Date:</b> {{ $a->date_audience ?? 'Non défini' }}</div>

            <div class="row">⏰ <b>Heure:</b> {{ $a->heure ?? 'Non défini' }}</div>

            <div class="row">📍 <b>Salle:</b> {{ $a->salle ?? 'Non défini' }}</div>

        </div>

        <div class="badge {{ $a->status }}">
            {{ $a->status ?? 'inconnu' }}
        </div>

        <div class="message">
            ℹ {{ $a->notes ?? 'Aucune information supplémentaire disponible.' }}
        </div>

    </div>

    @empty

    <div style="text-align:center; padding:50px; color:#94a3b8;">
        📭 Aucune audience trouvée
    </div>

    @endforelse

</div>

</body>
</html>