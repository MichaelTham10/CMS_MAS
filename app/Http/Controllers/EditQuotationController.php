<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\QuotationType;
use App\Models\quotation\QuotationTypeDetail;
use App\Models\Item;
use DB;
class EditQuotationController extends Controller
{
    public function editpage($id)
    {
        
        $quotation = Quotation::findOrFail($id);
        $type = QuotationType::findOrFail($quotation->type_id);
        $items = Item::where('quotation_id', $quotation->id)->get(); 
        return view('pages.editquotation', compact('quotation', 'type', 'items'));
    }

    public function delete($quotation_id)
    {
        Quotation::destroy($quotation_id);

        return back()->with('success', 'Quotation has been deleted');
    }

    public function update($quotation_id, Request $request)
    {
        
        $quotation = Quotation::findOrFail($quotation_id);
        $qtds = QuotationTypeDetail::all();
        if($quotation['Quotation Date'] != $request->date)
        {
            $qtd = QuotationTypeDetail::findOrFail($quotation->type_detail_id);
            QuotationTypeDetail::findOrFail($quotation->type_detail_id)->update([
                'quantity' => ($qtd->quantity - 1),
            ]);
            foreach($qtds as $item)
            {  
                if($item->quotation_date == $request->date && $item->type_id == $quotation->type_id)
                {
                    QuotationTypeDetail::findOrFail($item->id)->update([
                        'quantity' => ($item->quantity + 1),
                    ]);

                    $detail = QuotationTypeDetail::findOrFail($item->id);

                    $quotation->update([
                        'type_detail_id' =>$detail->id,
                        'type_detail_quantity' => $detail->quantity,
                        'Customer' => $request->customer,
                        'Attention' => $request->attention,
                        'Payment Term' => $request->payment,
                        'Quotation Date' => $request->date,
                        'Account Manager' => $request->account,
                        'Discount' => $request->discount,
                        'Terms' => $request->terms
                    ]);

                    return back()->with('success', 'Quotation has been updated');
                }
            }
           
            QuotationTypeDetail::create([
                'type_id' => $quotation->type_id,
                'quotation_date' => $request->date,
            ]);

            $type_detail = DB::table('quotation_type_details')->orderBy('id', 'DESC')->first();

            $quotation->update([
                
                'type_detail_id' =>$type_detail->id,
                'type_detail_quantity' => $type_detail->quantity,
                'Customer' => $request->customer,
                'Attention' => $request->attention,
                'Payment Term' => $request->payment,
                'Quotation Date' => $request->date,
                'Account Manager' => $request->account,
                'Discount' => $request->discount,
                'Terms' => $request->terms
            ]);

            return back()->with('success', 'Quotation has been updated');
        }

        $quotation->update([
                
            'Customer' => $request->customer,
            'Attention' => $request->attention,
            'Payment Term' => $request->payment,
            'Account Manager' => $request->account,
            'Discount' => $request->discount,
            'Terms' => $request->terms
        ]);

        return back()->with('success', 'Quotation has been updated');
    }
}
