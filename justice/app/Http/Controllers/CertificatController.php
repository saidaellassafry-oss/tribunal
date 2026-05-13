<?php

namespace App\Http\Controllers;

use App\Models\Certificat;
use App\Models\Demande;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CertificatController extends Controller
{
    /* =========================
       📄 LIST CERTIFICATS
    ========================= */
    public function index()
    {
        $certificats = Certificat::with('user', 'demande')
            ->latest()
            ->get();

        return view('certificats.index', compact('certificats'));
    }

    /* =========================
       🖨 GENERATE / VIEW PDF (DYNAMIQUE)
    ========================= */
    public function pdf($id)
    {
        $certificat = Certificat::with('user', 'demande')->findOrFail($id);

        // المنطق لاختيار الملف المناسب بناءً على النوع
        $viewPath = 'pdf.certificat'; // الملف الافتراضي

        if ($certificat->type == 'constatation') {
            $viewPath = 'pdf.certificat'; // أو ملف خاص بالمعاينة
        } elseif ($certificat->type == 'notification') {
            $viewPath = 'pdf.acte_notification'; // الملف اللي فيه جدول التبليغ
        } elseif ($certificat->type == 'greffe') {
            $viewPath = 'pdf.certificat_greffe'; // الملف اللي فيه "بين وضد"
        } else {
            $viewPath = 'pdf.certificat_standard'; // للطلبات الأخرى "Autres"
        }

        $pdf = Pdf::loadView($viewPath, [
                'certificat' => $certificat
            ])
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont' => 'DejaVu Sans',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true
            ]);

        return $pdf->stream('certificat-'.$certificat->cert_number.'.pdf');
    }

    /* =========================
       ✅ ACCEPT DEMANDE + CREATE CERTIFICAT
    ========================= */
    public function accept($id)
    {
        $demande = Demande::findOrFail($id);

        // تغيير الحالة
        $demande->status = 'accepté';
        $demande->save();

        // تفادي التكرار وإنشاء الشهادة
        $certificat = Certificat::firstOrCreate(
            ['demande_id' => $demande->id],
            [
                'user_id' => $demande->user_id,
                'type' => $demande->type,
                'cert_number' => 'CERT-'.date('Y').'-'.str_pad($demande->id, 5, '0', STR_PAD_LEFT)
            ]
        );

        // هنا كنطبقو نفس منطق اختيار الـ View باش يتسيفا الـ PDF الصحيح
        $viewPath = $this->getTemplatePath($certificat->type);

        $pdf = Pdf::loadView($viewPath, [
            'certificat' => $certificat
        ]);

        // حفظ الملف
        $path = 'certificats/'.$certificat->id.'.pdf';
        Storage::disk('public')->put($path, $pdf->output());

        $certificat->pdf_path = $path;
        $certificat->save();

        return back()->with('success', 'Certificat créé avec succès selon le modèle : ' . $certificat->type);
    }

    /* حيلة برمجية (Helper) باش ما نعاودوش الـ Switch بزاف المرات */
    private function getTemplatePath($type)
    {
        return match ($type) {
            'constatation' => 'pdf.certificat',
            'notification' => 'pdf.acte_notification',
            'greffe'       => 'pdf.certificat_greffe',
            'non_recours'  => 'pdf.certificat_non_recours',   // شهادة بعدم التعرض (الجديدة)
            default        => 'pdf.certificat_standard',
        };
    }
}