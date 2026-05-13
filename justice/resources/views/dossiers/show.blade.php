<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dossier</title>

    <style>
        body{
            font-family: Arial;
            background:#f4f4f4;
        }

        .container{
            width:70%;
            margin:auto;
            background:white;
            padding:20px;
            margin-top:20px;
            border-radius:10px;
        }

        input, button{
            display:block;
            width:100%;
            padding:10px;
            margin:8px 0;
        }

        button{
            background:#22c55e;
            color:white;
            border:none;
            cursor:pointer;
        }

        button:hover{
            background:#16a34a;
        }

        .card{
            padding:10px;
            border:1px solid #ddd;
            margin:10px 0;
            border-radius:8px;
            background:#fafafa;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- 📁 Dossier Info -->
    <h1>📁 Dossier {{ $dossier->id }}</h1>

    <hr>

    <!-- ➕ Upload Document -->
    <h3>➕ Ajouter Document</h3>

    <form action="/dossiers/{{ $dossier->id }}/documents" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="title" placeholder="Titre du document" required>

        <input type="file" name="file" required>

        <button type="submit">📤 Upload</button>
    </form>

    <hr>

    <!-- 📄 Documents List -->
    <h3>📄 Documents</h3>

    @foreach($dossier->documents as $doc)

        <div class="card">
            📄 {{ $doc->title }} <br>

            <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank">
                👁 View
            </a>
        </div>

    @endforeach

</div>

</body>
</html>