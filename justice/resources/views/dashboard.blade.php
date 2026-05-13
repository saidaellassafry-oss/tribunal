<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Tribunal</title>

<style>
body{
    margin:0;
    font-family:Arial;
    min-height:100vh;
    display:flex;
    flex-direction:column;
    background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
    color:white;
}

/* HEADER */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 25px;
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(15px);
    border-bottom:1px solid rgba(255,255,255,0.2);
}

.right{
    display:flex;
    align-items:center;
    gap:15px;
}

.admin{
    font-weight:bold;
    color:#38bdf8;
    text-decoration:none;
    padding:8px 12px;
    border-radius:8px;
    background:rgba(255,255,255,0.1);
}

.admin:hover{
    background:rgba(255,255,255,0.2);
}

.logout-btn{
    background:red;
    color:white;
    border:none;
    padding:8px 14px;
    border-radius:8px;
    cursor:pointer;
}

.logout-btn:hover{
    background:darkred;
}

/* CONTENT */
.container{
    display:flex;
    flex:1;
}

/* SIDEBAR */
.sidebar{
    width:240px;
    padding:20px;
    background:rgba(255,255,255,0.1);
    backdrop-filter:blur(18px);
    border-right:1px solid rgba(255,255,255,0.2);
}

.sidebar h2{
    color:#38bdf8;
}

.sidebar a{
    display:block;
    padding:10px;
    margin:8px 0;
    color:#e2e8f0;
    text-decoration:none;
    border-radius:8px;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.2);
}

/* MAIN */
.main{
    flex:1;
    padding:30px;
}

.success{
    background:#22c55e;
    padding:12px;
    border-radius:10px;
    margin-bottom:15px;
    font-weight:bold;
}

/* CARDS */
.cards{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:15px;
    margin-top:20px;
}

.card{
    background:rgba(255,255,255,0.1);
    backdrop-filter:blur(15px);
    border:1px solid rgba(255,255,255,0.2);
    border-radius:15px;
    padding:20px;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
    background:rgba(255,255,255,0.2);
}

.card h3{
    color:#cbd5e1;
    font-size:14px;
    margin:0 0 10px;
}

.card p{
    font-size:24px;
    font-weight:bold;
    margin:0;
}

/* ACTIONS */
.actions{
    margin-top:30px;
}

.action-buttons{
    display:flex;
    flex-wrap:wrap;
    gap:12px;
    margin-top:15px;
}

.action-buttons a{
    text-decoration:none;
    color:white;
    background:rgba(255,255,255,0.1);
    padding:12px 16px;
    border-radius:10px;
}

.action-buttons a:hover{
    background:rgba(255,255,255,0.2);
}

/* MODULES */
.module{
    margin-top:30px;
}

.module-box{
    background:rgba(255,255,255,0.1);
    padding:12px;
    border-radius:10px;
    margin-top:10px;
    transition:0.3s;
}

.module-box:hover{
    background:rgba(255,255,255,0.2);
    transform:translateX(5px);
}

/* TABLE */
.table-box{
    margin-top:30px;
}

.table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
    background:rgba(255,255,255,0.08);
    border-radius:12px;
    overflow:hidden;
}

.table th,
.table td{
    padding:12px;
    text-align:left;
    border-bottom:1px solid rgba(255,255,255,0.1);
}

.table th{
    background:rgba(255,255,255,0.1);
}

.status-green{color:#22c55e;}
.status-orange{color:#f59e0b;}
.status-blue{color:#38bdf8;}

/* RESPONSIVE */
@media(max-width:900px){

    .container{
        flex-direction:column;
    }

    .sidebar{
        width:100%;
        border-right:none;
        border-bottom:1px solid rgba(255,255,255,0.2);
    }

    .cards{
        grid-template-columns:1fr;
    }

    .action-buttons{
        flex-direction:column;
    }
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">

    <h3>⚖ Tribunal</h3>

    <div class="right">

        <a href="/admin" class="admin">👤 Admin Panel</a>

        <form method="POST" action="/logout">
            @csrf
            <button class="logout-btn" type="submit">Déconnexion</button>
        </form>

    </div>

</div>

<!-- CONTENT -->
<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <h2>⚖ Tribunal</h2>

        <a href="/dashboard">🏠 Dashboard</a>
        <a href="/users">👥 Users</a>
        <a href="/dossiers">📁 Dossiers</a>
        <a href="/audiences">⚖ Audiences</a>
        <a href="/demandes">📄 Demandes</a>
        <a href="/statistiques">📊 Statistiques</a>
        <a href="/parametres">⚙ Paramètres</a>

    </div>

    <!-- MAIN -->
    <div class="main">

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <h1>Dashboard Admin ⚖</h1>

        <p>Bienvenue {{ $user }} 👤</p>

        <!-- CARDS -->
        <div class="cards">

            <div class="card">
                <h3>Total Dossiers</h3>
                <p>{{ $total }}</p>
            </div>

            <div class="card">
                <h3>En cours</h3>
                <p>{{ $enCours }}</p>
            </div>

            <div class="card">
                <h3>Terminés</h3>
                <p>{{ $termine }}</p>
            </div>

            <div class="card">
                <h3>En attente</h3>
                <p>{{ $attente }}</p>
            </div>

            <div class="card">
                <h3>Total Users</h3>
                <p>{{ $users ?? 0 }}</p>
            </div>

            <div class="card">
                <h3>Demandes</h3>
                <p>{{ $demandes ?? 0 }}</p>
            </div>

        </div>

        <!-- QUICK ACTIONS -->
        <div class="actions">
            <h2>⚡ Actions Rapides</h2>

            <div class="action-buttons">
                <a href="/users/create">➕ Ajouter User</a>
                <a href="/dossiers/create">📁 Nouveau Dossier</a>
                <a href="/audiences/create">⚖ Nouvelle Audience</a>
                <a href="/demandes">📄 Voir Demandes</a>
            </div>
        </div>

        <!-- MODULES -->
        <div class="module">

            <h2>📦 Modules</h2>

            <div class="module-box">⚖ Gestion Audiences</div>
            <div class="module-box">📁 Gestion Dossiers</div>
            <div class="module-box">📄 Certificats & Demandes</div>
            <div class="module-box">📊 Rapports & Statistiques</div>

        </div>

        <!-- LAST DOSSIERS -->
        <div class="table-box">

            <h2>🕒 Derniers Dossiers</h2>

            <table class="table">
                <tr>
                    <th>Titre</th>
                    <th>Client</th>
                    <th>Status</th>
                </tr>

                @foreach($latest as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->client }}</td>
                    <td>
                        @if($item->status == 'termine')
                            <span class="status-green">Terminé</span>
                        @elseif($item->status == 'attente')
                            <span class="status-orange">En attente</span>
                        @else
                            <span class="status-blue">En cours</span>
                        @endif
                    </td>
                </tr>
                @endforeach

            </table>

        </div>

    </div>

</div>

</body>
</html>