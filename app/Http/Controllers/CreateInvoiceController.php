<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateInvoiceController extends Controller
{
    public function index()
    {
        return view('pages.create-invoice');
    }    
}
