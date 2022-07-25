@extends('layouts.app', ['title' => 'Create Invoices'])

{{-- title web tab --}}
@section('page-title')
    Create Invoice PO
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
                    <h3>Create Invoice PO</h3>
                </div>   
                <hr class="mt-0 mb-3"> 
                <form action="/invoice-po/store" method="POST">
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
                        <label for="invoiceDate">Invoice Date</label>
                        <input class="form-control" type="date" placeholder="Input Invoice Date" @error('invoiceDate')
                        is invalid @enderror onfocus="(this.type='date')" id="invoice-date" name="date">
                        @error('invoiceDate')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="po_selection">PO In No</label>
                        @if (!blank($po_ins))
                            <select class="form-control" id="po_selection" name="po_in_selection" 
                            @error('po_in_selection') is invalid @enderror required>
                                @foreach ($po_ins as $po_in)
                                    <option value="{{$po_in->id}}">{{$po_in->customer_number}}</option> 
                                @endforeach
                            </select>
                        @else
                            <input class="form-control" type="text" placeholder="No PO In Data" readonly
                            @error('po_in_selection') is invalid @enderror required>
                        @endif                      
                        @error('po_in_selection')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
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
                        <label for="serviceCost">Service Cost</label>
                        <input class="form-control" type="number" placeholder="Input Service Cost" @error('serviceCost')
                        is invalid @enderror name="serviceCost" required>
                        @error('serviceCost')
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
                        <a href="/invoice/po" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>   
    </div>
@endsection

