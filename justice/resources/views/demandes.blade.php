<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Demandes</title>

<style>
body{
    margin:0;
    font-family:'Segoe UI', sans-serif;
    background: linear-gradient(135deg,#0b1220,#1e3a8a,#2563eb);
    color:white;
}

.container{
    width:92%;
    margin:auto;
    padding:30px;
}

/* TOP */
.top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

h1{font-size:28px;}

a, button{
    border:none;
    text-decoration:none;
    padding:10px 14px;
    border-radius:10px;
    cursor:pointer;
    color:white;
    font-weight:600;
    transition:0.3s;
}

a:hover, button:hover{ transform:scale(1.05); }

.btn-back{background:#334155;}
.btn-send{background:#22c55e;}
.btn-search{background:#3b82f6;}
.btn-accept{background:#16a34a;}
.btn-reject{background:#dc2626;}
.btn-details{
    background: linear-gradient(145deg,#3b82f6,#1d4ed8);
    margin-top:8px;
}

/* SEARCH */
.search{
    display:flex;
    gap:10px;
    margin:15px 0;
}

.search input{
    flex:1;
    padding:10px;
    border-radius:10px;
    border:none;
    background:rgba(255,255,255,0.15);
    color:white;
    outline:none;
}

/* STATS */
.stats{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:15px;
    margin:20px 0;
}

.stat{
    background:rgba(255,255,255,0.08);
    padding:18px;
    border-radius:15px;
    text-align:center;
}

/* CARD */
.card{
    background:rgba(255,255,255,0.08);
    padding:18px;
    border-radius:16px;
    margin-bottom:15px;
}

/* FORM */
.form-3d{
    max-width:420px;
    margin:auto;
    background: rgba(255,255,255,0.08);
    padding:18px;
    border-radius:18px;
}

.stack{
    display:flex;
    flex-direction:column;
    gap:10px;
}

input, select, textarea{
    padding:10px;
    border:none;
    border-radius:10px;
    background:rgba(255,255,255,0.15);
    color:white;
    outline:none;
}

/* IMPORTANT: options visibility fix */
select option{
    background:#0f172a;
    color:white;
}

/* STATUS */
.badge{
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
}

.wait{background:#f59e0b;}
.ok{background:#22c55e;}
.no{background:#ef4444;}

/* MODAL */
.modal{
    display:none;
    position:fixed;
    top:0;left:0;
    width:100%;height:100%;
    background:rgba(0,0,0,0.7);
    justify-content:center;
    align-items:center;
}

.modal-box{
    background:#0f172a;
    padding:20px;
    border-radius:12px;
    width:90%;
    max-width:500px;
}
</style>
</head>

<body>

<div class="container">

<!-- TOP -->
<div class="top">
<h1>📄 Demandes</h1>

<a class="btn-back" href="
@if($user['role']==='admin')
/dashboard
@elseif($user['role']==='employee')
/employee/dashboard
@else
/citizen/dashboard
@endif
">⬅ Retour</a>
</div>

<!-- SEARCH -->
<form method="GET" action="/demandes" class="search">
    <input type="text" name="search" placeholder="🔍 Rechercher demande..." value="{{ request('search') }}">
    <button class="btn-search">Rechercher</button>
</form>

<!-- STATS -->
<div class="stats">
<div class="stat">{{ count($demandes) }}<br>Total</div>
<div class="stat">{{ $demandes->where('status','en_attente')->count() }}<br>En attente</div>
<div class="stat">{{ $demandes->where('status','accepté')->count() }}<br>Acceptées</div>
<div class="stat">{{ $demandes->where('status','refusé')->count() }}<br>Refusées</div>
</div>

<!-- FORM -->
@if($user['role']==='citizen')
<div class="card form-3d">
<h3>➕ Nouvelle demande</h3>

<form method="POST" action="/demandes" class="stack">
@csrf



<input type="text" name="title" placeholder="Titre" required>

<!-- TYPE FULL -->
<select name="type" required>
    <option value="">-- Type de demande --</option>

    <option value="certificat_naissance">Certificat de naissance</option>
    <option value="certificat_deces">Certificat de décès</option>
    <option value="certificat_mariage">Certificat de mariage</option>
    <option value="acte_divorce">Acte de divorce</option>

    <option value="plainte">Plainte</option>
    <option value="casier">Casier judiciaire</option>
    <option value="convocation">Convocation tribunal</option>
    <option value="jugement">Copie de jugement</option>

    <option value="attestation">Attestation</option>
    <option value="certificat_residence">Certificat de résidence</option>
    <option value="legalisation">Légalisation signature</option>

    <option value="demande_audience">Demande d’audience</option>
    <option value="report_audience">Report d’audience</option>

    <option value="urgence">Urgence</option>
    <option value="autre">Autre</option>
</select>

<textarea name="description" placeholder="Description"></textarea>

<input name="full_name" placeholder="Nom complet">
<input name="phone" placeholder="Téléphone">
<input name="cin" placeholder="CIN">
<input name="address" placeholder="Adresse">
<input name="city" placeholder="Ville">

<select name="priority" required>
    <option value="normal">Normal</option>
    <option value="urgent">Urgent</option>
</select>

<button class="btn-send">📨 Envoyer</button>
</form>
</div>
@endif

<!-- LIST -->
@forelse($demandes as $d)
<div class="card">

<h3>{{ $d->title }}</h3>

<p>
Status:
@if($d->status=='en_attente')
<span class="badge wait">En attente</span>
@elseif($d->status=='accepté')
<span class="badge ok">Accepté</span>
@else
<span class="badge no">Refusé</span>
@endif
</p>

<button class="btn-details" onclick="openModal({{ $d->id }})">
👁 Détails
</button>

@if($user['role'] !== 'citizen')
<form method="POST" action="/demandes/{{ $d->id }}/accept" style="display:inline;">
@csrf
<button class="btn-accept">✔</button>
</form>

<form method="POST" action="/demandes/{{ $d->id }}/reject" style="display:inline;">
@csrf
<button class="btn-reject">✖</button>
</form>
@endif

</div>
@empty
<div class="card">📭 Aucune demande</div>
@endforelse

</div>

<!-- MODAL -->
<div class="modal" id="modal">
<div class="modal-box">
<h3>📄 Détails</h3>
<div id="content"></div>
<br>
<button class="btn-back" onclick="closeModal()">Fermer</button>
</div>
</div>

<script>
let demandes = @json($demandes);

function openModal(id){
let d = demandes.find(x=>x.id===id);

document.getElementById('content').innerHTML=`
<p><b>Titre:</b> ${d.title}</p>
<p><b>Type:</b> ${d.type}</p>
<p><b>Description:</b> ${d.description ?? '-'}</p>
<hr>
<p><b>Nom:</b> ${d.full_name ?? '-'}</p>
<p><b>Tel:</b> ${d.phone ?? '-'}</p>
<p><b>CIN:</b> ${d.cin ?? '-'}</p>
<p><b>Adresse:</b> ${d.address ?? '-'}</p>
<p><b>Ville:</b> ${d.city ?? '-'}</p>
<p><b>Priority:</b> ${d.priority ?? 'normal'}</p>
<p><b>Status:</b> ${d.status}</p>
`;

document.getElementById('modal').style.display='flex';
}

function closeModal(){
document.getElementById('modal').style.display='none';
}
</script>

</body>
</html>