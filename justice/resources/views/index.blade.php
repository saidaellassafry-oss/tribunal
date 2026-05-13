<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des audiences</title>

    <style>
        body{
            font-family: Arial;
            background: #0f172a;
            color: white;
            margin: 0;
            padding: 20px;
        }

        h2{
            text-align: center;
            margin-bottom: 20px;
        }

        .container{
            width: 90%;
            margin: auto;
        }

        .card{
            background: #1e293b;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }

        .title{
            font-size: 18px;
            font-weight: bold;
            color: #38bdf8;
        }

        .row{
            margin-top: 5px;
        }

        .badge{
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
        }

        .planifie{ background: orange; }
        .terminee{ background: green; }
        .reportee{ background: red; }

        .empty{
            text-align:center;
            margin-top:50px;
            color:#94a3b8;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>📅 Liste des audiences</h2>

    @if($audiences->count())

        @foreach($audiences as $a)
            <div class="card">

                <div class="title">
                    {{ $a->title }}
                </div>

                <div class="row">
                    🏛 Tribunal: {{ $a->tribunal ?? 'Non défini' }}
                </div>

                <div class="row">
                    📍 Salle: {{ $a->salle }}
                </div>

                <div class="row">
                    📅 Date: {{ $a->date_audience }} - ⏰ {{ $a->heure }}
                </div>

                <div class="row">
                    ⚖ Juge: {{ $a->juge ?? '---' }}
                </div>

                <div class="row">
                    <span class="badge {{ $a->status }}">
                        {{ $a->status }}
                    </span>
                </div>

                @if($a->notes)
                    <div class="row">
                        📝 {{ $a->notes }}
                    </div>
                @endif

            </div>
        @endforeach

    @else
        <div class="empty">
            Aucune audience disponible 😴
        </div>
    @endif

</div>

</body>
</html>