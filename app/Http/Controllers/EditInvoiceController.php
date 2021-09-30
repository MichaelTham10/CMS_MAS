<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceType;
use App\Models\Invoice;
use App\Models\invoice\InvoiceTypeDetail;
use Illuminate\Support\Facades\DB;

class EditInvoiceController extends Controller
{
    public function editpage($id)
    {
        $invoice = Invoice::findOrFail($id);
        $type = InvoiceType::findOrFail($invoice->type_id);
        return view('pages.edit-invoice', compact('invoice', 'type'));
    }

    public function delete($invoice_id)
    {
        Invoice::destroy($invoice_id);

        return back()->with('success', 'Invoice has been deleted');
    }

    public function update($invoice_id, Request $request)
    {
        
        $invoice = Invoice::findOrFail($invoice_id);
        $type = InvoiceType::findOrFail($invoice->type_id);
        $itds = InvoiceTypeDetail::all();
        if($invoice['Invoice Date'] != $request->date)
        {
            $itd = InvoiceTypeDetail::findOrFail($invoice->type_detail_id);
            InvoiceTypeDetail::findOrFail($invoice->type_detail_id)->update([
                'quantity' => ($itd->quantity - 1),
            ]);

            $temp = InvoiceTypeDetail::findOrFail($invoice->type_detail_id);

            foreach($itds as $invoice_detail)
            {  
                if($invoice_detail->invoice_date == $request->date && $invoice_detail->type_id == $invoice->type_id)
                {
                    InvoiceTypeDetail::findOrFail($invoice_detail->id)->update([
                        'quantity' => ($invoice_detail->quantity + 1),
                    ]);

                    $detail = InvoiceTypeDetail::findOrFail($invoice_detail->id);

                    $invoice->update([
                        'type_detail_id' =>$detail->id,
                        'Invoice No' => Invoice::getFormatId($type->id, $detail->quantity, $request->date),
                        'type_detail_quantity' => $detail->quantity,
                        'Address' => $request->address,
                        'Invoice Date' => $request->date,
                        'Bill To' => $request->billTo,
                        'Note' => $request->note                  
                    ]);

                    if($temp->quantity == 0){
                        InvoiceTypeDetail::destroy($temp->id);
                    }

                    return back()->with('success', 'Invoice has been updated');
                }
            }
           
            InvoiceTypeDetail::create([
                'type_id' => $invoice->type_id,
                'invoice_date' => $request->date,
            ]);

            $type_detail = DB::table('invoice_type_details')->orderBy('id', 'DESC')->first();

            $invoice->update([  
                'type_detail_id' =>$type_detail->id,
                'Invoice No' => Invoice::getFormatId($type->id, $type_detail->quantity, $request->date),
                'type_detail_quantity' => $type_detail->quantity,
                'Address' => $request->address,
                'Invoice Date' => $request->date,
                'Bill To' => $request->billTo,
                'Note' => $request->note    
            ]);

            if($temp->quantity == 0){
                InvoiceTypeDetail::destroy($temp->id);
            }

            return back()->with('success', 'Invoice has been updated');
        }
        
        $invoice->update([
            'Address' => $request->address,
            'Invoice Date' => $request->date,
            'Bill To' => $request->billTo,
            'Note' => $request->note  
        ]);

        return back()->with('success', 'Invoice has been updated');
    }
}
