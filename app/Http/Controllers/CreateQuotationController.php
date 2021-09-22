<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuotationSODetail;
use App\Models\QuotationMSDetail;
use App\Models\QuotationMMSDetail;
use App\Models\Quotation;
use App\Models\QuotationType;
use Auth;
use DB;

class CreateQuotationController extends Controller
{
    public function index()
    {
        $types = QuotationType::all();

        return view('pages.create', compact('types'));
    }

    public function store(Request $request)
    {
        

        if($request->type === '1')
        {
            QuotationSODetail::create([
                'quotation_created_date' => $request->date
            ]);

            $quotation_type_id = DB::table('quotation_s_o_details')->orderBy('id', 'DESC')->first();

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

        

        return redirect('/quotation')->with('success', 'Quotation has been added');
        
    }
}
