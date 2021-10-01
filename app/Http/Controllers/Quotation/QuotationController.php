<?php

namespace App\Http\Controllers\Quotation;

use App\Http\Controllers\Controller;

use App\Models\Quotation;
use App\Models\QuotationType;
use App\Models\Item;
use App\Models\quotation\QuotationTypeDetail;
use App\Models\Invoice;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    public function index(Request $request = null)
    {
        $items = Item::all();

        if($request == null)
        {
            $quotations =  Quotation::take(5)->get();
        }
        else{
            
            $quotations = Quotation::take((int)$request->show)->get();
        }


        return view('pages.quotation.quotation', compact('quotations', 'items'));
    }

    public $temp;

    public function create()
    {
        $types = QuotationType::all();

        return view('pages.quotation.create-quotation', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer' => 'required',
            'attention' => 'required',
            'payment' => 'required',
            'date' => 'required',
            'discount' => 'required',
            'account' => 'required',
            'terms' => 'required',
        ]);

        $this->temp = 0;

        $qtds = QuotationTypeDetail::all();

        foreach($qtds as $qtd)
        {
            if($qtd->quotation_date == $request->date && $qtd->type_id == $request->type)
            {   
                $this->temp = 1;
                QuotationTypeDetail::findOrFail($qtd->id)->update([
                    'quantity' => ($qtd->quantity + 1),
                ]);

                $detail = QuotationTypeDetail::findOrFail($qtd->id);

                Quotation::create([
                    'type_id' => $request->type,
                    'type_detail_id' => $detail->id,
                    'Quotation_No' => Quotation::getFormatId($request->type, $detail->quantity, $request->date),
                    'type_detail_quantity' => $detail->quantity,
                    'Customer' => $request->customer,
                    'Attention' => $request->attention,
                    'Payment Term' => $request->payment,
                    'Quotation Date' => $request->date,
                    'Account Manager' => $request->account,
                    'Discount' => $request->discount,
                    'Terms' => $request->terms
                ]);
                break;
            }
            
        }

        if($this->temp == 0)
        {
            QuotationTypeDetail::create([
                'type_id' => $request->type,
                'quotation_date' => $request->date,
            ]);

            $type_detail = DB::table('quotation_type_details')->orderBy('id', 'DESC')->first();

            Quotation::create([
                'type_id' => $request->type,
                'type_detail_id' =>$type_detail->id,
                'Quotation_No' => Quotation::getFormatId($request->type, $type_detail->quantity, $request->date),
                'type_detail_quantity' => $type_detail->quantity,
                'Customer' => $request->customer,
                'Attention' => $request->attention,
                'Payment Term' => $request->payment,
                'Quotation Date' => $request->date,
                'Account Manager' => $request->account,
                'Discount' => $request->discount,
                'Terms' => $request->terms
            ]);
        }
        
        return redirect('/quotation')->with('success', 'Quotation has been added');
        
    }

    public function editpage($id)
    {
        $quotation = Quotation::findOrFail($id);
        $type = QuotationType::findOrFail($quotation->type_id);
        $items = Item::where('quotation_id', $quotation->id)->get(); 
        return view('pages.quotation.editquotation', compact('quotation', 'type', 'items'));
    }

    public function delete($quotation_id)
    {
        $ivcs = Invoice::where('Quotation No', $quotation_id)->get();
        Invoice::destroy($ivcs);

        $items = Item::where('quotation_id', $quotation_id)->get();
        Item::destroy($items);

        Quotation::destroy($quotation_id);
       
        return back()->with('success', 'Quotation has been deleted');
    }

    public function update($quotation_id, Request $request)
    {  
        $quotation = Quotation::findOrFail($quotation_id);
        $type = QuotationType::findOrFail($quotation->type_id);
        $qtds = QuotationTypeDetail::all();
        if($quotation['Quotation Date'] != $request->date)
        {
            $qtd = QuotationTypeDetail::findOrFail($quotation->type_detail_id);

            QuotationTypeDetail::findOrFail($quotation->type_detail_id)->update([
                'quantity' => ($qtd->quantity - 1),
            ]);

            $temp = QuotationTypeDetail::findOrFail($quotation->type_detail_id);

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
                        'Quotation_No' => Quotation::getFormatId($type->id, $detail->quantity, $request->date),
                        'type_detail_quantity' => $detail->quantity,
                        'Customer' => $request->customer,
                        'Attention' => $request->attention,
                        'Payment Term' => $request->payment,
                        'Quotation Date' => $request->date,
                        'Account Manager' => $request->account,
                        'Discount' => $request->discount,
                        'Terms' => $request->terms
                    ]);

                    if($temp->quantity == 0){
                        QuotationTypeDetail::destroy($temp->id);
                    }

                    return back()->with('success', 'Quotation has been updated');
                }
            }
           
            QuotationTypeDetail::create([
                'type_id' => $quotation->type_id,
                'quotation_date' => $request->date,
            ]);

            $type_detail = DB::table('quotation_type_details')->orderBy('id', 'DESC')->first();

            $quotation->update([
                'type_detail_id' => $type_detail->id,
                'Quotation_No' => Quotation::getFormatId($type->id, $type_detail->quantity, $request->date),
                'type_detail_quantity' => $type_detail->quantity,
                'Customer' => $request->customer,
                'Attention' => $request->attention,
                'Payment Term' => $request->payment,
                'Quotation Date' => $request->date,
                'Account Manager' => $request->account,
                'Discount' => $request->discount,
                'Terms' => $request->terms
            ]);

            if($temp->quantity == 0){
                QuotationTypeDetail::destroy($temp->id);
            }

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
