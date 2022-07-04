<?php

namespace App\Http\Controllers\PO_Out;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrderOut;
use Illuminate\Http\Request;

class PurchaseOutController extends Controller
{
    public function index(Request $request = null, $show = null)
    {
        // $items = Item::all();
        // $quotations = Quotation::all();
        // $invoices =  Invoice::all();
        $po_out = PurchaseOrderOut::all();
        return view('po_out.po_out', compact('po_out'));
    }

    public function create()
    {
        // $types = InvoiceType::all();
        // $quotations = Quotation::all();

        return view('po_out.create-po_out');
    }   

    public function store(Request $request)
    {
        $request->validate([
            'poDate' => 'required',
            'poArrivalDate' => 'required',
            'poTo' => 'required',  
            'poAttention' => 'required',  
            'poEmail' => 'required',  
            'poTerms' => 'required'  
        ]);

        // $this->temp = 0;

        // $ivcs = InvoiceTypeDetail::all();

        // foreach($ivcs as $ivc)
        // {
        //     if($ivc->invoice_date == $request->date && $ivc->type_id == $request->type)
        //     {   
        //         $this->temp = 1;
        //         InvoiceTypeDetail::findOrFail($ivc->id)->update([
        //             'quantity' => ($ivc->quantity + 1),
        //         ]);

        //         $detail = InvoiceTypeDetail::findOrFail($ivc->id);

        //         Invoice::create([
        //             'type_id' => $request->type,
        //             'type_detail_id' => $detail->id,
        //             'Invoice No' => Invoice::getFormatId($request->type, $detail->quantity, $request->date),
        //             'type_detail_quantity' => $detail->quantity,
        //             'Address' => $request->address,
        //             'Invoice Date' => $request->date,
        //             'Quotation No' => $request->quotationNo,
        //             'Bill To' => $request->billTo,
        //             'Note' => $request->note
        //         ]);
        //         break;
        //     }
            
        // }

        // if($this->temp == 0)
        // {
        //     InvoiceTypeDetail::create([
        //         'type_id' => $request->type,
        //         'invoice_date' => $request->date,
        //     ]);

        //     $type_detail = DB::table('invoice_type_details')->orderBy('id', 'DESC')->first();

        //     Invoice::create([
        //         'type_id' => $request->type,
        //         'type_detail_id' => $type_detail->id,
        //         'Invoice No' => Invoice::getFormatId($request->type, $type_detail->quantity, $request->date),
        //         'type_detail_quantity' => $type_detail->quantity,
        //         'Address' => $request->address,
        //         'Invoice Date' => $request->date,
        //         'Quotation No' => $request->quotationNo,
        //         'Bill To' => $request->billTo,
        //         'Note' => $request->note
        //     ]);
        // }

        // PurchaseOrderOut::create([
        //     'po_out_no' => $request->type,
        //     'date' => $detail->id,
        //     'arrival' => Invoice::getFormatId($request->type, $detail->quantity, $request->date),
        //     'to' => $detail->quantity,
        //     'attn' => $request->address,
        //     'email' => $request->date,
        //     'ppn' => $request->quotationNo,
        //     'terms' => $request->billTo,
        // ]);

        return redirect('/po-out')->with('success', 'Purchase Order has been added');   
    }

    public function editpage($id)
    {
        $po_out = PurchaseOrderOut::findOrFail($id);
        // $type = InvoiceType::findOrFail($invoice->type_id);
        return view('po_out.edit-po_out', compact('po_out'));
    }

    public function delete($po_out_id)
    {
        PurchaseOrderOut::destroy($po_out_id);

        return back()->with('success', 'Purchase Order has been deleted');
    }

    public function update($po_out_id, Request $request)
    {
        
        $po_out = PurchaseOrderOut::findOrFail($po_out_id);
        // $type = InvoiceType::findOrFail($invoice->type_id);
        // $itds = InvoiceTypeDetail::all();
        // if($invoice['Invoice Date'] != $request->date)
        // {
        //     $itd = InvoiceTypeDetail::findOrFail($invoice->type_detail_id);
        //     InvoiceTypeDetail::findOrFail($invoice->type_detail_id)->update([
        //         'quantity' => ($itd->quantity - 1),
        //     ]);

        //     $temp = InvoiceTypeDetail::findOrFail($invoice->type_detail_id);

        //     foreach($itds as $invoice_detail)
        //     {  
        //         if($invoice_detail->invoice_date == $request->date && $invoice_detail->type_id == $invoice->type_id)
        //         {
        //             InvoiceTypeDetail::findOrFail($invoice_detail->id)->update([
        //                 'quantity' => ($invoice_detail->quantity + 1),
        //             ]);

        //             $detail = InvoiceTypeDetail::findOrFail($invoice_detail->id);

        //             $invoice->update([
        //                 'type_detail_id' =>$detail->id,
        //                 'Invoice No' => Invoice::getFormatId($type->id, $detail->quantity, $request->date),
        //                 'type_detail_quantity' => $detail->quantity,
        //                 'Address' => $request->address,
        //                 'Invoice Date' => $request->date,
        //                 'Bill To' => $request->billTo,
        //                 'Note' => $request->note                  
        //             ]);

        //             if($temp->quantity == 0){
        //                 InvoiceTypeDetail::destroy($temp->id);
        //             }

        //             return back()->with('success', 'Invoice has been updated');
        //         }
        //     }
           
        //     InvoiceTypeDetail::create([
        //         'type_id' => $invoice->type_id,
        //         'invoice_date' => $request->date,
        //     ]);

        //     $type_detail = DB::table('invoice_type_details')->orderBy('id', 'DESC')->first();

            // $invoice->update([  
            //     'type_detail_id' =>$type_detail->id,
            //     'Invoice No' => Invoice::getFormatId($type->id, $type_detail->quantity, $request->date),
            //     'type_detail_quantity' => $type_detail->quantity,
            //     'Address' => $request->address,
            //     'Invoice Date' => $request->date,
            //     'Bill To' => $request->billTo,
            //     'Note' => $request->note    
            // ]);

            // if($temp->quantity == 0){
            //     InvoiceTypeDetail::destroy($temp->id);
            // }

        //     return back()->with('success', 'Invoice has been updated');
        // }
        
        $po_out->update([
            'date' => $request->poDate,
            'arrival' => $request->poArrivalDate,
            'to' => $request->poTo,  
            'attn' => $request->poAttention,  
            'email' => $request->poEmail,  
            // 'ppn' => $request->poPPN,
            'terms' => $request->poTerms  
        ]);

        return back()->with('success', 'Purchase Order has been updated');
    }

    public function poOutDataTable($show = null)
    {
        $po_out = PurchaseOrderOut::all();

        return view('po_out.po_out', compact('po_out'));
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
