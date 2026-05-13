<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Ajouter Audience</title>

<style>
body{
    font-family:Arial;
    background:#0f172a;
    color:white;
    padding:30px;
}

input, select, textarea{
    width:100%;
    padding:10px;
    margin:8px 0;
}

button{
    padding:10px 15px;
    background:#38bdf8;
    border:none;
    cursor:pointer;
}
</style>
</head>

<body>

<h2>➕ Ajouter Audience</h2>

<form method="POST" action="/audiences/store">
@csrf

<input type="text" name="titre" placeholder="Titre">

<input type="text" name="tribunal" placeholder="Tribunal">

<input type="text" name="salle" placeholder="Salle">

<input type="date" name="date_audience">

<input type="time" name="heure">

<input type="text" name="juge" placeholder="Juge">

<select name="status">
    <option value="planifie">Planifiée</option>
    <option value="terminee">Terminée</option>
    <option value="reportee">Reportée</option>
</select>

<textarea name="notes" placeholder="Notes"></textarea>

<button type="submit">Ajouter</button>

</form>

</body>
</html>