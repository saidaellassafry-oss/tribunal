
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Annonce | Justice System</title>

    <style>
        :root {
            --bg: #0f172a;
            --card: rgba(30, 41, 59, 0.7);
            --primary: #38bdf8;
            --success: #22c55e;
            --text-muted: #94a3b8;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: radial-gradient(circle at center, #1e293b, #0f172a);
            color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 500px;
            background: var(--card);
            backdrop-filter: blur(12px);
            padding: 40px;
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        h2 {
            margin-top: 0;
            font-size: 1.8rem;
            text-align: center;
            background: linear-gradient(to right, #38bdf8, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 8px;
            margin-left: 5px;
        }

        input, textarea, select {
            width: 100%;
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 14px;
            border-radius: 14px;
            color: white;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(15, 23, 42, 0.8);
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .btn-update {
            margin-top: 10px;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
            padding: 16px;
            border: none;
            border-radius: 14px;
            width: 100%;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 10px 15px -3px rgba(34, 197, 94, 0.3);
        }

        .btn-update:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
            box-shadow: 0 15px 20px -3px rgba(34, 197, 94, 0.4);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9rem;
            transition: 0.2s;
        }

        .back-link:hover {
            color: white;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>✏️ Modifier l'annonce</h2>

    <form method="POST" action="/annonces/update/{{ $a->id }}">
        @csrf
        {{-- Laravel nécessite parfois @method('PUT') selon ta route --}}

        <div class="form-group">
            <label>Titre de l'annonce</label>
            <input type="text" name="title" value="{{ $a->title }}" required>
        </div>

        <div class="form-group">
            <label>Message / Contenu</label>
            <textarea name="content">{{ $a->content }}</textarea>
        </div>

        <div class="form-group">
            <label>Priorité & Type</label>
            <select name="type">
                <option value="info" {{ $a->type == 'info' ? 'selected' : '' }}>💡 Information</option>
                <option value="urgent" {{ $a->type == 'urgent' ? 'selected' : '' }}>🔥 Urgent</option>
                <option value="alert" {{ $a->type == 'alert' ? 'selected' : '' }}>🔔 Alerte</option>
            </select>
        </div>

        <button type="submit" class="btn-update">💾 SAUVEGARDER LES CHANGEMENTS</button>

    </form>

    <a href="/annonces" class="back-link">← Retourner aux notifications</a>

</div>

</body>
</html>
