<?php

namespace App\Http\Controllers\Quotation;

use App\Http\Controllers\Controller;
use App\Models\OldQuotation;
use App\Models\QuotationType;
use Illuminate\Http\Request;

class OldQuotationController extends Controller
{
    public function index($show = null)
    {
        $quotations = OldQuotation::all();

        return view('pages.quotation.old-quotation', compact('quotations'));
    }

    public function list()
    {
        $query = OldQuotation::all();
        
        return datatables($query)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $actionBtn = 
            '<td>
            <div class="btn-group">
                <a href="" class="btn btn-primary btn-sm" id="submit" data-toggle="modal" data-target="#modalDetail">Detail</a>
                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="/edit/old/quotation/'.$row->id.'">Edit</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete'.$row->id.'" href="#">Delete</a>
                </div>
            </div>

            
            <form action="/delete/old/quotation/'.$row->id.'" method="POST">          
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
        return view('pages.quotation.create-old-quotation');
    }

    public function store(Request $request)
    {
        $request->validate([
            'quotation_number' => 'required',
            'file' => 'required',
        ]);

        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $filename = $name;
        $file->move('pdf/', $filename);
        OldQuotation::create([
            'Quotation_No' => $request->quotation_number,
            'file' => $filename
        ]);

        $quotations = OldQuotation::all();
        return redirect('/old/quotation')->with(['quotations' => $quotations]);
    }

    public function edit($id)
    {
        $quotation = OldQuotation::findorfail($id);
        return view('pages.quotation.edit-old-quotation', compact('quotation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quotation_number' => 'required',
        ]);

        $file = $request->file('file');
        if($file != null)
        {
            $name = $file->getClientOriginalName();
            $filename = $name;
            $file->move('pdf/', $filename);

            OldQuotation::findOrFail($id)->update([
                'Quotation_No' => $request->quotation_number,
                'file' => $filename,
            ]);
        }
        else{
            OldQuotation::findOrFail($id)->update([
                'Quotation_No' => $request->quotation_number,
            ]);
        }

        $quotations = OldQuotation::all();
        return redirect('/old/quotation')->with(['quotations' => $quotations]);
    }

    public function delete($id)
    {
        OldQuotation::destroy($id);
        return back()->with('success', 'Purchase in has been deleted');
    }
}
