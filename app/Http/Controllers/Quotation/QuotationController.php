<?php

namespace App\Http\Controllers\Quotation;

use App\Http\Controllers\Controller;

use App\Models\Quotation;
use App\Models\QuotationType;
use App\Models\Item;
use App\Models\quotation\QuotationTypeDetail;
use App\Models\Invoice;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    public function index($show = null)
    {
        $quotations = Quotation::all();
        $items = Item::all();

        return view('pages.quotation.quotation', compact('quotations', 'items'));
    }

    public function list()
    {
        $query = Quotation::all();
        
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
                    <a class="dropdown-item" href="/editquotation/'.$row->id.'">Edit</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete'.$row->id.'" href="#">Delete</a>
                    <a class="dropdown-item" href="/quotation/item/export-pdf/'.$row->id.'" target="_blank">Export PDF</a>
                </div>
            </div>
            
            <form action="/delete/quotation/'.$row->id.'" method="POST">       
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

    public $temp;

    public function create()
    {
        $types = QuotationType::all();

        return view('pages.quotation.create-quotation', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer' => 'required',
            'attention' => 'required',
            'payment' => 'required',
            'date' => 'required',
            'discount' => 'required',
            'account' => 'required',
            'terms' => 'required',
        ]);

        $this->temp = 0;

        $qtds = QuotationTypeDetail::all();

        foreach($qtds as $qtd)
        {
            if($qtd->quotation_date == $request->date && $qtd->type_id == $request->type)
            {   
                $this->temp = 1;
                QuotationTypeDetail::findOrFail($qtd->id)->update([
                    'quantity' => ($qtd->quantity + 1),
                ]);

                $detail = QuotationTypeDetail::findOrFail($qtd->id);

                Quotation::create([
                    'type_id' => $request->type,
                    'type_detail_id' => $detail->id,
                    'Quotation_No' => Quotation::getFormatId($request->type, $detail->quantity, $request->date),
                    'type_detail_quantity' => $detail->quantity,
                    'Customer' => $request->customer,
                    'Attention' => $request->attention,
                    'Payment Term' => $request->payment,
                    'Quotation Date' => $request->date,
                    'Account Manager' => $request->account,
                    'Discount' => $request->discount,
                    'Terms' => $request->terms
                ]);
                break;
            }
            
        }

        if($this->temp == 0)
        {
            QuotationTypeDetail::create([
                'type_id' => $request->type,
                'quotation_date' => $request->date,
            ]);

            $type_detail = DB::table('quotation_type_details')->orderBy('id', 'DESC')->first();

            Quotation::create([
                'type_id' => $request->type,
                'type_detail_id' =>$type_detail->id,
                'Quotation_No' => Quotation::getFormatId($request->type, $type_detail->quantity, $request->date),
                'type_detail_quantity' => $type_detail->quantity,
                'Customer' => $request->customer,
                'Attention' => $request->attention,
                'Payment Term' => $request->payment,
                'Quotation Date' => $request->date,
                'Account Manager' => $request->account,
                'Discount' => $request->discount,
                'Terms' => $request->terms
            ]);
        }
        
        return redirect('/quotation')->with('success', 'Quotation has been added');
        
    }

    public function editpage($id)
    {
        $quotation = Quotation::findOrFail($id);
        $type = QuotationType::findOrFail($quotation->type_id);
        $items = Item::where('quotation_id', $quotation->id)->get(); 
        return view('pages.quotation.editquotation', compact('quotation', 'type', 'items'));
    }

    public function delete($quotation_id)
    {
        $ivcs = Invoice::where('Quotation No', $quotation_id)->get();
        Invoice::destroy($ivcs);

        $items = Item::where('quotation_id', $quotation_id)->get();
        Item::destroy($items);

        Quotation::destroy($quotation_id);

        return back()->with('success', 'Quotation has been deleted');
    }

    public function update($quotation_id, Request $request)
    {  
        $quotation = Quotation::findOrFail($quotation_id);
        $type = QuotationType::findOrFail($quotation->type_id);
        $qtds = QuotationTypeDetail::all();
        if($quotation['Quotation Date'] != $request->date)
        {
            $qtd = QuotationTypeDetail::findOrFail($quotation->type_detail_id);

            QuotationTypeDetail::findOrFail($quotation->type_detail_id)->update([
                'quantity' => ($qtd->quantity - 1),
            ]);

            $temp = QuotationTypeDetail::findOrFail($quotation->type_detail_id);

            foreach($qtds as $item)
            {  
                if($item->quotation_date == $request->date && $item->type_id == $quotation->type_id)
                {
                    QuotationTypeDetail::findOrFail($item->id)->update([
                        'quantity' => ($item->quantity + 1),
                    ]);

                    $detail = QuotationTypeDetail::findOrFail($item->id);

                    $quotation->update([
                        'type_detail_id' =>$detail->id,
                        'Quotation_No' => Quotation::getFormatId($type->id, $detail->quantity, $request->date),
                        'type_detail_quantity' => $detail->quantity,
                        'Customer' => $request->customer,
                        'Attention' => $request->attention,
                        'Payment Term' => $request->payment,
                        'Quotation Date' => $request->date,
                        'Account Manager' => $request->account,
                        'Discount' => $request->discount,
                        'Terms' => $request->terms
                    ]);

                    if($temp->quantity == 0){
                        QuotationTypeDetail::destroy($temp->id);
                    }

                    return redirect('/quotation')->with('success', 'Quotation has been updated');
                }
            }
            QuotationTypeDetail::create([
                'type_id' => $quotation->type_id,
                'quotation_date' => $request->date,
            ]);

            $type_detail = DB::table('quotation_type_details')->orderBy('id', 'DESC')->first();

            $quotation->update([
                'type_detail_id' => $type_detail->id,
                'Quotation_No' => Quotation::getFormatId($type->id, $type_detail->quantity, $request->date),
                'type_detail_quantity' => $type_detail->quantity,
                'Customer' => $request->customer,
                'Attention' => $request->attention,
                'Payment Term' => $request->payment,
                'Quotation Date' => $request->date,
                'Account Manager' => $request->account,
                'Discount' => $request->discount,
                'Terms' => $request->terms
            ]);

            if($temp->quantity == 0){
                QuotationTypeDetail::destroy($temp->id);
            }

            return back()->with('success', 'Quotation has been updated');
        }
        
        $quotation->update([
            'Customer' => $request->customer,
            'Attention' => $request->attention,
            'Payment Term' => $request->payment,
            'Account Manager' => $request->account,
            'Discount' => $request->discount,
            'Terms' => $request->terms
        ]);

        return redirect('/quotation')->with('success', 'Quotation has been updated');
    }


}
