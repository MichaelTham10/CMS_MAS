<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\QuotationType;
use App\Models\Item;
class EditQuotationController extends Controller
{
    public function editpage($id)
    {
        
        $quotation = Quotation::findOrFail($id);
        $type = QuotationType::findOrFail($quotation->type_id);
        $items = Item::where('quotation_id', $quotation->id)->get(); 
        return view('pages.editquotation', compact('quotation', 'type', 'items'));
    }
}
