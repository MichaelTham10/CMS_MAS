<?php

namespace App\Http\Controllers\PO_Out_Item;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOutItem;
use Illuminate\Http\Request;

class PurchaseOutItemController extends Controller
{
    public function index($id)
    {
        return view('pages.po_out.item.create-item-po_out', compact('id'));
    }
    public function list($po_out_id)
    {
        $query = PurchaseOutItem::where('po_out_id', $po_out_id)->get();
        
        return datatables($query)
        ->addIndexColumn()
        ->addColumn('Total Price', function($row){
            return $row->qty*$row['price'];
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
                    <a class="dropdown-item" href="/edit/po_out_item/'.$row->po_out_id.'/'.$row->id.'">Edit</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete'.$row->id.'" href="#">Delete</a>
                </div>
            </div>

            
            <form action="/delete/po_out_item/'.$row->id.'" method="POST">
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
                                <p class="text-muted">If you remove this item it will be gone forever. <br>Are you sure you want to continue?</p>
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
    public function create($po_out_id,Request $request)
    {
        $request->validate([
            'item_description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        PurchaseOutItem::create([
            'po_out_id' => $po_out_id,
            'item_description' => $request->item_description,
            'price' => $request->price,
            'qty' => $request->quantity,
        ]);

        return redirect('/edit-po-out/'.$po_out_id)->with('success', 'item has been added');
    }

    public function edit_item($po_out_id, $id)
    {
        $item = PurchaseOutItem::findOrFail($id);
        return view('pages.po_out.item.edit-item-po_out', compact('po_out_id', 'item'));
    }

    public function update($po_out_id, $id, Request $request)
    {
        $request->validate([
            'item_description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        PurchaseOutItem::findOrFail($id)->update([
            'item_description' => $request->item_description,
            'price' => $request->price,
            'qty' => $request->quantity,
        ]);

        return redirect('/edit-po-out/'.$po_out_id,)->with('success', 'Item has been updated');

    }

    public function delete($id)
    {
        PurchaseOutItem::destroy($id);

        return back()->with('success', 'Item has been deleted');

    }
}
