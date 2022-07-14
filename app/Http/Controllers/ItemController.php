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

    public function list($quotation_id)
    {
        $query = Item::where('quotation_id', $quotation_id)->get();
        
        return datatables($query)
        ->addIndexColumn()
        ->addColumn('Total Price', function($row){
            return $row->quantity*$row['unit price'];
        })
        ->addColumn('action', function($row){
           
            $actionBtn = 
            '<td>
            <div class="btn-group">
              
              <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
                Options
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="/edit-items/'.$row->quotation_id.'/'.$row->id.'">Edit</a>
                <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete'.$row->id.'" href="#">Delete</a>
                <a class="dropdown-item" href="/quotation/item/export-pdf/'.$row->id.'" target="_blank">Export PDF</a>
              </div>
            </div>

            
            <form action="/delete/item/'.$row->id.'" method="POST">
            
              '.csrf_field().'
              '.method_field('DELETE').'
              <div class="modal fade" id="ModalDelete'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="container d-flex pl-0"><img src="">
                                <h3 class="modal-title ml-2" id="exampleModalLabel">Delete this item?</h3>
                            </div> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-muted">If you remove this item it will be gone forever. Are you sure you want to continue?</p>
                        </div>
                        <div class="modal-footer"> 
                           <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                           <button type="submit" class="btn btn-danger">Delete</button> 
                        </div>
                    </div>
                </div>
              </div>
            </form>
            
          </td>
            ';
            return $actionBtn;
        })
        ->escapeColumns(null)
        ->make(true);

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
