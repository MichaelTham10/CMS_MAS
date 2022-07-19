@extends('layouts.app', ['title' => 'Edit Quotation'])

@section('head-title')
    Edit Quotation
@endsection

@section('page-title')
    Edit Quotation
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/r-2.2.9/datatables.min.css"/>
@endsection

@section('content')
    <style>
        .dataTables_length, .dataTables_filter, .dataTables_info, .dataTables_paginate{
            font-size: 15px;
        }

        .paginate_button.page-item.active a.page-link {
            background-color: #2a3880; 
        }
    </style>
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
                    <h3>Edit Quotation No: {{$quotation->Quotation_No}}</h3>
                </div>   
                <hr class="mt-0 mb-3"> 
                <form action="/update/quotation/{{$quotation->id}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input class="form-control" readonly type="text" placeholder="Input Customer" value="{{$type->name}} ({{$type->alias}})">
                    </div>

                    <div class="form-group">
                        <label for="customer">Customer</label>
                        <input class="form-control" type="text" placeholder="Input Customer" name="customer" value="{{$quotation['Customer']}}">
                    </div>

                    <div class="form-group">
                        <label for="attention">Attention</label>
                        <input class="form-control" type="text" placeholder="Input Attention" name="attention" value="{{$quotation['Attention']}}">
                    </div>

                    <div class="form-group">
                        <label for="payment-term">Payment Term</label>
                        <input class="form-control" type="text" placeholder="Input Payment" name="payment" value="{{$quotation['Payment Term']}}">
                    </div>

                    <div class="form-group">
                        <label for="quotation-no">Quotation No</label>
                        <input class="form-control" type="text" value="{{$quotation->getFormatId($quotation->type_id,$quotation->type_detail_quantity, $quotation['Quotation Date'])}}"  readonly>
                    </div>

                    <div class="form-group">
                        <label for="invoiceDate">Quotation Date</label>
                        <input class="form-control" type="date" placeholder="Input Invoice Date" 
                        onfocus="(this.type='date')" id="invoice-date" name="date" value="{{$quotation['Quotation Date']}}">
                    </div>

                    <div class="form-group">
                        <label for="account-manager">Account Manager</label>
                        <input class="form-control" type="text" placeholder="Input account manager" name="account" value="{{$quotation['Account Manager']}}">
                    </div>

                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input class="form-control" type="text" placeholder="Input Discount" name="discount" value="{{$quotation['Discount']}}">
                    </div>
                    
                    <div class="form-group">
                        <label for="note">Terms & Condition</label>
                        <textarea class="note " name="terms">{{$quotation['Terms']}}</textarea>
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
                        <a href="/quotation" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>   

        <style>
            td{
                white-space: normal !important;
                text-align: justify;
            }
        </style>

        <div class="" style="">
            <div class="rounded border mt-4 mb-4 p-4" style="background-color: #fff;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Quotation Items</h3>
                    <a href="/create/items/{{$quotation->id}}" class="btn btn-primary">Create Item</a>
                </div>
                <hr class="mt-0 mb-3">
                <table class="table pt-2 pb-3" id="datatable" style="width: 100%">
                    <thead>
                        <tr class="font-weight-bold">
                        <th scope="col"><strong>#</strong></th>
                        <th scope="col"><strong>Name</strong></th>
                        <th scope="col"><strong>Description</strong></th>
                        <th scope="col"><strong>Qty</strong></th>
                        <th scope="col"><strong>Unit Price</strong></th>
                        <th scope="col"><strong>Total Price</strong></th>
                        <th scope="col"><strong>Action</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <script type="text/javascript">
                            window.data = {!! json_encode($quotation->id) !!};
                        </script>
                    </tbody>
                </table>
            </div>
        </div>   
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/r-2.2.9/datatables.min.js"></script>
    <script>
        function formatNumber(number){
            number = number.toFixed(0) + '';
            x = number.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }

        var values = window.data;
        $(document).ready( function () {
            $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: `{{url('item/list/${values}')}}`,
            columns : [
                { "data": 'DT_RowIndex'},
                { "data" : "name"},
                { "data" : "description"},
                {   data: 'quantity', 
                    name: 'quantity', 
                    orderable: true, 
                    searchable: true
                },
                {   data: 'unit price', 
                    name: 'unit price', 
                    orderable: true, 
                    searchable: true
                },
                {
                    data: 'Total Price', 
                    name: 'Total Price', 
                    orderable: true, 
                    searchable: true
                },
                {
                    "class":          "details-control",
                    "orderable":      false,
                    "searchable" : false,
                    "data":           'action',
                    "defaultContent": ""
                },   
            ]
            });

        } );
    </script>
@endsection

