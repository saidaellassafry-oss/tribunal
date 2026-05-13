<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Tribunal System</title>

<style>
body{
    margin:0;
    font-family:Arial;
    display:flex;
    background: linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
    color:white;
}

/* SIDEBAR */
.sidebar{
    width:240px;
    height:100vh;
    padding:20px;
    background:rgba(255,255,255,0.1);
    backdrop-filter:blur(18px);
    position:fixed;
    left:0;
    top:0;
}

.sidebar h2{
    color:#38bdf8;
}

.sidebar a{
    display:block;
    padding:10px;
    margin:8px 0;
    color:white;
    text-decoration:none;
    border-radius:8px;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.2);
}

/* HEADER */
.admin-header{
    position:fixed;
    top:0;
    left:240px;
    right:0;
    height:60px;
    background:rgba(255,255,255,0.1);
    backdrop-filter:blur(15px);
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 20px;
    z-index:10;
}

/* MAIN */
.main{
    margin-left:240px;
    width:100%;
}

/* CONTENT */
.main-content{
    margin-top:80px;
    padding:20px;
}

/* BUTTON */
.logout-btn{
    background:red;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:8px;
    cursor:pointer;
}
.logout-btn:hover{
    background:darkred;
}
</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>⚖ Tribunal</h2>

    <a href="#" onclick="loadPage('dashboard'); return false;">🏠 Dashboard</a>
    <a href="#" onclick="loadPage('dossiers'); return false;">📁 Dossiers</a>
    <a href="#" onclick="loadPage('audiences'); return false;">⚖ Audiences</a>
    <a href="#" onclick="loadPage('archives'); return false;">📦 Archives</a>
    <a href="#" onclick="loadPage('certificats'); return false;">📄 Certificats</a>
</div>

<div class="main">

    <!-- HEADER -->
    <div class="admin-header">
        <div>⚖ Admin Panel</div>

        <form method="POST" action="/logout">
            @csrf
            <button class="logout-btn">Déconnexion</button>
        </form>
    </div>

    <!-- CONTENT -->
    <div class="main-content" id="main-content">
        @include('partials.dashboard')
    </div>

</div>

<script>
function loadPage(page){

    fetch('/load/' + page)
        .then(res => res.text())
        .then(html => {
            document.getElementById('main-content').innerHTML = html;
        });

}
</script>

</body>
</html>