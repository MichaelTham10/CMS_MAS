<?php

namespace App\Http\Controllers;

use App\Models\ItemPurchaseIn;
use App\Models\PurchaseOrderIn;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseInController extends Controller
{
    //
    public function show()
    {
        $po_in = PurchaseOrderIn::all();
        $po_in_items = ItemPurchaseIn::all();
        return view('pages.po_in.po_in', compact('po_in', 'po_in_items'));
    }

    public function index_update()
    {
        $purchaseIn = PurchaseOrderIn::all();
        return view('pages.po_in.edit_po_in', compact('purchaseIn'));
    }

    public function edit($id)
    {
        $purchaseIn = PurchaseOrderIn::findOrFail($id);
        return view('pages.po_in.edit_po_in', compact('purchaseIn'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_number' => 'required',
            'customer_name' => 'required',  
        ]);
        // $request = request();
        $file = $request->file('file');
        if($file != null)
        {
            $name = $file->getClientOriginalName();
            $filename = $name;
            $file->move('pdf/', $filename);

            PurchaseOrderIn::findOrFail($id)->update([
                'customer_number' => $request->customer_number,
                'customer_name' => $request->customer_name,
                'file' => $filename,
            ]);
        }
        else{
            PurchaseOrderIn::findOrFail($id)->update([
                'customer_number' => $request->customer_number,
                'customer_name' => $request->customer_name,
            ]);
        }

        $po_in = PurchaseOrderIn::all();
        return redirect('/po_in')->with(['po_in' => $po_in]);
    }

    public function index_create()
    {
        return view('pages.po_in.create-purchase');
    }

    public function create(Request $request)
    {
        $request->validate([
            'customer_number' => 'required|unique:purchase_order_ins',
            'customer_name' => 'required',  
            'file' => 'required',
        ]);

        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $filename = $name;
        $file->move('pdf/', $filename);
        PurchaseOrderIn::create([
            'customer_number' => $request->customer_number,
            'customer_name' => $request->customer_name,
            'file' => $filename
        ]);

        $po_in = PurchaseOrderIn::all();
        return redirect('/po_in')->with(['po_in' => $po_in]);
    }

    public function delete($id)
    {
        PurchaseOrderIn::destroy($id);
        $po_in = PurchaseOrderIn::all();
        return back()->with('success', 'Purchase in has been deleted');
    }

    public function list()
    {
        $query = PurchaseOrderIn::all();
        
        return datatables($query)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            
            $actionBtn = 
            '<td>
                <div class="btn-group">
                <a href=""  class="btn btn-primary btn-sm" id="submit" data-toggle="modal" data-target="#modalDetail">Detail</a>
                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="/edit_po_in/'.$row->id.'">Edit</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete'.$row->id.'" href="#">Delete</a>
                </div>
                </div>
            
                <form action="/delete/po_in/'.$row->id.'" method="POST">
            
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


    // PURCHASE IN ITEM
    
    public function create_item($id)
    {
        return view('pages.po_in.create_po_in_item', compact('id'));
    }

    public function store_item(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
        ]);

        ItemPurchaseIn::create([
            'po_in_id' => $id,
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);
        return redirect('/edit_po_in/'.$id)->with('success', 'item has been added');
    }

    public function item_list($po_in_id)
    {
        $query = ItemPurchaseIn::where('po_in_id', $po_in_id)->get();
        return datatables($query)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $actionBtn = 
            '<td>
            <div class="btn-group">             
                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                    Options
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="/po_in/edit/item/'.$row->po_in_id.'/'.$row->id.'">Edit</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete'.$row->id.'" href="#">Delete</a>
                </div>
            </div>

            
            <form action="/po_in/delete/'.$row->id.'" method="POST">
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

    public function edit_item_page($po_in_id, $id)
    {
        $item = ItemPurchaseIn::findOrFail($id);
        return view ('pages.po_in.edit_po_in_item', compact('po_in_id', 'id', 'item'));
    }
    public function update_item_po_in($po_in_id, $id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
        ]);

        ItemPurchaseIn::findOrFail($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        return redirect('/edit_po_in/'.$po_in_id,)->with('success', 'Item has been updated');
    }
    public function delete_item_po_in($id)
    {
        ItemPurchaseIn::destroy($id);

        return back()->with('success', 'Item has been deleted');

    }
}
