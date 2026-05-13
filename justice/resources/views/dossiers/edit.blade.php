<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier Dossier</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background: linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

.container{
    width:500px;
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(18px);
    border:1px solid rgba(255,255,255,0.2);
    padding:25px;
    border-radius:18px;
}

h2{
    text-align:center;
    color:#38bdf8;
    margin-bottom:15px;
}

input, textarea, select{
    width:100%;
    padding:10px;
    margin:8px 0;
    border:none;
    border-radius:10px;
    outline:none;
    font-size:14px;
}

button{
    width:100%;
    padding:11px;
    background:#22c55e;
    border:none;
    border-radius:10px;
    color:white;
    font-size:15px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#16a34a;
}

.back{
    display:block;
    text-align:center;
    margin-top:10px;
    color:#fbbf24;
    text-decoration:none;
}
</style>

</head>

<body>

<div class="container">

<h2>✏️ Modifier Dossier</h2>

<form method="POST" action="/dossiers/{{ $dossier->id }}">
@csrf
@method('PUT')

<!-- TITLE -->
<input type="text" name="title" value="{{ $dossier->title }}" placeholder="Titre dossier" required>

<!-- CLIENT -->
<input type="text" name="client" value="{{ $dossier->client }}" placeholder="Client" required>

<!-- NUMERO -->
<input type="text" name="numero_dossier" value="{{ $dossier->numero_dossier }}" placeholder="Numéro de dossier (ex: 123/2026)">

<!-- TYPE -->
<select name="type_affaire">
    <option value="">-- Type d'affaire --</option>
    <option value="Civil" {{ $dossier->type_affaire=='Civil'?'selected':'' }}>Civil</option>
    <option value="Pénal" {{ $dossier->type_affaire=='Pénal'?'selected':'' }}>Pénal</option>
    <option value="Commercial" {{ $dossier->type_affaire=='Commercial'?'selected':'' }}>Commercial</option>
</select>

<!-- DESCRIPTION -->
<textarea name="description" placeholder="Description courte...">{{ $dossier->description }}</textarea>

<!-- STATUS -->
<select name="status">
    <option value="en_cours" {{ $dossier->status=='en_cours'?'selected':'' }}>En cours</option>
    <option value="termine" {{ $dossier->status=='termine'?'selected':'' }}>Terminé</option>
    <option value="attente" {{ $dossier->status=='attente'?'selected':'' }}>En attente</option>
</select>

<!-- DATES -->
<input type="date" name="date_ouverture" value="{{ $dossier->date_ouverture }}">
<input type="date" name="date_cloture" value="{{ $dossier->date_cloture }}">

<button type="submit">💾 Modifier</button>

</form>

<a href="/dossiers" class="back">⬅ Retour à la liste</a>

</div>

</body>
</html>