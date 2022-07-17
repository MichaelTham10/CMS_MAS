<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Quotation;
use App\Models\InvoiceType;
use Illuminate\Support\Facades\DB;
use App\Models\invoice\InvoiceTypeDetail;
use App\Models\PurchaseIn;

class InvoiceController extends Controller
{
    public function index(Request $request = null, $show = null)
    {
        $items = Item::all();
        $quotations = Quotation::all();
        $invoices =  Invoice::all();
        return view('pages.invoice.invoice', compact('invoices', 'items', 'quotations'));
    }

    public function create()
    {
        $types = InvoiceType::all();
        $quotations = Quotation::where('active', true)->get();
        $po_ins = PurchaseIn::where('active', true)->get();
        return view('pages.invoice.create-invoice', compact('types', 'quotations', 'po_ins'));
    }   

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'date' => 'required',
            'billTo' => 'required',
            'note' => 'required',
        ]);
        // dd($request->quotation_selection . " " . $request->po_in_selection);
        if($request->po_in_selection != "empty" ){
            $this->read_number = $request->po_in_selection;
        }
        if($request->quotation_selection != "empty")
        {
            $this->read_number = $request->quotation_selection;
        }
        else{
            $this->read_number = "test";
        }
        // else if($request->quotation_selection == "empty" && $request->po_in_selection == "empty")
        // {
        //     $request->validate([
        //         'po_in_selection' => 'required',
        //         'quotation_selection' => 'required',
        //     ]);
        // }
        $this->temp = 0;

        $ivcs = InvoiceTypeDetail::all();

        foreach($ivcs as $ivc)
        {
            if($ivc->invoice_date == $request->date && $ivc->type_id == $request->type)
            {   
                $this->temp = 1;
                InvoiceTypeDetail::findOrFail($ivc->id)->update([
                    'quantity' => ($ivc->quantity + 1),
                ]);

                $detail = InvoiceTypeDetail::findOrFail($ivc->id);

                Invoice::create([
                    'type_id' => $request->type,
                    'type_detail_id' => $detail->id,
                    'Invoice No' => Invoice::getFormatId($request->type, $detail->quantity, $request->date),
                    'type_detail_quantity' => $detail->quantity,
                    'Address' => $request->address,
                    'Invoice Date' => $request->date,
                    'read_number' => $this->read_number,
                    'Bill To' => $request->billTo,
                    'Note' => $request->note
                ]);
                break;
            }
            
        }

        if($this->temp == 0)
        {
            InvoiceTypeDetail::create([
                'type_id' => $request->type,
                'invoice_date' => $request->date,
            ]);

            $type_detail = DB::table('invoice_type_details')->orderBy('id', 'DESC')->first();
            
            Invoice::create([
                'type_id' => $request->type,
                'type_detail_id' => $type_detail->id,
                'Invoice No' => Invoice::getFormatId($request->type, $type_detail->quantity, $request->date),
                'type_detail_quantity' => $type_detail->quantity,
                'Address' => $request->address,
                'Invoice Date' => $request->date,
                'read_number' => $this->read_number,
                'Bill To' => $request->billTo,
                'Note' => $request->note
            ]);
        }
        $explodedReadNumber = explode('/', $this->read_number);
        $type = $explodedReadNumber[1];
        if($type == "PO") 
        {
            PurchaseIn::findOrFail($this->read_number)->update([
                "active" => false
            ]);
        }
        else{
            $updated_quotation = Quotation::where('Quotation_No', $this->read_number)->first();
            $updated_quotation->update([
                "active" => false
            ]);
        }
        // dd($explodedReadNumber);
        return redirect('/invoice')->with('success', 'Invoice has been added');   
    }
    public function editpage($id)
    {
        $invoice = Invoice::findOrFail($id);
        $type = InvoiceType::findOrFail($invoice->type_id);
        return view('pages.invoice.edit-invoice', compact('invoice', 'type'));
    }

    public function delete($invoice_id)
    {
        Invoice::destroy($invoice_id);

        return back()->with('success', 'Invoice has been deleted');
    }

    public function update($invoice_id, Request $request)
    {
        
        $invoice = Invoice::findOrFail($invoice_id);
        $type = InvoiceType::findOrFail($invoice->type_id);
        $itds = InvoiceTypeDetail::all();
        if($invoice['Invoice Date'] != $request->date)
        {
            $itd = InvoiceTypeDetail::findOrFail($invoice->type_detail_id);
            InvoiceTypeDetail::findOrFail($invoice->type_detail_id)->update([
                'quantity' => ($itd->quantity - 1),
            ]);

            $temp = InvoiceTypeDetail::findOrFail($invoice->type_detail_id);

            foreach($itds as $invoice_detail)
            {  
                if($invoice_detail->invoice_date == $request->date && $invoice_detail->type_id == $invoice->type_id)
                {
                    InvoiceTypeDetail::findOrFail($invoice_detail->id)->update([
                        'quantity' => ($invoice_detail->quantity + 1),
                    ]);

                    $detail = InvoiceTypeDetail::findOrFail($invoice_detail->id);

                    $invoice->update([
                        'type_detail_id' =>$detail->id,
                        'Invoice No' => Invoice::getFormatId($type->id, $detail->quantity, $request->date),
                        'type_detail_quantity' => $detail->quantity,
                        'Address' => $request->address,
                        'Invoice Date' => $request->date,
                        'Bill To' => $request->billTo,
                        'Note' => $request->note                  
                    ]);

                    if($temp->quantity == 0){
                        InvoiceTypeDetail::destroy($temp->id);
                    }

                    return back()->with('success', 'Invoice has been updated');
                }
            }
           
            InvoiceTypeDetail::create([
                'type_id' => $invoice->type_id,
                'invoice_date' => $request->date,
            ]);

            $type_detail = DB::table('invoice_type_details')->orderBy('id', 'DESC')->first();

            $invoice->update([  
                'type_detail_id' =>$type_detail->id,
                'Invoice No' => Invoice::getFormatId($type->id, $type_detail->quantity, $request->date),
                'type_detail_quantity' => $type_detail->quantity,
                'Address' => $request->address,
                'Invoice Date' => $request->date,
                'Bill To' => $request->billTo,
                'Note' => $request->note    
            ]);

            if($temp->quantity == 0){
                InvoiceTypeDetail::destroy($temp->id);
            }

            return back()->with('success', 'Invoice has been updated');
        }
        
        $invoice->update([
            'Address' => $request->address,
            'Invoice Date' => $request->date,
            'Bill To' => $request->billTo,
            'Note' => $request->note  
        ]);

        return back()->with('success', 'Invoice has been updated');
    }

    public function invoiceDatatable($show = null)
    {
        $invoices = Invoice::all();

        return view('pages.invoice', compact('invoices'));
    }
    public function list()
    {
        $query = Invoice::with('quotation');
        
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
                    <a class="dropdown-item" href="/editinvoice/'.$row->id.'">Edit</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete'.$row->id.'" href="#">Delete</a>
                    <a class="dropdown-item" href="/invoice/item/export-pdf/'.$row->id.'" target="_blank">Export PDF</a>
                </div>
                </div>
            
                <form action="/delete/invoice/'.$row->id.'" method="POST">
            
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
}
