<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dossiers</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial, sans-serif;
    min-height:100vh;
    background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
    color:white;
    padding:20px;
}

.container{
    max-width:1000px;
    margin:auto;
}

/* HEADER */
.top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
    flex-wrap:wrap;
    gap:10px;
}

h1{
    color:#38bdf8;
}

/* BUTTONS */
.btn{
    text-decoration:none;
    padding:10px 15px;
    border-radius:10px;
    color:white;
    display:inline-block;
}

.dashboard{
    background:#f59e0b;
}

.add-btn{
    background:#22c55e;
    margin-bottom: 20px;
}

.edit{
    background:#22c55e;
}

.delete{
    background:#ef4444;
    border:none;
    cursor:pointer;
}

/* SEARCH */
.search-box{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    margin-bottom:20px;
    outline:none;
}

/* CARD */
.card{
    background:rgba(255,255,255,0.08);
    padding:18px;
    border-radius:15px;
    margin-bottom:12px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:15px;
}

.info{
    line-height:1.8;
}

.actions{
    display:flex;
    gap:8px;
    align-items:center;
}

.empty{
    text-align:center;
    padding:20px;
    background:rgba(255,255,255,0.08);
    border-radius:15px;
}
</style>
</head>

<body>

<div class="container">

    <div class="top">
        <h1>📁 Gestion des Dossiers</h1>

        @if(session('user')['role'] == 'admin')
            <a href="/dashboard" class="btn dashboard">⬅ Dashboard</a>
        @elseif(session('user')['role'] == 'employee')
            <a href="/employee/dashboard" class="btn dashboard">⬅ Dashboard</a>
        @else
            <a href="/citizen/dashboard" class="btn dashboard">⬅ Dashboard</a>
        @endif
    </div>

    @if(session('user') && in_array(session('user')['role'], ['admin','employee']))
        <a href="/dossiers/create" class="btn add-btn">➕ Ajouter dossier</a>
    @endif

    <form method="GET" action="/dossiers">
        <input 
            type="text"
            name="search"
            class="search-box"
            placeholder="🔍 Rechercher dossier..."
            value="{{ request('search') }}"
        >
    </form>

    @forelse($dossiers as $dossier)

    <div class="card">

        <div class="info">
            <div><strong>📁 {{ $dossier->title }}</strong></div>
            <div>#️⃣ <strong>N°:</strong> {{ $dossier->numero_dossier ?? '---' }}</div>
            <div>📂 <strong>Type:</strong> {{ $dossier->type_affaire ?? '---' }}</div>
            <div>👤 {{ $dossier->client }}</div>
            <div>⚖ {{ $dossier->status }}</div>
        </div>

        @if($canEdit)
        <div class="actions">

            <a href="/dossiers/{{ $dossier->id }}/edit" class="btn edit">
                ✏ Modifier
            </a>

            <form method="POST" action="/dossiers/{{ $dossier->id }}">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn delete"
                onclick="return confirm('Supprimer ce dossier ?')">
                    🗑 Supprimer
                </button>
            </form>

        </div>
        @endif

    </div>

    @empty

    <div class="empty">
        Aucun dossier disponible
    </div>

    @endforelse

</div>

</body>
</html>