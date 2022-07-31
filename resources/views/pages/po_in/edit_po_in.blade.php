@extends('layouts.app', ['title' => 'Edit Purchase In Order'])

@section('page-title')
    Edit Purchase In Order
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/r-2.2.9/datatables.min.css"/>
@endsection
<style>
    .dataTables_length, .dataTables_filter, .dataTables_info, .dataTables_paginate{
        font-size: 15px;
    }
    .paginate_button.page-item.active a.page-link {
        background-color: #2a3880; 
    }
    td{
        white-space: normal !important;
        text-align: justify;
    }
</style>
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
                    <h3>Edit Purchase In Order</h3>
                </div>   
                <hr class="mt-0 mb-3"> 
                <form action="/edit_po_in/update/{{$purchaseIn->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="customer">Customer Number</label>
                        <input class="form-control" type="text" placeholder="Input Customer" @error('customer_number')
                        is invalid @enderror name="customer_number" value="{{$purchaseIn->customer_number}}">
                        @error('customer_number')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="attention">Customer Name</label>
                        <input class="form-control" type="text" placeholder="Input Customer Name" @error('customer_name')
                        is invalid @enderror name="customer_name" value="{{$purchaseIn->customer_name}}">
                        @error('customer_name')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="attention">PO Date</label>
                        <input class="form-control" type="date" placeholder="Input Date" @error('po_date')
                        is invalid @enderror name="po_date" value="" required>
                        @error('po_date')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="attention">File Upload</label>
                        <input class="form-control" type="file" placeholder="Upload File" name="file" value="" accept="application/pdf" >
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <a href="/po_in" class="btn btn-light">Cancel</a>
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
                    <h3>Purchase In Items</h3>
                    <a href="/po_in/create/item/{{$purchaseIn->id}}" class="btn btn-primary">Create Item</a>
                </div>
                <hr class="mt-0 mb-3">
                <table class="table pt-2 pb-3" id="datatable" style="width: 100%; table-layout: fixed; word-wrap: break-word;">
                    <thead>
                        <tr class="font-weight-bold">
                            <th scope="col" style="width: 1%"><strong>#</strong></th>
                            <th scope="col" style="width: 10%"><strong>Name</strong></th>
                            <th scope="col" style="width: 35%"><strong>Item Description</strong></th>
                            <th scope="col"><strong>Quantity</strong></th>
                            <th scope="col"><strong>Unit Price</strong></th>
                            <th scope="col"><strong>Total Price</strong></th>
                            <th scope="col" style="width: 8%"><strong>Action</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <script type="text/javascript">
                            window.data = {!! json_encode($purchaseIn->id) !!};
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
        var po_in_id = window.data;
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

        $(document).ready( function () {
            $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: `{{url('/po_in/item/list/${po_in_id}')}}`,
            columns : [
                { "data": 'DT_RowIndex'},
                { "data" : "name"},
                { "data" : "description"},
                {   data: 'quantity', 
                    name: 'quantity', 
                    orderable: true, 
                    searchable: true
                },
                {   data: 'price', 
                    name: 'price', 
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


