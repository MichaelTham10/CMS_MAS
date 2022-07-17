@extends('layouts.app', ['title' => 'Create Invoices'])

{{-- title web tab --}}
@section('page-title')
    Create Invoice
@endsection

{{-- navbar title --}}
{{-- @section('head-title')
    Create Invoice
@endsection --}}

@section('content')
@include('layouts.headers.cards')
    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4 p-4" style="background-color: #fff">
            <div class="font-weight-bold">
                <div class="mb-3">
                    <h3>Create Invoice</h3>
                </div>   
                <hr class="mt-0 mb-3"> 
                <form action="/invoice/store" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            @foreach ($types as $type)
                            <option value="{{$type->id}}">{{$type->name}} ({{$type->alias}})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" rows="2" placeholder="Input Address"
                        @error('address') is invalid @enderror name="address"></textarea>
                        @error('address')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="invoice-number">Invoice No</label>
                        <input class="form-control" type="text" placeholder="AUTO GENERATE" readonly>
                    </div>

                    <div class="form-group">
                        <label for="invoiceDate">Quotation Date</label>
                        <input class="form-control" type="date" placeholder="Input Invoice Date" @error('invoiceDate')
                        is invalid @enderror onfocus="(this.type='date')" id="invoice-date" name="date">
                        @error('invoiceDate')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    {{-- <div class="form-group">
                        <label for="quotation">Quotation</label>
                        <select class="form-control" id="quotation" name="quotationNo">
                            @foreach ($quotations as $quotation)
                                <option value="{{$quotation->id}}">{{$quotation->Quotation_No}}</option> 
                            @endforeach
                        </select>
                    </div> --}}
                    @php
                        $onclick = 0;
                    @endphp
                    <div class="form-group">
                        <label for="">Choose Options</label>
                        <div class="d-flex">
                            <div class="mr-2">
                                <input type="radio" id="quotation" name="radio_selection" value="1" onclick="selection(1)" />
                                <label for="Quotation">Quotation</label>
                            </div>
                            <div class="ml-2">
                                <input type="radio" id="po_In" name="radio_selection" value="2" onclick="selection(2)"/>
                                <label for="Quotation">PO IN</label>
                            </div>
                        </div>
                        <select class="form-control" name="quotation_selection" id="quotation_selection" style="display: none">
                            <option hidden value="empty"></option>
                            @foreach ($quotations as $quotation)
                               <option value="{{$quotation->Quotation_No}}">{{$quotation->Quotation_No}}</option> 
                            @endforeach
                        </select>
                        <select class="form-control"  name="po_in_selection" id="po_in_selection" style="display: none">
                            <option hidden value="empty"></option>
                            @foreach ($po_ins as $po_in)
                               <option value="{{$po_in->id}}">{{$po_in->id}}</option> 
                            @endforeach
                        </select>
                        <script>
                            function selection(value){
                                
                                if(value === 1){
                                    document.getElementById("quotation_selection").style.display = "block";
                                    document.getElementById("po_in_selection").style.display = "none";
                                }else{
                                    document.getElementById("quotation_selection").style.display = "none";
                                    document.getElementById("po_in_selection").style.display = "block";
                                }
                            }
                            
                        </script>
                    </div>
                    
                    
                    
                    <div class="form-group">
                        <label for="bill-to">Bill To</label>
                        <input class="form-control" type="text" placeholder="Input Bill To" @error('billTo')
                        is invalid @enderror name="billTo">
                        @error('billTo')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="note">Note</label>
                        <textarea class="note" name="note"
                        @error('note')
                        is invalid
                        @enderror></textarea>
                        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                        <script>
                            tinymce.init({
                                forced_root_block : '',
                                selector:'textarea.note',
                                height: 300,
                            });
                        </script>
                        @error('note')
                        <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/invoice" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>   
    </div>
@endsection

