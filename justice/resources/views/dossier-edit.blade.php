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
    height:100vh;
}

.box{
    width:420px;
    background:rgba(255,255,255,0.08);
    padding:20px;
    border-radius:15px;
    backdrop-filter:blur(15px);
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
}

h2 {
    text-align: center;
    margin-bottom: 10px;
}

input, textarea, select{
    width:100%;
    padding:10px;
    margin:8px 0;
    border-radius:10px;
    border:none;
    outline: none;
}

textarea {
    height: 60px;
    resize: none;
}

button{
    width:100%;
    padding:12px;
    background:#22c55e;
    border:none;
    border-radius:10px;
    color:white;
    font-weight: bold;
    cursor: pointer;
    margin-top: 10px;
}

button:hover {
    background: #16a34a;
}

.back-link {
    display: block;
    text-align: center;
    margin-top: 15px;
    color: white;
    text-decoration: none;
    font-size: 0.9em;
}
</style>

</head>

<body>

<div class="box">

<h2>✏ Modifier dossier</h2>

<form method="POST" action="/dossiers/{{ $dossier->id }}">
    @csrf
    @method('PUT')

    <input name="title" value="{{ $dossier->title }}" placeholder="Titre" required>
    <input name="client" value="{{ $dossier->client }}" placeholder="Client" required>

    <input name="numero_dossier" value="{{ $dossier->numero_dossier }}" placeholder="Numéro de dossier" required>

    <select name="type_affaire" required>
        <option value="Civil" {{ $dossier->type_affaire == 'Civil' ? 'selected' : '' }}>Civil</option>
        <option value="Pénal" {{ $dossier->type_affaire == 'Pénal' ? 'selected' : '' }}>Pénal</option>
        <option value="Commercial" {{ $dossier->type_affaire == 'Commercial' ? 'selected' : '' }}>Commercial</option>
        <option value="Administratif" {{ $dossier->type_affaire == 'Administratif' ? 'selected' : '' }}>Administratif</option>
    </select>

    <textarea name="description" placeholder="Description">{{ $dossier->description }}</textarea>

    <select name="status">
        <option value="en_cours" {{ $dossier->status=='en_cours'?'selected':'' }}>En cours</option>
        <option value="termine" {{ $dossier->status=='termine'?'selected':'' }}>Terminé</option>
        <option value="attente" {{ $dossier->status=='attente'?'selected':'' }}>Attente</option>
    </select>

    <input type="date" name="date_ouverture" value="{{ $dossier->date_ouverture }}">
    <input type="date" name="date_cloture" value="{{ $dossier->date_cloture }}">

    <button type="submit">💾 Enregistrer les modifications</button>
</form>

<a href="/dossiers" class="back-link">⬅ Annuler et retourner</a>

</div>

</body>
</html>