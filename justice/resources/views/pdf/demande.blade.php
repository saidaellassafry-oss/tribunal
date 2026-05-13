<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="utf-8">
<title>Document Officiel</title>

<style>
@page { margin: 2cm; }

body{
    font-family: DejaVu Sans, sans-serif;
    font-size: 14px;
    color:#000;
    direction: rtl;
    text-align: right;
    unicode-bidi: bidi-override;
}

.header{
    text-align:center;
    border-bottom:2px solid #000;
    padding-bottom:10px;
    margin-bottom:15px;
}

.title{
    text-align:center;
    font-size:18px;
    font-weight:bold;
    margin:15px 0;
    text-decoration: underline;
}

.box{
    border:1px solid #000;
    padding:12px;
    margin-top:12px;
}

.row{
    margin:6px 0;
}

.status{
    font-weight:bold;
}

.footer{
    position: fixed;
    bottom:10px;
    width:100%;
    text-align:center;
    font-size:10px;
}
</style>

</head>

<body>

<div class="header">
المملكة المغربية - وزارة العدل - المحكمة الابتدائية
</div>

<div class="title">📄 وثيقة رسمية قضائية</div>

<div class="box">

<div class="row">
<b>رقم الملف:</b>
<span dir="rtl">{{ $demande->dossier_number }}</span>
</div>

<div class="row">
<b>الاسم الكامل:</b>
<span dir="rtl">{{ $demande->full_name }}</span>
</div>

<div class="row">
<b>رقم CIN:</b>
<span dir="rtl">{{ $demande->cin }}</span>
</div>

<div class="row">
<b>العنوان:</b>
<span dir="rtl">{{ $demande->address }} - {{ $demande->city }}</span>
</div>

</div>

<div class="box">

<div class="row">
<b>نوع الطلب:</b> {{ $demande->type }}
</div>

<div class="row">
<b>الوصف:</b><br>
{{ $demande->description }}
</div>

<div class="row">
<b>الحالة:</b>
<span class="status">{{ strtoupper($demande->status) }}</span>
</div>

</div>

<div class="box">

<b>📌 القرار:</b><br>

@if($demande->status == 'accepté')
✔ تمت الموافقة على الطلب
@elseif($demande->status == 'refusé')
✖ تم رفض الطلب
@else
⏳ قيد المعالجة من طرف المحكمة
@endif

</div>

<br><br>

<table width="100%">
<tr>
<td style="text-align:center;">
الموظف المسؤول<br><br>
___________
</td>

<td style="text-align:center;">
ختم المحكمة<br><br>
🏛
</td>

<td style="text-align:center;">
التاريخ<br><br>
{{ date('d/m/Y') }}
</td>
</tr>
</table>

<div class="footer">
Document généré automatiquement - {{ date('Y') }}
</div>

</body>
</html>