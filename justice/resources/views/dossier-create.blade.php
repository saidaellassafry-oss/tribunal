<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Ajouter Dossier</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.box{
    width:420px;
    padding:25px;
    border-radius:18px;
    background:rgba(255,255,255,0.12);
    backdrop-filter:blur(15px);
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
}

h2 {
    margin-bottom: 15px;
    text-align: center;
}

input, textarea, select{
    width:100%;
    padding:10px;
    margin-top:10px;
    border:none;
    border-radius:10px;
    outline: none;
}

textarea {
    height: 60px;
    resize: none;
}

button{
    width:100%;
    margin-top:15px;
    padding:12px;
    border:none;
    border-radius:10px;
    background:#22c55e;
    color:white;
    font-weight:bold;
    cursor:pointer;
    transition: 0.3s;
}

button:hover {
    background: #16a34a;
}

a{
    display:block;
    text-align:center;
    margin-top:15px;
    color:white;
    text-decoration: none;
    font-size: 0.9em;
}

a:hover {
    text-decoration: underline;
}
</style>
</head>

<body>

<div class="box">

<h2>➕ Ajouter Dossier</h2>

<form method="POST" action="/dossiers">
    @csrf

    <input name="title" placeholder="Titre dossier" required>
    <input name="client" placeholder="Client" required>

    <input name="numero_dossier" placeholder="Numéro de dossier (ex: 123/2026)" required>

    <select name="type_affaire" required>
        <option value="" disabled selected>-- Type d'affaire --</option>
        <option value="Civil">Civil</option>
        <option value="Pénal">Pénal</option>
        <option value="Commercial">Commercial</option>
        <option value="Administratif">Administratif</option>
    </select>

    <textarea name="description" placeholder="Description courte..."></textarea>

    <select name="status">
        <option value="en_cours">En cours</option>
        <option value="termine">Terminé</option>
        <option value="attente">En attente</option>
    </select>

    <input type="date" name="date_ouverture" title="Date d'ouverture">
    <input type="date" name="date_cloture" title="Date de clôture">

    <button type="submit">➕ Ajouter</button>
</form>

<a href="/dossiers">⬅ Retour à la liste</a>

</div>

</body>
</html>