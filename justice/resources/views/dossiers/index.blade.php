<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Dossiers</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background:#0b1220;
    color:white;
}

/* HEADER */
h1{
    text-align:center;
    padding:20px;
    color:#38bdf8;
}

/* SEARCH */
.search{
    display:flex;
    justify-content:center;
    margin-bottom:20px;
}

.search input{
    width:320px;
    padding:10px;
    border-radius:10px;
    border:none;
    outline:none;
}

.search button{
    margin-left:5px;
    padding:10px 15px;
    border:none;
    border-radius:10px;
    background:#2563eb;
    color:white;
}

/* LAYOUT */
.container{
    display:flex;
    gap:20px;
    justify-content:center;
    flex-wrap:wrap;
}

/* FORM */
.form{
    width:350px;
    background:rgba(255,255,255,0.06);
    padding:15px;
    border-radius:16px;
    border:1px solid rgba(255,255,255,0.1);
}

input,textarea,select{
    width:100%;
    padding:10px;
    margin:6px 0;
    border:none;
    border-radius:10px;
    outline:none;
}

button{
    width:100%;
    padding:10px;
    border:none;
    border-radius:10px;
    background:#22c55e;
    color:white;
    font-weight:bold;
}

/* CARDS */
.cards{
    width:600px;
}

.card{
    background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.08);
    padding:15px;
    margin-bottom:12px;
    border-radius:16px;
    transition:0.3s;
    position:relative;
}

.card:hover{
    transform:translateY(-3px);
    background:rgba(255,255,255,0.08);
}

/* STATUS BADGE */
.status{
    position:absolute;
    top:10px;
    right:10px;
    padding:4px 10px;
    font-size:11px;
    border-radius:20px;
}

.en\ cours{background:#f59e0b;}
.terminé{background:#22c55e;}
.en\ attente{background:#ef4444;}

/* ACTIONS */
.actions{
    margin-top:10px;
    display:flex;
    gap:10px;
}

.actions button{
    width:auto;
    padding:6px 10px;
    font-size:12px;
}

.delete{background:red;}
.edit{background:#3b82f6;}
</style>
</head>

<body>

<h1>📁 Gestion des Dossiers</h1>

<!-- SEARCH -->
<form class="search" method="GET" action="/dossiers/search">
    <input name="q" placeholder="🔍 Rechercher...">
    <button>Search</button>
</form>

<div class="container">

<!-- FORM -->
<div class="form">
<form method="POST" action="/dossiers">
@csrf

<h3>➕ Nouveau Dossier</h3>

<input name="title" placeholder="Titre">
<input name="client" placeholder="Client">
<textarea name="description" placeholder="Description"></textarea>

<select name="status">
    <option>en cours</option>
    <option>terminé</option>
    <option>en attente</option>
</select>

<input type="date" name="date_ouverture">

<button>Ajouter</button>
</form>
</div>

<!-- LIST -->
<div class="cards">

@foreach($dossiers as $dossier)

<div class="card">

    <div class="status">{{ $dossier->status }}</div>

    <h3>{{ $dossier->title }}</h3>
    <p>👤 {{ $dossier->client }}</p>
    <p>{{ $dossier->description }}</p>

    <small>📅 {{ $dossier->date_ouverture }}</small>

    <div class="actions">

        <form method="POST" action="/dossiers/{{ $dossier->id }}">
            @csrf
            @method('DELETE')
            <button class="delete">🗑</button>
        </form>

        <a href="/dossiers/{{ $dossier->id }}/edit">
            <button class="edit">✏</button>
        </a>

    </div>

</div>

@endforeach

</div>

</div>

</body>
</html>