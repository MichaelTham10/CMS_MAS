<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\InvoicePO;
use App\Models\InvoicePOTypeDetail;
use App\Models\InvoiceType;
use App\Models\ItemPurchaseIn;
use App\Models\PurchaseOrderIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoicePOController extends Controller
{
    public function index(Request $request = null, $show = null)
    {
        $items = ItemPurchaseIn::all();

        $invoices =  InvoicePO::all();
        return view('pages.invoice.po-in-invoice', compact('invoices', 'items'));
    }

    public function create()
    {
        $types = InvoiceType::all();
        $po_ins = PurchaseOrderIn::where('active', true)->get();
        
        return view('pages.invoice.create-invoice-po-in', compact('types', 'po_ins'));
    }   
    
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'date' => 'required',
            'billTo' => 'required',
            'note' => 'required',
            'po_in_selection' => 'required',
            'serviceCost' => 'required',
        ]);
        
        $this->temp = 0;

        $ivcs = InvoicePOTypeDetail::all();

        foreach($ivcs as $ivc)
        {
            if($ivc->invoice_date == $request->date && $ivc->type_id == $request->type)
            {   
                $this->temp = 1;
                InvoicePOTypeDetail::findOrFail($ivc->id)->update([
                    'quantity' => ($ivc->quantity + 1),
                ]);

                $detail = InvoicePOTypeDetail::findOrFail($ivc->id);

                InvoicePO::create([
                    'type_id' => $request->type,
                    'type_detail_id' => $detail->id,
                    'Invoice No' => InvoicePO::getFormatId($request->type, $detail->quantity, $request->date),
                    'type_detail_quantity' => $detail->quantity,
                    'Address' => $request->address,
                    'Invoice Date' => $request->date,
                    'PO_In_Id' => $request->po_in_selection,
                    'Bill To' => $request->billTo,
                    'Note' => $request->note,
                    'service_cost' => $request->serviceCost
                ]);
                break;
            }
            
        }

        if($this->temp == 0)
        {
            InvoicePOTypeDetail::create([
                'type_id' => $request->type,
                'invoice_date' => $request->date,
            ]);

            $type_detail = DB::table('invoice_p_o_type_details')->orderBy('id', 'DESC')->first();
            
            InvoicePO::create([
                'type_id' => $request->type,
                'type_detail_id' => $type_detail->id,
                'Invoice No' => InvoicePO::getFormatId($request->type, $type_detail->quantity, $request->date),
                'type_detail_quantity' => $type_detail->quantity,
                'Address' => $request->address,
                'Invoice Date' => $request->date,
                'PO_In_Id' => $request->po_in_selection,
                'Bill To' => $request->billTo,
                'Note' => $request->note,
                'service_cost' => $request->serviceCost
            ]);
        }
        $updated_po_in = PurchaseOrderIn::findOrFail($request->po_in_selection);
        $updated_po_in->update([
            "active" => false
        ]);
        return redirect('/invoice/po')->with('success', 'Invoice has been added');   
    }

    public function delete($invoice_id)
    {
        InvoicePO::destroy($invoice_id);

        return back()->with('success', 'Invoice has been deleted');
    }

    public function list()
    {
        $query = InvoicePO::with('poin');
        
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
                    <a class="dropdown-item" href="/editinvoice-po/'.$row->id.'">Edit</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete'.$row->id.'" href="#">Delete</a>
                    <a class="dropdown-item" href="/invoice/item/export-pdf-po/'.$row->id.'" target="_blank">Export PDF</a>
                </div>
                </div>
            
                <form action="/delete/invoice-po/'.$row->id.'" method="POST">           
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

    public function editpage($id)
    {
        $invoice = InvoicePO::findOrFail($id);
        $type = InvoiceType::findOrFail($invoice->type_id);
        return view('pages.invoice.edit-invoice-po', compact('invoice', 'type'));
    }

    public function update($invoice_id, Request $request)
    {
        
        $invoice = InvoicePO::findOrFail($invoice_id);
        $type = InvoiceType::findOrFail($invoice->type_id);
        $itds = InvoicePOTypeDetail::all();
        if($invoice['Invoice Date'] != $request->date)
        {
            $itd = InvoicePOTypeDetail::findOrFail($invoice->type_detail_id);
            InvoicePOTypeDetail::findOrFail($invoice->type_detail_id)->update([
                'quantity' => ($itd->quantity - 1),
            ]);

            $temp = InvoicePOTypeDetail::findOrFail($invoice->type_detail_id);

            foreach($itds as $invoice_detail)
            {  
                if($invoice_detail->invoice_date == $request->date && $invoice_detail->type_id == $invoice->type_id)
                {
                    InvoicePOTypeDetail::findOrFail($invoice_detail->id)->update([
                        'quantity' => ($invoice_detail->quantity + 1),
                    ]);

                    $detail = InvoicePOTypeDetail::findOrFail($invoice_detail->id);

                    $invoice->update([
                        'type_detail_id' =>$detail->id,
                        'Invoice No' => InvoicePO::getFormatId($type->id, $detail->quantity, $request->date),
                        'type_detail_quantity' => $detail->quantity,
                        'Address' => $request->address,
                        'Invoice Date' => $request->date,
                        'Bill To' => $request->billTo,
                        'Note' => $request->note,
                        'service_cost' => $request->serviceCost                  
                    ]);

                    if($temp->quantity == 0){
                        InvoicePOTypeDetail::destroy($temp->id);
                    }

                    return redirect('/invoice/po')->with('success', 'Invoice has been updated');
                }
            }
           
            InvoicePOTypeDetail::create([
                'type_id' => $invoice->type_id,
                'invoice_date' => $request->date,
            ]);

            $type_detail = DB::table('invoice_type_details')->orderBy('id', 'DESC')->first();

            $invoice->update([  
                'type_detail_id' =>$type_detail->id,
                'Invoice No' => InvoicePO::getFormatId($type->id, $type_detail->quantity, $request->date),
                'type_detail_quantity' => $type_detail->quantity,
                'Address' => $request->address,
                'Invoice Date' => $request->date,
                'Bill To' => $request->billTo,
                'Note' => $request->note,
                'service_cost' => $request->serviceCost  
            ]);

            if($temp->quantity == 0){
                InvoicePOTypeDetail::destroy($temp->id);
            }

            return redirect('/invoice/po')->with('success', 'Invoice has been updated');
        }
        
        $invoice->update([
            'Address' => $request->address,
            'Invoice Date' => $request->date,
            'Bill To' => $request->billTo,
            'Note' => $request->note, 
            'service_cost' => $request->serviceCost  
        ]);

        return redirect('/invoice/po')->with('success', 'Invoice has been updated');
    }

}
