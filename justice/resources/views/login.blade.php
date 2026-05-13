<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Tribunal</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial, sans-serif;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
    background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
    color:white;
    overflow:hidden;
}

/* animation background */
body::before{
    content:"";
    position:absolute;
    width:500px;
    height:500px;
    background:rgba(255,255,255,0.08);
    border-radius:50%;
    top:-150px;
    left:-150px;
    animation:move1 8s infinite alternate;
}

body::after{
    content:"";
    position:absolute;
    width:400px;
    height:400px;
    background:rgba(255,255,255,0.05);
    border-radius:50%;
    bottom:-150px;
    right:-100px;
    animation:move2 10s infinite alternate;
}

@keyframes move1{
    from{transform:translateY(0);}
    to{transform:translateY(80px);}
}

@keyframes move2{
    from{transform:translateX(0);}
    to{transform:translateX(-80px);}
}

/* typing text */
.hero{
    position:relative;
    z-index:2;
    margin-bottom:25px;
    text-align:center;
    perspective:1000px;
}

.hero h1{
    font-size:34px;
    font-weight:bold;
    letter-spacing:2px;
    color:#fff;
    text-shadow:0 10px 20px rgba(0,0,0,0.35);
    transform:rotateX(15deg);
}

.typing{
    font-size:18px;
    color:#dbeafe;
    margin-top:10px;
    border-right:3px solid white;
    white-space:nowrap;
    overflow:hidden;
    width:0;
    animation:typing 5s steps(30,end) infinite,
             blink .7s infinite;
}

@keyframes typing{
    0%{width:0}
    40%{width:100%}
    60%{width:100%}
    100%{width:0}
}

@keyframes blink{
    50%{border-color:transparent;}
}

/* login box */
.box{
    position:relative;
    z-index:2;
    width:420px;
    padding:30px;
    border-radius:20px;
    background:rgba(255,255,255,0.12);
    backdrop-filter:blur(18px);
    box-shadow:0 15px 35px rgba(0,0,0,0.35);
    animation:up 1s ease;
}

@keyframes up{
    from{transform:translateY(40px);opacity:0;}
    to{transform:translateY(0);opacity:1;}
}

h2{
    text-align:center;
    margin-bottom:15px;
}

label{
    display:block;
    margin-top:12px;
    font-weight:bold;
}

input{
    width:100%;
    padding:12px;
    margin-top:5px;
    border:none;
    border-radius:10px;
    outline:none;
    font-size:14px;
}

button{
    width:100%;
    margin-top:20px;
    padding:12px;
    border:none;
    border-radius:10px;
    background:#38bdf8;
    color:white;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;
}

button:hover{
    background:#0ea5e9;
    transform:scale(1.03);
}

.link{
    text-align:center;
    margin-top:15px;
}

.link a{
    color:white;
    text-decoration:underline;
}

.error{
    background:#ef4444;
    padding:10px;
    border-radius:8px;
    margin-bottom:10px;
    text-align:center;
}

.success{
    background:#22c55e;
    padding:10px;
    border-radius:8px;
    margin-bottom:10px;
    text-align:center;
}
</style>
</head>

<body>

<!-- animated top text -->
<div class="hero">
    <h1>⚖ Système de Justice</h1>
    <div class="typing">Bienvenue dans votre espace sécurisé...</div>
</div>

<div class="box">

<h2>Login Tribunal</h2>

@if(session('success'))
<div class="success">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="error">
@foreach ($errors->all() as $error)
{{ $error }}<br>
@endforeach
</div>
@endif

<form method="POST" action="/login">
@csrf

<label>Email</label>
<input type="email" name="email" autocomplete="off" required>

<label>Mot de passe</label>
<input type="password" name="password" autocomplete="new-password" required>

<button type="submit">Connexion</button>

</form>

<div class="link">
<p>Vous êtes nouveau ?</p>
<a href="/register">Créer un compte</a>
</div>

<div class="link">
<a href="/">⬅ Retour</a>
</div>

</div>

</body>
</html>