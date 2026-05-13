<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Notifications</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background:#0f172a;
    color:white;
}

/* HEADER */
.header{
    background:#1e3a8a;
    padding:15px 20px;
    font-size:18px;
    font-weight:bold;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* CONTAINER */
.wrapper{
    width:100%;
    max-width:700px;
    margin:20px auto;
}

/* CARD */
.notif{
    background:rgba(255,255,255,0.06);
    border:1px solid rgba(255,255,255,0.1);
    padding:15px;
    margin-bottom:12px;
    border-radius:12px;
    display:flex;
    gap:12px;
    transition:0.3s;
}

.notif:hover{
    background:rgba(255,255,255,0.12);
}

/* ICON */
.icon{
    width:40px;
    height:40px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
    flex-shrink:0;
}

/* COLORS */
.info{background:#3b82f6;}
.urgent{background:#ef4444;}
.alert{background:#f59e0b;}

/* TEXT */
.content h4{
    margin:0;
    font-size:15px;
}

.content p{
    margin:5px 0 0;
    font-size:13px;
    color:rgba(255,255,255,0.7);
}

/* TAG */
.tag{
    display:inline-block;
    font-size:11px;
    padding:3px 8px;
    border-radius:20px;
    margin-top:6px;
    background:rgba(255,255,255,0.15);
}

/* FORM (mini style) */
.form{
    background:rgba(255,255,255,0.08);
    padding:15px;
    border-radius:12px;
    margin-bottom:15px;
}

input, textarea, select{
    width:100%;
    padding:8px;
    margin:5px 0;
    border-radius:8px;
    border:none;
    outline:none;
}

button{
    background:#22c55e;
    border:none;
    padding:10px;
    width:100%;
    border-radius:8px;
    color:white;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:#16a34a;
}

/* DOT like facebook */
.dot{
    width:8px;
    height:8px;
    border-radius:50%;
    background:#22c55e;
    margin-left:auto;
}
</style>
</head>

<body>

<div class="header">
📢 Notifications
<span>Admin Panel</span>
</div>

<div class="wrapper">

<!-- FORM -->
<div class="form">
<form method="POST" action="/annonces">
@csrf

<input name="title" placeholder="Titre..." required>

<textarea name="content" placeholder="Message..."></textarea>

<select name="type">
    <option value="info">Info</option>
    <option value="urgent">Urgent</option>
    <option value="alert">Alert</option>
</select>

<button>➕ Publier</button>
</form>
</div>

<!-- NOTIFICATIONS -->
@foreach($annonces as $a)

<div class="notif">

    <div class="icon {{ $a->type }}">
        @if($a->type == 'info') ℹ️
        @elseif($a->type == 'urgent') ⚠️
        @else 🔔
        @endif
    </div>

    <div class="content">
        <h4>{{ $a->title }}</h4>
        <p>{{ $a->content }}</p>

        <span class="tag">{{ $a->type }}</span>
    </div>

    <div class="dot"></div>

</div>

@endforeach

</div>

</body>
</html>