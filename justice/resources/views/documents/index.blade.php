<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Documents</title>

    <style>
        body{
            font-family: Arial;
            background:#f5f5f5;
        }

        .container{
            width:80%;
            margin:auto;
            padding:20px;
        }

        .card{
            background:white;
            padding:15px;
            margin:10px 0;
            border-radius:10px;
            box-shadow:0 2px 5px rgba(0,0,0,0.1);
        }

        .title{
            font-weight:bold;
            font-size:16px;
        }

        .meta{
            font-size:13px;
            color:gray;
        }

        a{
            display:inline-block;
            margin-top:10px;
            color:blue;
        }
    </style>
</head>

<body>

<div class="container">

<h1>📄 Documents</h1>

@foreach($documents as $doc)

<div class="card">

    <div class="title">📄 {{ $doc->title }}</div>

    <div class="meta">
        📁 Dossier ID: {{ $doc->dossier_id }} <br>
        👤 User ID: {{ $doc->user_id }} <br>
        📅 {{ $doc->created_at }}
    </div>

    <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank">
        👁 View Document
    </a>

</div>

@endforeach

</div>

</body>
</html>