<?php

namespace App\Http\Controllers;

use App\Models\PurchaseIn;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class PurchaseInController extends Controller
{
    //

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

    public function index_create()
    {
        return view('pages.po_in.create-purchase');
    }

    public function create(Request $request)
    {
        PurchaseIn::create([
            'attention' => $request->attention,
            'customer_number' => $request->customer_number,
            'company_name' => $request->company_name,
            'date' => Carbon::now()
        ]);
        return back();
    }

    public function delete($id)
    {
        PurchaseIn::destroy($id);
        return back();
    }
}
