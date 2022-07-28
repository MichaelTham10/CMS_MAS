<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\OldInvoice;
use Illuminate\Http\Request;

class OldInvoiceController extends Controller
{
    public function oldIndex(Request $request = null, $show = null)
    {
        $invoices = OldInvoice::all();
        return view('pages.invoice.old-invoice', compact('invoices'));
    }
    public function oldCreate(){
        return view('pages.invoice.create-old-invoice');
    }
    public function editPage($id){
        $invoice = OldInvoice::findOrFail($id);
        return view('pages.invoice.edit-old-invoice', compact('invoice'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required',
            'file' => 'required',
        ]);

        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $filename = $name;
        $file->move('pdf/', $filename);
        OldInvoice::create([
            'Invoice_No' => $request->invoice_number,
            'file' => $filename
        ]);

        return redirect('/old/invoice')->with('success','Old Invoice has been added');
    }
    public function update(Request $request, $invoice_id)
    {
        $request->validate([
            'invoice_number' => 'required',
        ]);

        $file = $request->file('file');
        if($file != null)
        {
            $name = $file->getClientOriginalName();
            $filename = $name;
            $file->move('pdf/', $filename);

            OldInvoice::findOrFail($invoice_id)->update([
                'Invoice_No' => $request->invoice_number,
                'file' => $filename,
            ]);
        }
        else{
            OldInvoice::findOrFail($invoice_id)->update([
                'Invoice_No' => $request->invoice_number,
            ]);
        }

        return redirect('/old/invoice')->with('success', 'Old Invoice has been updated ');
    }
    public function list()
    {
        $query = OldInvoice::all();
        
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
                    <a class="dropdown-item" href="/edit/old/invoice/'.$row->id.'">Edit</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete'.$row->id.'" href="#">Delete</a>
                </div>
            </div>

            
            <form action="/delete/old/invoice/'.$row->id.'" method="POST">          
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

    public function delete($id)
    {
        OldInvoice::destroy($id);
        return back()->with('success', 'Old Invoice has been deleted');
    }
}
