<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\Invoice;
use App\Models\InvoicePO;
use App\Models\PurchaseOrderOut;
use Barryvdh\DomPDF\Facade as PDF;
class ExportPDFController extends Controller
{
    public function pdf($id)
    {
        
        $quotation = Quotation::findOrFail($id);
        
        $data = [
                
                'quotation' => $quotation 
                ];
        $file = 'Quotation_of_Network_Devices_for_PT_'.$quotation->Customer.'.pdf';
        $pdf = PDF::loadView('pages.pdf', $data)->setPaper('a4', 'potrait')->setWarnings(false);
        return $pdf->stream($file);
    }
    public function pdf_invoice($id)
    {
        
        $invoice = Invoice::findOrFail($id);
        $invoice_dps = Invoice::with('quotation')->where('payment_status', 'LIKE', 'Down Payment')->get();
        
        $data = [
                    'invoice' => $invoice, 
                    'invoice_dps' => $invoice_dps
                ];
        $file = 'Invoice_of_Network_Devices_for_PT_'.$invoice->Customer.'.pdf';
        $pdf = PDF::loadView('pages.pdf-invoice', $data)->setPaper('a4', 'potrait')->setWarnings(false);
        return $pdf->stream($file);
    }

    public function pdf_invoice_po($id)
    {
        $invoice = InvoicePO::findOrFail($id);
        $invoice_dps = InvoicePO::with('poin')->where('payment_status', 'LIKE', 'Down Payment')->get();
        
        $data = [
                    'invoice' => $invoice,
                    'invoice_dps' => $invoice_dps
                ];
        $file = 'Invoice_of_Network_Devices_for_PT_'.$invoice->Customer.'.pdf';
        $pdf = PDF::loadView('pages.pdf-invoice-po', $data)->setPaper('a4', 'potrait')->setWarnings(false);
        return $pdf->stream($file);
    }

    public function pdf_invoice_po_out($id)
    {
        $po_out = PurchaseOrderOut::findOrFail($id);
        
        $data = [
                    'po_out' => $po_out 
                ];
        $file = 'Purchase_Out_of_Network_Devices_for_PT_'.$po_out->to.'.pdf';
        $pdf = PDF::loadView('pages.pdf-invoice-po_out', $data)->setPaper('a4', 'potrait')->setWarnings(false);
        return $pdf->stream($file);
    }
}
