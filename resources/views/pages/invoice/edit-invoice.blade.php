@extends('layouts.app', ['title' => 'Edit Invoice'])

{{-- title web tab --}}
@section('page-title')
    Edit Invoice
@endsection

{{-- navbar title --}}
{{-- @section('head-title')
    Edit Invoice
@endsection --}}

@section('content')
@include('layouts.headers.cards')
    @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{Session::get('success')}}</strong>
        </div>
    @elseif(Session::has('failed'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{Session::get('failed')}}</strong>
        </div>
    @endif

    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4 p-4" style="background-color: #fff">
            <div class="font-weight-bold">
                <div class="mb-3">
                    <h3>Edit Invoice No: {{$invoice['Invoice No']}}</h3>
                </div>   
                <hr class="mt-0 mb-3"> 
                <form action="/update/invoice/{{$invoice->id}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input class="form-control" readonly type="text" value="{{$type->name}} ({{$type->alias}})">
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input class="form-control" type="text" placeholder="Input Address" name="address" value="{{$invoice['Address']}}">
                    </div>

                    <div class="form-group">
                        <label for="invoice-no">Invoice No</label>
                        <input class="form-control" type="text" value="{{$invoice->getFormatId($invoice->type_id,$invoice->type_detail_quantity, $invoice['Invoice Date'])}}"  readonly>
                    </div>

                    <div class="form-group">
                        <label for="invoiceDate">Invoice Date</label>
                        <input class="form-control" type="date" placeholder="Input Invoice Date" 
                        onfocus="(this.type='date')" id="invoice-date" name="date" value="{{$invoice['Invoice Date']}}">
                    </div>

                    <div class="form-group">
                        <label for="quotation-no">Quotation No</label>
                        <input class="form-control" type="text" value="{{$invoice->quotation->Quotation_No}}"  readonly>
                    </div>

                    <div class="form-group">
                        <label for="billTo">Bill To</label>
                        <input class="form-control" type="text" placeholder="Input Bill To" name="billTo" value="{{$invoice['Bill To']}}">
                    </div>
                    
                    <div class="form-group">
                        <label for="note">Terms & Condition</label>
                        <textarea class="note " name="note">{{$invoice['Note']}}</textarea>
                        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                        <script>
                            tinymce.init({
                                forced_root_block : '',
                                selector:'textarea.note',
                                height: 300,
                            });
                        </script>
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

