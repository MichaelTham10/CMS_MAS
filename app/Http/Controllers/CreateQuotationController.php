<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateQuotationController extends Controller
{
    public function index()
    {
        return view('pages.create');
    }
}
