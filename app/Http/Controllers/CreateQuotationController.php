<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\quotation\QuotationTypeDetail;
use App\Models\Quotation;
use App\Models\QuotationType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateQuotationController extends Controller
{
    public $temp;

    public function index()
    {
        $types = QuotationType::all();

        return view('pages.create', compact('types'));
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
        
       

        /*
        if($request->type === '1')
        {
            QuotationSODetail::create([
                'quotation_created_date' => $request->date
            ]);

            

            Quotation::create([
                'type_id' => 1,
                'type_detail_id' => $quotation_type_id->id,
                'Customer' => $request->customer,
                'Attention' => $request->attention,
                'Payment Term' => $request->payment,
                'Quotation Date' => $request->date,
                'Account Manager' => Auth::user()->id,
                'Discount' => $request->discount,
                'Terms' => $request->terms
            ]);
        }

        else if($request->type === '2')
        {
            QuotationMSDetail::create([
                'quotation_created_date' => $request->date
            ]);

            $quotation_type_id = DB::table('quotation_m_s_details')->orderBy('id', 'DESC')->first();

            Quotation::create([
                'type_id' => 2,
                'type_detail_id' => $quotation_type_id->id,
                'Customer' => $request->customer,
                'Attention' => $request->attention,
                'Payment Term' => $request->payment,
                'Quotation Date' => $request->date,
                'Account Manager' => Auth::user()->id,
                'Discount' => $request->discount,
                'Terms' => $request->terms
            ]);
        }

        else if($request->type === '3')
        {
            QuotationMMSDetail::create([
                'quotation_created_date' => $request->date
            ]);

            $quotation_type_id = DB::table('quotation_m_m_s_details')->orderBy('id', 'DESC')->first();

            Quotation::create([
                'type_id' => 3,
                'type_detail_id' => $quotation_type_id->id,
                'Customer' => $request->customer,
                'Attention' => $request->attention,
                'Payment Term' => $request->payment,
                'Quotation Date' => $request->date,
                'Account Manager' => Auth::user()->id,
                'Discount' => $request->discount,
                'Terms' => $request->terms
            ]);
        }
        */
        

        return redirect('/quotation')->with('success', 'Quotation has been added');
        
    }
}
