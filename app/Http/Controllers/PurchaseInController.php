<?php

namespace App\Http\Controllers;

use App\Models\PurchaseIn;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseInController extends Controller
{
    //
    public function show()
    {
        $po_in = PurchaseIn::all();
        return view('pages.po_in.po_in', compact('po_in'));
    }

    public function index_update()
    {
        $purchaseIn = PurchaseIn::all();
        return view('pages.po_in.edit_po_in', compact('purchaseIn'));
    }

    public function edit($id)
    {
        $purchaseIn = PurchaseIn::findOrFail($id);
        return view('pages.po_in.edit_po_in', compact('purchaseIn'));
    }

    public function update(Request $request, $id)
    {
        $request = request();
        $file = $request->file('file');
        if($file != null)
        {
            $name = $file->getClientOriginalName();
            $filename = $name;
            $file->move('pdf/', $filename);

            PurchaseIn::findOrFail($id)->update([
                'date' => $request->date
            ]);
        }

        PurchaseIn::findOrFail($id)->update([
            'attention' => $request->attention,
            'customer_number' => $request->customer_number,
            'company_name' => $request->company_name,
            'date' => $request->date
        ]);
        $po_in = PurchaseIn::all();
        return redirect('/po_in')->with(['po_in' => $po_in]);
    }

    public function index_create()
    {
        return view('pages.po_in.create-purchase');
    }

    public function create(Request $request)
    {
        $request = request();

        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $filename = $name;
        $file->move('pdf/', $filename);
        PurchaseIn::create([
            'attention' => $request->attention,
            'customer_number' => $request->customer_number,
            'company_name' => $request->company_name,
            'date' => Carbon::now(),
            'file' => $filename
        ]);

        $po_in = PurchaseIn::all();
        return redirect('/po_in')->with(['po_in' => $po_in]);
    }

    public function delete($id)
    {
        PurchaseIn::destroy($id);
        $po_in = PurchaseIn::all();
        return back()->with('success', 'Purchase in has been deleted');
    }

    public function list()
    {
        $query = PurchaseIn::all();
        
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
                    <a class="dropdown-item" href="/invoice/item/export-pdf/'.$row->id.'" target="_blank">Export PDF</a>
                </div>
                </div>
            
                <form action="/delete/po_in/'.$row->id.'" method="POST">
            
                '.csrf_field().'
                '.method_field('delete').'
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
}
