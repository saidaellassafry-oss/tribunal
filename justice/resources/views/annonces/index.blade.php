<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Centre de Notifications</title>

<style>
:root{
    --bg:#0f172a;
    --panel:rgba(30,41,59,.75);
    --primary:#38bdf8;
    --danger:#ef4444;
    --warning:#f59e0b;
    --info:#3b82f6;
}

body{
    margin:0;
    font-family:Arial,sans-serif;
    background:linear-gradient(135deg,#0f172a,#1e293b,#0f172a);
    color:white;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px 35px;
    background:rgba(255,255,255,.05);
    border-bottom:1px solid rgba(255,255,255,.08);
}

.header h2{
    margin:0;
}

.back{
    text-decoration:none;
    color:white;
    background:rgba(255,255,255,.08);
    padding:10px 15px;
    border-radius:10px;
}

.wrapper{
    max-width:1150px;
    margin:auto;
    padding:25px;
    display:grid;
    grid-template-columns:340px 1fr;
    gap:25px;
}

.box{
    background:var(--panel);
    padding:22px;
    border-radius:18px;
}

input,textarea,select{
    width:100%;
    padding:12px;
    margin-bottom:12px;
    border:none;
    border-radius:10px;
    background:rgba(255,255,255,.08);
    color:black;
    box-sizing:border-box;
}

button{
    border:none;
    padding:12px;
    width:100%;
    border-radius:10px;
    color:white;
    font-weight:bold;
    cursor:pointer;
}

.btn{
    background:linear-gradient(135deg,#2563eb,#38bdf8);
}

.feed{
    display:flex;
    flex-direction:column;
    gap:15px;
}

.card{
    background:var(--panel);
    padding:18px;
    border-radius:18px;
    display:flex;
    gap:15px;
    transition:.3s;
}

.card:hover{
    transform:translateY(-2px);
}

.icon{
    width:50px;
    height:50px;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
    flex-shrink:0;
}

.info{background:rgba(59,130,246,.15);}
.urgent{background:rgba(239,68,68,.15);}
.alert{background:rgba(245,158,11,.15);}

.content{
    flex:1;
}

.content h3{
    margin:0;
}

.content p{
    color:#cbd5e1;
    font-size:14px;
}

.meta{
    margin-top:10px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:10px;
}

.actions a{
    text-decoration:none;
    color:white;
    font-size:13px;
    margin-left:10px;
}

.delete{
    color:#f87171;
}

@media(max-width:900px){
.wrapper{
grid-template-columns:1fr;
}
}
</style>
</head>

<body>

<div class="header">
<h2>📢 Centre d'annonces</h2>

<a href="
@if($user['role']=='admin')
/dashboard
@elseif($user['role']=='employee')
/employee/dashboard
@else
/citizen/dashboard
@endif
" class="back">⬅ Retour</a>
</div>

<div class="wrapper">

{{-- ADMIN ONLY --}}
@if($user['role']=='admin')

<div class="box">
<h3>Nouvelle annonce</h3>

<form method="POST" action="/annonces">
@csrf

<input name="title" placeholder="Titre" required>

<textarea name="content" rows="5" placeholder="Message"></textarea>

<select name="type">
<option value="info">Information</option>
<option value="urgent">Urgent</option>
<option value="alert">Alerte</option>
</select>

<button class="btn">Publier</button>

</form>
</div>

@endif

{{-- FEED --}}
<div class="feed">

@forelse($annonces as $a)

<div class="card">

<div class="icon {{ $a->type }}">
@if($a->type=='info') ℹ️
@elseif($a->type=='urgent') ⚠️
@else 🔔
@endif
</div>

<div class="content">

<h3>{{ $a->title }}</h3>

<p>{{ $a->content }}</p>

<div class="meta">

<small>
{{ $a->created_at ? $a->created_at->diffForHumans() : 'Maintenant' }}
</small>

@if($user['role']=='admin')
<div class="actions">
<a href="/annonces/edit/{{ $a->id }}">✏ Modifier</a>
<a href="/annonces/delete/{{ $a->id }}" class="delete"
onclick="return confirm('Supprimer ?')">🗑 Supprimer</a>
</div>
@endif

</div>

</div>
</div>

@empty

<div class="box">
Aucune annonce disponible.
</div>

@endforelse

</div>

</div>

</body>
</html>