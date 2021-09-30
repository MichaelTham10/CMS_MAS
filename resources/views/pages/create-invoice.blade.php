@extends('layouts.app', ['title' => 'Create Invoices'])

@section('content')
@include('layouts.headers.cards')
    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4" style="background-color: #fff">
            <div class="pl-4 pt-4 pr-4 font-weight-bold">
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

                    <div class="form-group">
                        <label for="quotation">Quotation</label>
                        <select class="form-control" id="quotation" name="quotationNo">
                            @foreach ($quotations as $quotation)
                               <option value="{{$quotation->id}}">{{$quotation->Quotation_No}}</option> 
                            @endforeach
                        </select>
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
                        @enderror>Terms and condition\n aaaaa></textarea>
                        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                        <script>
                            tinymce.init({
                                selector:'textarea.note',
                                width: 940,
                                height: 300,
                            });
                        </script>
                        @error('note')
                        <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end pl-4 pb-4 ">
                        <button type="button" class="btn btn-light">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>   
    </div>
@endsection