<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;

class QuotationController extends Controller
{
    public function index(Request $request = null)
    {
        
        if($request == null)
        {
            $quotations =  Quotation::take(5)->get();
        }
        else{
            
            $quotations = Quotation::take((int)$request->show)->get();
        }


        return view('pages.quotation', compact('quotations'));
    }
}
