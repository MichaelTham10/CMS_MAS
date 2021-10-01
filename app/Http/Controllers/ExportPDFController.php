<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\Item;
use PDF;
class ExportPDFController extends Controller
{
    public function pdf($id)
    {
        
        $quotation = Quotation::findOrFail($id);
        $items = Item::all();
        $data = [
                'items' => $items ,
                'quotation' => $quotation 
                ];
        $file = 'Quotation_of_Network_Devices_for_PT_'.$quotation->Customer;
        $pdf = PDF::loadView('pages.pdf', $data)->setPaper('a4', 'potrait')->setWarnings(false);
        return $pdf->stream($file);
    }
}
