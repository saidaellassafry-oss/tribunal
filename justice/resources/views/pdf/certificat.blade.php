<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #000;
            margin: 0;
            padding: 0;
            direction: ltr;
        }
        .page {
            padding: 40px;
            border: 1px solid #333;
            margin: 20px;
            min-height: 950px;
        }
        /* EN-TÊTE OFFICIEL */
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 50px;
        }
        .header-right {
            text-align: center;
            font-weight: bold;
            line-height: 1.5;
            font-size: 13px;
        }
        /* TITRE PRINCIPAL */
        .title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 50px;
            text-transform: uppercase;
        }
        /* CORPS DU TEXTE */
        .content {
            font-size: 16px;
            line-height: 2.2;
            text-align: justify;
        }
        .line {
            border-bottom: 1px dotted #000;
            display: inline-block;
            min-width: 200px;
            padding: 0 5px;
            font-weight: bold;
        }
        .section-title {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 20px;
        }
        /* SIGNATURE ET DATE */
        .footer-table {
            width: 100%;
            margin-top: 60px;
        }
        .signature-box {
            text-align: center;
            float: right;
            width: 250px;
        }
        .stamp-zone {
            margin-top: 15px;
            height: 100px;
            border: 1px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="page">
    <div class="header">
        <div class="header-right">
            ROYAUME DU MAROC<br>
            MINISTÈRE DE LA JUSTICE<br>
            Cour d'Appel de : <span class="line">{{ $tribunal_city ?? '............' }}</span><br>
            Tribunal de Première Instance de : <span class="line">Sidi Bennour</span>
        </div>
    </div>

    <div class="title">CERTIFICAT DE GREFFE</div>

    <div class="content">
        Le Chef du Secrétariat-Greffe du Tribunal de Première Instance de <span class="line">Sidi Bennour</span>, 
        certifie après consultation du dossier de <span class="line">{{ $certificat->type ?? 'Responsabilité Délictuelle' }}</span>, 
        sous le numéro <span class="line">{{ $certificat->cert_number }}</span>, 
        en date du <span class="line">{{ $certificat->date_file ?? '..../..../2026' }}</span>,
        lequel a fait l'objet d'un jugement sous le numéro <span class="line">{{ $certificat->judgment_number ?? '..........' }}</span>.

        <div class="section-title">ENTRE :</div>
        1) <span class="line">{{ $certificat->user->name }}</span><br>
        2) <span class="line">......................................................</span>

        <div class="section-title">CONTRE :</div>
        1) <span class="line">{{ $certificat->adversaire ?? '................................' }}</span><br>
        2) <span class="line">......................................................</span>

        <p style="margin-top: 30px;">
            En foi de quoi, le présent certificat est délivré à M/Mme : <strong>{{ $certificat->user->name }}</strong>, 
            pour servir et valoir ce que de droit.
        </p>
    </div>

    <div class="footer-table">
        <div style="float: left;">
            Fait à <span class="line">Sidi Bennour</span>, le : <strong>{{ date('d/m/Y') }}</strong>
        </div>
        
        <div class="signature-box">
            <strong>P. LE CHEF DU GREFFE</strong><br>
            (Signature et Sceau)
            <div class="stamp-zone">Sceau du Tribunal</div>
        </div>
    </div>
</div>

</body>
</html>