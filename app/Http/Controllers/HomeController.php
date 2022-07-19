<?php

namespace App\Http\Controllers;
use App\Models\Quotation;
use App\Models\Invoice;

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
        $invoices = Invoice::all();
        
        return view('dashboard', compact('quotations', 'invoices'));
    }

    public function unauthorized(){
        return view('error-page.401');
    }
}
