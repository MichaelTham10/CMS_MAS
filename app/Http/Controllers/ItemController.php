<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;


class ItemController extends Controller
{
    public function index($id)
    {

        return view('pages.item.create-item', compact('id'));
    }


    public function create($quotation_id,Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
        ]);

        Item::create([
            'quotation_id' => $quotation_id,
            'name' => $request->name,
            'unit price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect('/editquotation/'.$quotation_id)->with('success', 'item has been added');
    }

    public function edit_item($quotation_id, $id)
    {
        $item = Item::findOrFail($id);
        return view('pages.item.edit-items', compact('quotation_id', 'item'));
    }

    public function update($quotation_id,$id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
        ]);

        Item::findOrFail($id)->update([
            'name' => $request->name,
            'unit price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect('/editquotation/'.$quotation_id)->with('success', 'item has been updated');

    }

    public function delete($id)
    {
        Item::destroy($id);

        return back()->with('success', 'item has been deleted');

    }
}
