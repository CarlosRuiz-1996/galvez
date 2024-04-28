<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ExportPDFController extends Controller
{
    public function OrderPDF(Order $order)
    {

        $pdf = Pdf::loadView('exports_templates.order-pdf', compact('order'));

        // dd($pdf);
        return $pdf->stream('orden_compra.pdf');

        //para mostrar en un modal el pdf
        // $pdfData = $pdf->output();
        // $pdfBase64 = base64_encode($pdfData);
        // $this->dispatch('pdfGenerated', $pdfBase64);
    }
}
