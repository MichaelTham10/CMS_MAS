<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuotationEditCreateController extends Controller
{
    public function index()
    {
        return view('pages.quotation-edit-create');
    }

    public function edit_item()
    {
        return view('pages.edit-items');
    }
}
