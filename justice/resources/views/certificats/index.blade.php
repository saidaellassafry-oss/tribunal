<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Certificats</title>

<style>

body{
    margin:0;
    font-family:Segoe UI,sans-serif;
    background:linear-gradient(135deg,#0b1220,#1e3a8a,#2563eb);
    color:white;
}

.container{
    width:92%;
    margin:auto;
    padding:30px;
}

.card{
    background:rgba(255,255,255,0.08);
    padding:18px;
    border-radius:14px;
    margin-bottom:15px;
    box-shadow:0 10px 20px rgba(0,0,0,0.15);
}

.line{
    margin:6px 0;
}

.btn{
    padding:9px 14px;
    border-radius:8px;
    text-decoration:none;
    color:white;
    margin-right:8px;
    display:inline-block;
    font-weight:600;
}

.pdf{
    background:#ef4444;
}

.back{
    background:#334155;
}

.empty{
    background:rgba(255,255,255,0.08);
    padding:20px;
    border-radius:12px;
}

.search{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    margin-bottom:20px;
    font-size:15px;
    outline:none;
    box-sizing:border-box;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.header h1{
    margin:0;
}

</style>
</head>

<body>

<div class="container">

<div class="header">

<h1>📄 Certificats</h1>

<a href="/employee/dashboard" class="btn back">
⬅ Retour
</a>

</div>

<input
type="text"
id="search"
class="search"
placeholder="🔍 Rechercher un certificat..."
>

@forelse($certificats as $c)

<div class="card certificat">

<div class="line">
📄 <b>{{ $c->cert_number }}</b>
</div>

<div class="line">
👤 {{ $c->user->name ?? 'Unknown' }}
</div>

<div class="line">
📌 {{ $c->type }}
</div>

<div class="line">
📅 {{ $c->created_at->format('d/m/Y') }}
</div>

<br>

<a
class="btn pdf"
href="{{ url('/certificat/'.$c->id.'/pdf') }}"
target="_blank"
>
🖨 Télécharger PDF
</a>

</div>

@empty

<div class="empty">
📭 No certificats found
</div>

@endforelse

</div>

<script>

const search = document.getElementById('search');

search.addEventListener('keyup', function(){

let value = this.value.toLowerCase();

let cards = document.querySelectorAll('.certificat');

cards.forEach(card => {

if(card.innerText.toLowerCase().includes(value)){
    card.style.display = 'block';
}else{
    card.style.display = 'none';
}

});

});

</script>

</body>
</html>