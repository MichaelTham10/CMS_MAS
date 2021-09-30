<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Quotation;

class InvoiceController extends Controller
{
    public function index(Request $request = null)
    {
        $items = Item::all();
        $quotations = Quotation::all();
        if($request == null)
        {
            $invoices =  Invoice::take(5)->get();
        }
        else{
            
            $invoices = Invoice::take((int)$request->show)->get();
        }


        return view('pages.invoice', compact('invoices', 'items', 'quotations'));
    }
}
