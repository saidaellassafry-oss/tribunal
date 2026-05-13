<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Certificat Administratif</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            color: #1a1a1a;
        }
        .document-container {
            padding: 40px;
            border: 1px solid #000;
            margin: 20px;
            min-height: 900px;
        }
        /* Header */
        .official-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }
        .official-header h2 { margin: 5px 0; font-size: 18px; text-transform: uppercase; }
        
        /* Meta Info (Réf & Date) */
        .doc-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            font-size: 14px;
        }

        /* Title */
        .doc-title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            text-decoration: underline;
            margin: 40px 0;
            text-transform: uppercase;
        }

        /* Body */
        .doc-body {
            font-size: 16px;
            line-height: 2;
            text-align: justify;
        }
        .field-value {
            font-weight: bold;
            border-bottom: 1px dotted #000;
            padding: 0 5px;
        }

        /* Signature */
        .signature-section {
            margin-top: 80px;
            text-align: right;
            padding-right: 50px;
        }
    </style>
</head>
<body>

<div class="document-container">
    <div class="official-header">
        <h2>Royaume du Maroc</h2>
        <p>Ministère de la Justice</p>
        <p>Tribunal de Première Instance de <strong>Sidi Bennour</strong></p>
    </div>

    <div class="doc-meta">
        <div style="float: left;">Réf: <span class="field-value">{{ $certificat->cert_number }}</span></div>
        <div style="float: right;">Fait à Sidi Bennour, le: <span class="field-value">{{ date('d/m/Y') }}</span></div>
        <div style="clear: both;"></div>
    </div>

    <div class="doc-title">
        {{ strtoupper(str_replace('_', ' ', $certificat->type)) }}
    </div>

    <div class="doc-body">
        <p>Le Chef du Secrétariat-Greffe certifie par la présente que :</p>
        
        <p><strong>M. / Mme :</strong> <span class="field-value">{{ $certificat->user->name }}</span></p>
        <p><strong>Email :</strong> <span class="field-value">{{ $certificat->user->email }}</span></p>
        <p><strong>Type de demande :</strong> <span class="field-value">{{ $certificat->type }}</span></p>
        <p><strong>Référence dossier :</strong> <span class="field-value">#{{ $certificat->demande_id }}</span></p>

        <p style="margin-top: 40px;">
            Ce certificat est délivré sur la base des registres officiels du tribunal pour servir et valoir ce que de droit.
        </p>
    </div>

    <div class="signature-section">
        <strong>P. Le Chef du Greffe</strong><br>
        <p>(Signature et Sceau Officiel)</p>
    </div>
</div>

</body>
</html>