<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 13px; line-height: 1.6; }
        .container { padding: 30px; border: 1px solid #000; }
        
        /* Header */
        .header-table { width: 100%; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .title { text-align: center; font-size: 18px; font-weight: bold; margin: 20px 0; text-decoration: underline; }

        /* Infos Dossier */
        .info-box { border: 1px solid #000; padding: 10px; margin-bottom: 20px; width: 50%; }

        /* Formulaire */
        .form-section { margin-top: 20px; }
        .dotted { border-bottom: 1px dotted #000; display: inline-block; min-width: 150px; }
        
        /* Table de Livraison (L'agent) */
        .delivery-table { width: 100%; border: 1px solid #000; border-collapse: collapse; margin-top: 30px; }
        .delivery-table td { border: 1px solid #000; padding: 15px; vertical-align: top; }

        /* Checkboxes */
        .checkbox { width: 15px; height: 15px; border: 1px solid #000; display: inline-block; margin-right: 5px; vertical-align: middle; }
    </style>
</head>
<body>

<div class="container">
    <table class="header-table">
        <tr>
            <td style="width: 40%;">
                ROYAUME DU MAROC<br>
                MINISTÈRE DE LA JUSTICE<br>
                Cour d'Appel de : <strong>{{ $tribunal_city ?? '............' }}</strong><br>
                Tribunal de Première Instance : <strong>Sidi Bennour</strong>
            </td>
            <td style="text-align: right;">
                Dossier N° : <strong>{{ $certificat->dossier_num ?? '2023/1401/295' }}</strong><br>
                Chambre : <strong>{{ $certificat->chambre ?? '............' }}</strong><br>
                Audience du : <strong>{{ $certificat->date_audience ?? '..../..../....' }}</strong>
            </td>
        </tr>
    </table>

    <div class="title">ACTE DE NOTIFICATION</div>

    <div class="content">
        <p>Le Chef du Secrétariat-Greffe du Tribunal de Première Instance de Sidi Bennour,</p>
        <p>Demande à l'agent de notification de remettre le pli ci-joint à :</p>
        
        <p><strong>Destinataire :</strong> <span class="dotted" style="min-width: 300px;">{{ $certificat->destinataire_name }}</span></p>
        <p><strong>Adresse :</strong> <span class="dotted" style="min-width: 400px;">{{ $certificat->adresse }}</span></p>
        
        <p>Objet : <span class="dotted">Convocation à l'audience / Notification de jugement</span></p>
    </div>

    <table class="delivery-table">
        <tr>
            <td colspan="2" style="background: #f2f2f2; font-weight: bold; text-align: center;">PROCÈS-VERBAL DE REMISE</td>
        </tr>
        <tr>
            <td style="width: 50%;">
                Je soussigné, agent de notification, certifie avoir remis le pli le :<br>
                Date : ........................... à : ......... h .........
            </td>
            <td>
                Le pli a été remis à :<br>
                <div style="margin-top: 10px;">
                    <span class="checkbox"></span> Personne concernée<br>
                    <span class="checkbox"></span> Membre de la famille / Voisin<br>
                    <span class="checkbox"></span> Refus de recevoir
                </div>
            </td>
        </tr>
        <tr>
            <td style="height: 100px;">Nom et Signature du Réceptionnaire :</td>
            <td style="height: 100px;">Signature de l'Agent :</td>
        </tr>
    </table>

    <div style="margin-top: 40px;">
        Fait à Sidi Bennour, le : <strong>{{ date('d/m/Y') }}</strong>
    </div>
</div>

</body>
</html>