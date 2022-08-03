<?php

namespace App\Http\Controllers;
use App\Models\Quotation;
use App\Models\Invoice;
use App\Models\InvoicePO;
use App\Models\PurchaseOrderIn;
use App\Models\PurchaseOrderOut;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $quotations = Quotation::all();   
        $invoices = Invoice::with('quotation')->where('payment_status', 'LIKE', 'Full Payment')->get();
        $po_outs = PurchaseOrderOut::all();
        $po_ins = PurchaseOrderIn::all();
        $invoice_pos = InvoicePO::with('poin')->where('payment_status', 'LIKE', 'Full Payment')->get();
        return view('dashboard', compact('quotations', 'invoices', 'po_outs', 'po_ins', 'invoice_pos'));
    }

    public function unauthorized(){
        return view('error-page.401');
    }
}
