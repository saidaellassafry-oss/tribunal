<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Audiences</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background:#0f172a;
    color:white;
}

.container{
    padding:30px;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.btn{
    background:#38bdf8;
    color:white;
    padding:10px 15px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
}

.back{
    background:#22c55e;
}

.card{
    background:rgba(255,255,255,0.08);
    padding:15px;
    margin-bottom:12px;
    border-radius:10px;
    border-left:4px solid #38bdf8;
}

h3{
    margin:0 0 10px 0;
    color:#38bdf8;
}

p{
    margin:4px 0;
    font-size:14px;
}

.small{
    color:#94a3b8;
    font-size:13px;
}
</style>
</head>

<body>

<div class="container">

<!-- HEADER -->
<div class="header">

    <a href="/dashboard" class="btn back">🏠 Dashboard</a>

    <a href="/audiences/create" class="btn">
        ➕ Ajouter audience
    </a>

</div>


<h2>📅 Liste des audiences</h2>

@forelse($audiences as $a)

<div class="card">

    <h3>⚖ {{ $a->titre }}</h3>

    <p>🏛 Tribunal: {{ $a->tribunal }}</p>
    <p>📍 Salle: {{ $a->salle }}</p>

    <p>📅 {{ $a->date_audience }} - ⏰ {{ $a->heure }}</p>

    <p>👨‍⚖ Juge: {{ $a->juge ?? 'Non assigné' }}</p>

    <p>⚖ Statut: {{ $a->status }}</p>

    @if($a->notes)
        <p class="small">📝 Notes: {{ $a->notes }}</p>
    @endif

    <hr style="border:0;border-top:1px solid rgba(255,255,255,0.1);">

    <p class="small">
        📁 Dossier: {{ $a->dossier->title ?? 'No dossier' }}
    </p>

    <p class="small">
        👨‍💼 Défenseur: {{ $a->defenseur->name ?? 'No avocat' }}
    </p>

    <p class="small">
        👤 Accusé: {{ $a->accuse->name ?? 'No accusé' }}
    </p>

</div>

@empty
<p>Aucune audience</p>
@endforelse

</div>

</body>
</html>