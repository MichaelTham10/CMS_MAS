<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditQuotationController extends Controller
{
    public function editpage()
    {
        return view('pages.editquotation');
    }
}
