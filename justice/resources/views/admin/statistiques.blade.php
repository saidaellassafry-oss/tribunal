<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques Dynamiques</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --deep-blue: #0a192f;
            --electric-blue: #00d2ff;
            --card-blue: #112240;
            --text-blue: #8892b0;
            --neon: #64ffda;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Roboto, sans-serif;
            background: radial-gradient(circle at center, #172a45 0%, var(--deep-blue) 100%);
            color: #e6f1ff;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* --- NAVIGATION --- */
        .nav-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .btn-return {
            background: transparent;
            color: var(--electric-blue);
            border: 1px solid var(--electric-blue);
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-return:hover {
            background: rgba(0, 210, 255, 0.1);
            box-shadow: 0 0 10px var(--electric-blue);
        }

        /* --- TITRE --- */
        .main-title {
            text-align: center;
            margin-bottom: 40px;
        }
        .main-title h1 {
            font-size: 24px;
            letter-spacing: 2px;
            color: var(--electric-blue);
            text-transform: uppercase;
        }

        /* --- LAYOUT GRAPHIQUES --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 25px;
        }

        .chart-card {
            background: var(--card-blue);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 10px 30px -15px rgba(2, 12, 27, 0.7);
            border: 1px solid rgba(0, 210, 255, 0.1);
        }

        .chart-card h3 {
            margin-top: 0;
            font-size: 16px;
            color: var(--text-blue);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        /* --- SUMMARY NUMBERS --- */
        .summary-bar {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 أعمدة فقط بدل 4 */
            gap: 15px;
            margin-bottom: 25px;
        }

        .mini-stat {
            background: rgba(0, 210, 255, 0.05);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border-bottom: 2px solid var(--electric-blue);
        }

        .mini-stat span { font-size: 12px; color: var(--text-blue); display: block; }
        .mini-stat b { font-size: 20px; color: #fff; }

        @media (max-width: 768px) {
            .summary-bar { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>

<div class="container">
    
    <div class="nav-bar">
        <a href="/dashboard" class="btn-return">⬅ RETOUR DASHBOARD</a>
        <div style="font-size: 12px; color: var(--neon);">SYSTEM: ADMIN</div>
    </div>

    <div class="main-title">
        <h1>📊 ANALYTICS HUB</h1>
    </div>

    <div class="summary-bar">
        <div class="mini-stat">
            <span>Total Dossiers</span>
            <b>{{ $dossiers_total }}</b>
        </div>
        <div class="mini-stat">
            <span>Audiences</span>
            <b>{{ $audiences_total }}</b>
        </div>
        <div class="mini-stat">
            <span>Demandes</span>
            <b>{{ $demandes_total }}</b>
        </div>
    </div>

    <div class="stats-grid">
        
        <div class="chart-card">
            <h3>État des Dossiers</h3>
            <canvas id="pieChart"></canvas>
        </div>

        <div class="chart-card">
            <h3>Flux d'Activité</h3>
            <canvas id="barChart"></canvas>
        </div>

    </div>
</div>

<script>
    // Configuration Graphique Circulaire
    new Chart(document.getElementById('pieChart'), {
        type: 'polarArea',
        data: {
            labels: ['Terminés', 'En cours', 'En attente'],
            datasets: [{
                data: [{{ $dossiers_termine }}, {{ $dossiers_en_cours }}, {{ $dossiers_attente }}],
                backgroundColor: [
                    'rgba(100, 255, 218, 0.6)', 
                    'rgba(0, 210, 255, 0.6)',   
                    'rgba(255, 171, 0, 0.6)'    
                ],
                borderWidth: 0
            }]
        },
        options: {
            plugins: {
                legend: { labels: { color: '#8892b0' } }
            },
            scales: {
                r: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { display: false } }
            }
        }
    });

    // Configuration Graphique en Barres (حذف Users من هنا أيضاً)
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Dossiers', 'Demandes', 'Audiences'],
            datasets: [{
                label: 'Volume Global',
                data: [{{ $dossiers_total }}, {{ $demandes_total }}, {{ $audiences_total }}],
                backgroundColor: 'rgba(0, 210, 255, 0.2)',
                borderColor: '#00d2ff',
                borderWidth: 2,
                borderRadius: 5
            }]
        },
        options: {
            scales: {
                y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#8892b0' } },
                x: { grid: { display: false }, ticks: { color: '#8892b0' } }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>

</body>
</html>