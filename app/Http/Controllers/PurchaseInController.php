<?php

namespace App\Http\Controllers;

use App\Models\PurchaseIn;
use Illuminate\Http\Request;

class PurchaseInController extends Controller
{
    //
    public function index_update()
    {
        $purchaseIn = PurchaseIn::all();
        return view('pages.po_in.po_in', compact('purchaseIn'));
    }

    public function edit($id)
    {
        $purchaseIn = PurchaseIn::findOrFail($id);
        return view('pages.po_in.po_in', compact('purchaseIn'));
    }

    public function update(Request $request, $id)
    {
        
        PurchaseIn::findOrFail($id)->update([
            'attention' => $request->attention,
            'customer_number' => $request->customer_number,
            'company_name' => $request->company_name,
            'date' => $request->date,
        ]);

        return back();
    }
}
