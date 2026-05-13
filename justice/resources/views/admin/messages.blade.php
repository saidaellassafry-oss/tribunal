<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messages reçus</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#0f172a;
            color:white;
            margin:0;
            padding:20px;
        }

        h2{
            text-align:center;
            margin-bottom:30px;
            color:#d4af37;
        }

        .container{
            max-width:900px;
            margin:auto;
        }

        .card{
            background:rgba(255,255,255,0.08);
            border:1px solid rgba(255,255,255,0.2);
            padding:20px;
            margin-bottom:15px;
            border-radius:12px;
            backdrop-filter: blur(10px);
        }

        .card p{
            margin:5px 0;
        }

        .btn{
            display:inline-block;
            margin-top:10px;
            padding:8px 15px;
            background:#d4af37;
            color:black;
            border-radius:20px;
            text-decoration:none;
            font-weight:bold;
        }

        .btn:hover{
            background:white;
        }

        .empty{
            text-align:center;
            opacity:0.7;
            margin-top:50px;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>📩 Messages reçus</h2>

    @if(count($messages) > 0)

        @foreach($messages as $msg)
            <div class="card">
                <p><strong>👤 Nom:</strong> {{ $msg->nom }}</p>
                <p><strong>📧 Email:</strong> {{ $msg->email }}</p>
                <p><strong>💬 Message:</strong> {{ $msg->message }}</p>

                <!-- زر الرد (من بعد غادي نخدموه) -->
                <a href="/admin/messages/{{ $msg->id }}" class="btn">
                    Répondre
                </a>
            </div>
        @endforeach

    @else
        <p class="empty">Aucun message reçu</p>
    @endif

</div>

</body>
</html>