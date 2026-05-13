<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Créer compte</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
    color:white;
}

.box{
    width:420px;
    padding:30px;
    border-radius:18px;
    background:rgba(255,255,255,0.12);
    backdrop-filter:blur(18px);
}

h2{
    text-align:center;
    margin-bottom:15px;
}

input{
    width:100%;
    padding:12px;
    margin-top:10px;
    border:none;
    border-radius:10px;
    outline:none;
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
}

button:hover{
    background:#16a34a;
}

a{
    display:block;
    text-align:center;
    margin-top:10px;
    color:white;
    text-decoration:none;
}

.error{
    background:#ef4444;
    padding:10px;
    border-radius:8px;
    margin-bottom:10px;
    text-align:center;
}
</style>
</head>

<body>

<div class="box">

<h2>Créer un compte 👤</h2>

{{-- ERRORS --}}
@if ($errors->any())
<div class="error">
@foreach ($errors->all() as $error)
    {{ $error }}<br>
@endforeach
</div>
@endif

{{-- SUCCESS MESSAGE --}}
@if(session('success'))
<div style="background:#22c55e;padding:10px;border-radius:8px;margin-bottom:10px;text-align:center;">
    {{ session('success') }}
</div>
@endif

<form method="POST" action="/register">
@csrf

<input type="text" name="name" placeholder="Nom complet" required autocomplete="off">

<input type="email" name="email" placeholder="Email" required autocomplete="off">

<input type="password" name="password" placeholder="Mot de passe" required autocomplete="new-password">
<button type="submit">Créer compte</button>

</form>

<a href="/login">⬅ Retour login</a>

</div>

</body>
</html>