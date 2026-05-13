<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Liste des audiences</title>

<style>
body{
    font-family:Arial;
    background:#0f172a;
    color:white;
    margin:0;
    padding:20px;
}

.container{
    width:90%;
    margin:auto;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:10px;
    flex-wrap:wrap;
    margin-bottom:20px;
}

.header-right{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

a.btn{
    background:#38bdf8;
    color:white;
    padding:10px 15px;
    border-radius:10px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}

a.btn:hover{
    transform:translateY(-2px);
}

.search-box{
    margin-bottom:20px;
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.search-box input{
    padding:10px;
    width:260px;
    border:none;
    border-radius:10px;
    outline:none;
}

.search-box button{
    padding:10px 15px;
    border:none;
    border-radius:10px;
    background:#38bdf8;
    color:white;
    font-weight:bold;
    cursor:pointer;
}

.card{
    background:#1e293b;
    padding:18px;
    margin-bottom:16px;
    border-radius:14px;
    border-left:4px solid #38bdf8;
    box-shadow:0 8px 20px rgba(0,0,0,0.20);
}

.title{
    font-size:19px;
    font-weight:bold;
    color:#38bdf8;
    margin-bottom:10px;
}

.row{
    margin:6px 0;
    font-size:14px;
}

.muted{
    color:#94a3b8;
    font-size:13px;
}

.badge{
    display:inline-block;
    padding:4px 10px;
    border-radius:8px;
    font-size:12px;
    font-weight:bold;
}

.planifie{background:orange;}
.terminee{background:green;}
.reportee{background:red;}

.actions{
    margin-top:14px;
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.btn-edit{
    background:linear-gradient(135deg,#f59e0b,#d97706);
    color:white;
    padding:10px 16px;
    border-radius:10px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}

.btn-edit:hover{
    transform:translateY(-2px);
}

.btn-delete{
    background:linear-gradient(135deg,#ef4444,#dc2626);
    color:white;
    border:none;
    padding:10px 16px;
    border-radius:10px;
    font-weight:bold;
    cursor:pointer;
    box-shadow:0 4px 10px rgba(239,68,68,0.30);
    transition:0.3s;
}

.btn-delete:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 18px rgba(239,68,68,0.45);
    background:linear-gradient(135deg,#dc2626,#b91c1c);
}

.btn-delete:active{
    transform:scale(0.96);
}

.btn-delete:focus{
    outline:none;
}
</style>
</head>

<body>

<div class="container">

<div class="header">
    <h2>📅 Liste des audiences</h2>

    <div class="header-right">

        @if(isset($user) && $user['role'] === 'employee')
            <a class="btn" href="/employee/dashboard">🏠 Dashboard</a>
        @elseif(isset($user) && $user['role'] === 'citizen')
            <a class="btn" href="/citizen/dashboard">🏠 Dashboard</a>
        @else
            <a class="btn" href="/dashboard">🏠 Dashboard</a>
        @endif

        @if(isset($user) && in_array($user['role'], ['admin','employee']))
            <a class="btn" href="/audiences/create">➕ Ajouter audience</a>
        @endif

    </div>
</div>

<form method="GET" action="/audiences" class="search-box">
    <input type="text" name="search" placeholder="Rechercher audience...">
    <button type="submit">🔍 Recherche</button>
</form>

@if($audiences->count())

    @foreach($audiences as $a)

    <div class="card">

        <div class="title">⚖ {{ $a->titre ?? '---' }}</div>

        <div class="row">🏛 Tribunal: {{ $a->tribunal ?? '---' }}</div>
        <div class="row">📍 Salle: {{ $a->salle ?? '---' }}</div>
        <div class="row">📅 {{ $a->date_audience ?? '---' }} | ⏰ {{ $a->heure ?? '---' }}</div>
        <div class="row">👨‍⚖ Juge: {{ $a->juge ?? 'Non assigné' }}</div>

        <div class="row muted">📁 Dossier: {{ $a->dossier_id ?? '---' }}</div>
        <div class="row muted">👨‍💼 Défenseur: {{ $a->defenseur ?? '---' }}</div>
        <div class="row muted">👤 Accusé: {{ $a->accuse ?? '---' }}</div>

        <div class="row">
            ⚖ Statut:
            <span class="badge {{ $a->status }}">
                {{ $a->status }}
            </span>
        </div>

        <div class="row muted">📝 Notes: {{ $a->notes ?? '-' }}</div>

        @if(isset($user) && in_array($user['role'], ['admin','employee']))
        <div class="actions">

            <a href="/audiences/{{ $a->id }}/edit" class="btn-edit">
                ✏ Modifier
            </a>

            <form method="POST" action="/audiences/{{ $a->id }}">
                @csrf
                @method('DELETE')
                <button type="submit"
                class="btn-delete"
                onclick="return confirm('Supprimer cette audience ?')">
                    🗑 Supprimer
                </button>
            </form>

        </div>
        @endif

    </div>

    @endforeach

@else
    <p>Aucune audience trouvée.</p>
@endif

</div>

</body>
</html>