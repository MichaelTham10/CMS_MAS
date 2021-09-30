<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\InvoiceType;
use Illuminate\Support\Facades\DB;
use App\Models\invoice\InvoiceTypeDetail;
use App\Models\Quotation;

class CreateInvoiceController extends Controller
{
    public function index()
    {
        $types = InvoiceType::all();
        $quotations = Quotation::all();

        return view('pages.create-invoice', compact('types', 'quotations'));
    }   

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'date' => 'required',
            'quotationNo' => 'required',
            'billTo' => 'required',
            'note' => 'required',
        ]);

        $this->temp = 0;

        $ivcs = InvoiceTypeDetail::all();

        foreach($ivcs as $ivc)
        {
            if($ivc->invoice_date == $request->date && $ivc->type_id == $request->type)
            {   
                $this->temp = 1;
                InvoiceTypeDetail::findOrFail($ivc->id)->update([
                    'quantity' => ($ivc->quantity + 1),
                ]);

                $detail = InvoiceTypeDetail::findOrFail($ivc->id);

                Invoice::create([
                    'type_id' => $request->type,
                    'type_detail_id' => $detail->id,
                    'Invoice No' => Invoice::getFormatId($request->type, $detail->quantity, $request->date),
                    'type_detail_quantity' => $detail->quantity,
                    'Address' => $request->address,
                    'Invoice Date' => $request->date,
                    'Quotation No' => $request->quotationNo,
                    'Bill To' => $request->billTo,
                    'Note' => $request->note
                ]);
                break;
            }
            
        }

        if($this->temp == 0)
        {
            InvoiceTypeDetail::create([
                'type_id' => $request->type,
                'invoice_date' => $request->date,
            ]);

            $type_detail = DB::table('invoice_type_details')->orderBy('id', 'DESC')->first();

            Invoice::create([
                'type_id' => $request->type,
                'type_detail_id' => $type_detail->id,
                'Invoice No' => Invoice::getFormatId($request->type, $type_detail->quantity, $request->date),
                'type_detail_quantity' => $type_detail->quantity,
                'Address' => $request->address,
                'Invoice Date' => $request->date,
                'Quotation No' => $request->quotationNo,
                'Bill To' => $request->billTo,
                'Note' => $request->note
            ]);
        }

        return redirect('/invoice')->with('success', 'Invoice has been added');   
    }
}
