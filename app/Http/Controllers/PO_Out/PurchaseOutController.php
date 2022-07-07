<?php

namespace App\Http\Controllers\PO_Out;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrderOut;
use App\Models\PurchaseOrderOutDetails;
use App\Models\PurchaseOutItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOutController extends Controller
{
    public function index(Request $request = null, $show = null)
    {
        // $items = Item::all();
        // $quotations = Quotation::all();
        // $invoices =  Invoice::all();
        $po_out = PurchaseOrderOut::all();
        $po_out_items = PurchaseOutItem::all();
        return view('pages.po_out.po_out', compact('po_out', 'po_out_items'));
    }

    public function create()
    {
        // $types = InvoiceType::all();
        // $quotations = Quotation::all();

        return view('pages.po_out.create-po_out');
    }   

    public function store(Request $request)
    {
        $request->validate([
            'poDate' => 'required',
            'poArrivalDate' => 'required',
            'poTo' => 'required',  
            'poAttention' => 'required',  
            'poEmail' => 'required',  
            'poPPN' => 'required',
            'deliverTo' => 'required',
            'attnMakro' => 'required',
            'makroPhoneNumber' => 'required',
            'poTerms' => 'required'  
        ]);

        $this->temp = 0;
        $pos_out =PurchaseOrderOutDetails::all();
        foreach($pos_out as $po_out)
        {
            $request_date = date('Y-m', strtotime($request->poDate));
            // If month and year is same
            if($po_out->po_out_date == $request_date)
            {
                $this->temp = 1;
                PurchaseOrderOutDetails::findOrFail($po_out->id)->update([
                    'quantity' => ($po_out->quantity + 1),
                ]);

                $detail = PurchaseOrderOutDetails::findOrFail($po_out->id);

                PurchaseOrderOut::create([
                    'po_out_no' => PurchaseOrderOut::getFormatId($detail->quantity, $request->poDate),
                    'date' => $request->poDate,
                    'arrival' => $request->poArrivalDate,
                    'to' => $request->poTo,  
                    'attn' => $request->poAttention,  
                    'email' => $request->poEmail,  
                    'ppn' => $request->poPPN,
                    'terms' => $request->poTerms,
                    'deliver_to' => $request->deliverTo,
                    'attn_makro' => $request->attnMakro,
                    'makro_phone_no' => $request->makroPhoneNumber, 
                ]);
                break;
            }
        }
        if($this->temp == 0)
        {
            PurchaseOrderOutDetails::create([
                'po_out_date' => date('Y-m', strtotime($request->poDate)),
            ]);
            $detail = DB::table('purchase_order_out_details')->orderBy('id', 'DESC')->first();
            PurchaseOrderOut::create([
                'po_out_no' => PurchaseOrderOut::getFormatId($detail->quantity, $request->poDate),
                'date' => $request->poDate,
                'arrival' => $request->poArrivalDate,
                'to' => $request->poTo,  
                'attn' => $request->poAttention,  
                'email' => $request->poEmail,  
                'ppn' => $request->poPPN,
                'terms' => $request->poTerms,
                'deliver_to' => $request->deliverTo,
                'attn_makro' => $request->attnMakro,
                'makro_phone_no' => $request->makroPhoneNumber, 
            ]);
        }
    
        return redirect('/po-out')->with('success', 'Purchase Order has been added');   
    }

    public function editpage($id)
    {
        $po_out = PurchaseOrderOut::findOrFail($id);

        return view('pages.po_out.edit-po_out', compact('po_out'));
    }

    public function delete($po_out_id)
    {
        PurchaseOrderOut::destroy($po_out_id);

        return back()->with('success', 'Purchase Order has been deleted');
    }

    public function update($po_out_id, Request $request)
    {
        
        $po_out = PurchaseOrderOut::findOrFail($po_out_id);

        $request->validate([
            'poDate' => 'required',
            'poArrivalDate' => 'required',
            'poTo' => 'required',  
            'poAttention' => 'required',  
            'poEmail' => 'required',  
            'poPPN' => 'required',
            'deliverTo' => 'required',
            'attnMakro' => 'required',
            'makroPhoneNumber' => 'required',
            'poTerms' => 'required'  
        ]);
        
        $po_out->update([
            'date' => $request->poDate,
            'arrival' => $request->poArrivalDate,
            'to' => $request->poTo,  
            'attn' => $request->poAttention,  
            'email' => $request->poEmail,  
            'ppn' => $request->poPPN,
            'deliver_to' => $request->deliverTo,
            'attn_makro' => $request->attnMakro,
            'makro_phone_no' => $request->makroPhoneNumber,
            'terms' => $request->poTerms  
        ]);

        return back()->with('success', 'Purchase Order has been updated');
    }

    public function poOutDataTable($show = null)
    {
        $po_out = PurchaseOrderOut::all();

        return view('pages.po_out.po_out', compact('po_out'));
    }
    public function list()
    {
        $query = PurchaseOrderOut::all();
        
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
                    <a class="dropdown-item" href="/edit-po-out/'.$row->id.'">Edit</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete'.$row->id.'" href="#">Delete</a>
                    <a class="dropdown-item" href="/invoice/item/export-pdf/'.$row->id.'" target="_blank">Export PDF</a>
                </div>
                </div>
            
                <form action="/delete/po-out/'.$row->id.'" method="POST">
            
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
                                <p class="text-muted">If you remove this item it will be gone forever. <br> Are you sure you want to continue?</p>
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
