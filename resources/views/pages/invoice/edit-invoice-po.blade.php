@extends('layouts.app', ['title' => 'Edit Invoice'])

{{-- title web tab --}}
@section('page-title')
    Edit Invoice PO
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
    @endif

    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4 p-4" style="background-color: #fff">
            <div class="font-weight-bold">
                <div class="mb-3">
                    <h3>Edit Invoice No: {{$invoice['Invoice No']}}</h3>
                </div>   
                <hr class="mt-0 mb-3"> 
                <form action="/update/invoice-po/{{$invoice->id}}" method="POST">
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
                        <label for="quotation-no">PO In</label>
                        <input class="form-control" type="text" value="{{$invoice->poin->customer_number}}"  readonly>
                    </div>

                    <div class="form-group">
                        <label for="billTo">Bill To</label>
                        <input class="form-control" type="text" placeholder="Input Bill To" name="billTo" value="{{$invoice['Bill To']}}">
                    </div>

                    <div class="form-group">
                        <label for="serviceCost">Service Cost</label>
                        <input class="form-control" value="{{$invoice->service_cost}}" type="number" placeholder="Input Service Cost" @error('serviceCost')
                        is invalid @enderror name="serviceCost" required>
                        @error('serviceCost')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="note">Terms & Condition</label>
                        <textarea class="note " name="note">{{$invoice['Note']}}</textarea>
                        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                        <script>
                           tinymce.init({
                                forced_root_block : '',
                                selector:'textarea.note',
                                plugins: 'lists',
                                toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist',
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

