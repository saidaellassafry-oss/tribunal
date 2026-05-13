<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Archives - Dossiers Terminés</title>

    <style>
        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            background-attachment: fixed;
            color: #ffffff;
            min-height: 100vh;
        }

        .wrapper {
            padding: 40px 20px;
            box-sizing: border-box;
        }

        .top-bar {
            max-width: 1200px;
            margin: 0 auto 40px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 20px;
        }

        h2 {
            font-size: 24px;
            font-weight: 400;
            margin: 0;
            color: #f1f5f9;
        }

        .btn-back {
            background: transparent;
            color: #94a3b8;
            padding: 8px 18px;
            border: 1px solid #475569;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 20px;
            transition: transform 0.2s ease, border-color 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-4px);
            border-color: #3b82f6;
        }

        .title {
            font-size: 18px;
            font-weight: 600;
            color: #38bdf8;
            margin-bottom: 12px;
            display: block;
        }

        .info {
            font-size: 14px;
            color: #94a3b8;
            margin: 6px 0;
            line-height: 1.5;
        }

        .info strong {
            color: #e2e8f0;
        }

        .badge-container {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #334155;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            background: rgba(34, 197, 94, 0.1);
            color: #4ade80;
            border: 1px solid rgba(74, 222, 128, 0.2);
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        @media (max-width: 600px) {
            .top-bar {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="wrapper">

    <div class="top-bar">
        <h2>📁 Archives <strong>(Dossiers Terminés)</strong></h2>

        <a href="/employee/dashboard" class="btn-back">
            ← Retour
        </a>
    </div>

    <div class="container">

        @foreach($dossiers as $dossier)
        <div class="card">

            <span class="title">📄 {{ $dossier->title }}</span>

            <div class="info">
                <strong>N° Dossier :</strong> DOS-{{ str_pad($dossier->id, 5, '0', STR_PAD_LEFT) }}
            </div>

            <div class="info">
                <strong>Client :</strong> {{ $dossier->client }}
            </div>

            <div class="info">
                <strong>Type :</strong> {{ $dossier->description }}
            </div>

            <div class="badge-container">
                <span class="badge">Status: {{ $dossier->status }}</span>
            </div>

        </div>
        @endforeach

    </div>

</div>

</body>
</html>