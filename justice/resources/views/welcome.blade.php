<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Système de Justice</title>

    <style>
        /* BODY FIX (no scroll) */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: white;
            overflow: hidden; /* 🔥 important */
        }

        /* HERO FULL SCREEN */
        .hero {
            height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-image: url("/tribinal.png");
            background-size: cover;
            background-position: center;
            position: relative;
        }

        /* DARK OVERLAY */
        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.3);
        }

        /* CONTENT BOX */
        .content {
            position: relative;
            z-index: 2;
            max-width: 700px;
            padding: 20px;
        }

        h1 {
            font-size: 50px;
            margin-bottom: 15px;
            text-shadow: 0 3px 15px rgba(0,0,0,0.8);
        }

        p {
            font-size: 18px;
            line-height: 1.7;
            margin-bottom: 30px;
            color: rgba(255,255,255,0.95);
            text-shadow: 0 2px 10px rgba(0,0,0,0.7);
        }

        /* BUTTON */
        .btn {
            display: inline-block;
            padding: 14px 40px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 0 4px 20px rgba(37,99,235,0.6);
        }

        .btn:hover {
            background: #1d4ed8;
            transform: translateY(-3px);
        }

        .btn:active {
            transform: scale(0.95);
        }

    </style>
</head>

<body>

<div class="hero">

    <div class="content">

        <h1>⚖ Système de Justice</h1>

        <p>
            Bienvenue dans le système de gestion judiciaire.<br>
            Gérez les dossiers, consultez les informations et suivez les procédures en toute sécurité.
        </p>

        <!-- LOGIN BUTTON -->
        <a href="/login" class="btn">
    Se connecter
</a>
    </div>

</div>

</body>
</html>   