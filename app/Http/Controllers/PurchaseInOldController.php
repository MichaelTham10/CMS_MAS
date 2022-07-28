<?php

namespace App\Http\Controllers;

use App\Models\PurchaseInOld;
use Illuminate\Http\Request;

class PurchaseInOldController extends Controller
{
    //
    public function index()
    {
        $purchase = PurchaseInOld::all();
        return view('pages.po_in.po_in_old_index', compact('purchase'));
    }
    public function list()
    {
        $query = PurchaseInOld::all();
        
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
                    <a class="dropdown-item" href="/edit/old/po_in/'.$row->id.'">Edit</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete'.$row->id.'" href="#">Delete</a>
                </div>
            </div>

            
            <form action="/delete/old/po-in/'.$row->id.'" method="POST">          
                '.csrf_field().'
                '.method_field('DELETE').'
                <div class="modal fade" id="ModalDelete'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="container d-flex pl-0"><img src="">
                                    <h3 class="modal-title" id="exampleModalLabel" style="text-decoration: none; color: #2a3880; font-weight: bold;">Delete this item?</h3>
                                </div> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            </div>
                            <div class="modal-body">
                                <p style="text-decoration: none; color: #2a3880; font-weight: normal;">If you remove this item it will be gone forever. <br>Are you sure you want to continue?</p>
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

    public function create()
    {
        return view('pages.po_in.create-old-po-in');
    }

    public function store(Request $request)
    {
        $request->validate([
            'purchase_number' => 'required',
            'file' => 'required',
        ]);

        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $filename = $name;
        $file->move('pdf/', $filename);
        PurchaseInOld::create([
            'purchase_number' => $request->purchase_number,
            'file' => $filename
        ]);

        $purchase = PurchaseInOld::all();
        return redirect('/po_in/old')->with(['purchase' => $purchase]);
    }

    public function edit($id)
    {
        $purchase = PurchaseInOld::findorfail($id);
        return view('pages.po_in.edit-po_in_old', compact('purchase'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'purchase_number' => 'required',
        ]);

        $file = $request->file('file');
        if($file != null)
        {
            $name = $file->getClientOriginalName();
            $filename = $name;
            $file->move('pdf/', $filename);

            PurchaseInOld::findOrFail($id)->update([
                'purchase_number' => $request->purchase_number,
                'file' => $filename,
            ]);
        }
        else{
            PurchaseInOld::findOrFail($id)->update([
                'purchase_number' => $request->purchase_number,
            ]);
        }

        $purchase = PurchaseInOld::all();
        return redirect('/po_in/old')->with(['purchase' => $purchase]);
    }

    public function delete($id)
    {
        PurchaseInOld::destroy($id);
        return back()->with('success', 'Purchase in has been deleted');
    }
}
