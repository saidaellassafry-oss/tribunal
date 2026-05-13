<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <style>
        @page { size: A4; margin: 10mm; }
        body { 
            font-family: 'Times New Roman', Times, serif; 
            direction: rtl; /* Pour l'arabe */
            background-color: #f4f4f4;
            padding: 20px;
        }
        .a4-page {
            background: white;
            width: 210mm;
            min-height: 297mm;
            margin: auto;
            display: flex;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            box-sizing: border-box;
        }
        /* Colonne de Droite (Références) */
        .sidebar {
            width: 30%;
            border-left: 1px solid #000;
            padding-left: 15px;
            display: flex;
            flex-direction: column;
            font-size: 14px;
        }
        /* Contenu de Gauche (Texte) */
        .main-content {
            width: 70%;
            padding-right: 25px;
        }
        .header-info { text-align: center; font-weight: bold; line-height: 1.8; }
        .title { 
            text-align: center; 
            font-size: 19px; 
            font-weight: bold; 
            text-decoration: underline; 
            margin: 40px 0; 
        }
        .field-row { margin-bottom: 20px; line-height: 2; text-align: justify; }
        .dotted { 
            border-bottom: 1px dotted #000; 
            display: inline-block; 
            min-width: 150px; 
            padding: 0 10px;
            font-weight: bold;
        }
        .sidebar-field { margin-bottom: 30px; }
        .footer {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
        }
        @media print {
            body { background: none; padding: 0; }
            .a4-page { box-shadow: none; border: none; }
        }
    </style>
</head>
<body>

<div class="a4-page">
    
    <div class="sidebar">
        <div class="header-info">
            المملكة المغربية<br>
            وزارة العدل<br>
            محكمة الاستئناف بـ : ......<br>
            المحكمة الابتدائية بـ سيدي بنور
        </div>

        <div style="margin-top: 60px;">
            <div class="sidebar-field">ملف : <span class="dotted">#30</span></div>
            <div class="sidebar-field">عدد : <span class="dotted">CERT-2026-00030</span></div>
            <div class="sidebar-field">المستدعي : <span class="dotted">asmae</span></div>
            <div class="sidebar-field">المستدعى ضده : <span class="dotted">..........</span></div>
        </div>

        <div style="margin-top: auto; font-size: 11px;">
            (1) التعرض أو الاستئناف أو النقض<br>
            نموذج رقم 30186
        </div>
    </div>

    <div class="main-content">
        <div class="title">شهادة بعدم التعرض (1) والاستئناف أو النقض</div>

        <div class="field-row">
            يشهد رئيس كتابة الضبط بالمحكمة المذكورة أعلاه.
            <br>الموقع أسفله.
        </div>

        <div class="field-row">
            بمقتضاه أنه بعد مراجعة سجلات كتابة الضبط بهذه المحكمة وملف القضية، يتبين أن الحكم الصادر عن هذه المحكمة بتاريخ <span class="dotted">25/04/2026</span> تحت رقم <span class="dotted">#30</span> في النزاع القائم بين :
            <br><br>
            السيد(ة) : <span class="dotted">asmae</span>
            <br>
            وبين : <span class="dotted">asmae@gmail.com</span>
        </div>

        <div class="field-row">
            <strong>لم يقع فيه أي طعن بالتعرض أو الاستئناف</strong> إلى غاية يومه <span class="dotted">25/04/2026</span>.
        </div>

        <div class="field-row">
            وبناء عليه سلمت هذه الشهادة للمعني(ة) بالأمر للإدلاء بها عند الحاجة.
        </div>

        <div class="footer">
            <div>حرر بـ سيدي بنور في : <strong>25/04/2026</strong></div>
            <div style="text-align: center;">
                <strong>رئيس كتابة الضبط</strong><br>
                (توقيع وخاتم المحكمة)
            </div>
        </div>
    </div>

</div>

</body>
</html>