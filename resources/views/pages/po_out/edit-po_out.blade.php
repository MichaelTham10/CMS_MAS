@extends('layouts.app', ['title' => 'Edit Purchase Order Out'])

{{-- title web tab --}}
@section('page-title')
    Edit Purchase Out Order
@endsection

{{-- navbar title --}}
{{-- @section('head-title')
    Edit Purchase Out Order
@endsection --}}

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
                    <h3>Edit PO Out {{$po_out['po_out_no']}}</h3>
                </div>   
                <hr class="mt-0 mb-3"> 
                <form action="/update/po-out/{{$po_out->id}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="poDate">PO Date</label>
                        <input class="form-control" type="date" placeholder="Input PO Date"  @error('poDate')
                        is invalid @enderror onfocus="" readonly id="poDate" name="poDate" value="{{$po_out['date']}}">
                        @error('poDate')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="poArrivalDate">PO Arrival Date</label>
                        <input class="form-control" type="date" placeholder="Input Arrival Date" @error('poArrivalDate')
                        is invalid @enderror onfocus="" id="poArrivalDate" name="poArrivalDate" value="{{$po_out['arrival']}}">
                        @error('poArrivalDate')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="poTo">PO To</label>
                        <input class="form-control" type="text" placeholder="Input PO Receiver" @error('poTo')
                        is invalid @enderror name="poTo" value="{{$po_out['to']}}">
                        @error('poTo')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="poAttention">PO Attention</label>
                        <input class="form-control" type="text" placeholder="Input PO Attention" @error('poAttention')
                        is invalid @enderror name="poAttention" value="{{$po_out['attn']}}">
                        @error('poAttention')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="poEmail">PO Email</label>
                        <input class="form-control" type="text" placeholder="Input PO Email" @error('poEmail')
                        is invalid @enderror name="poEmail" value="{{$po_out['email']}}">
                        @error('poEmail')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="poPPN">PPN</label>
                        <input class="form-control" type="number" placeholder="Input PPN" @error('poPPN')
                        is invalid @enderror name="poPPN" value="{{$po_out['ppn']}}">
                        @error('poPPN')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deliverTo">Deliver To</label>
                        <input class="form-control" type="text" placeholder="Input Deliver To" name="deliverTo" @error('deliver_to')
                        is invalid @enderror value="{{$po_out['deliver_to']}}">
                        @error('deliverTo')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="attnMakro">Attn. Makro Team</label>
                        <input class="form-control" type="text" placeholder="Input Attn. Makro Team" name="attnMakro" @error('attnMakro')
                        is invalid @enderror value="{{$po_out['attn_makro']}}">
                        @error('attnMakro')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="makroPhoneNumber">Attn. Phone Number</label>
                        <input class="form-control" type="text" placeholder="Input Attn. Phone Number" name="makroPhoneNumber" @error('makro_phone_no')
                        is invalid @enderror value="{{$po_out['makro_phone_no']}}">
                        @error('makroPhoneNumber')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="poTerms">Terms & Condition</label>
                        <textarea class="note" name="poTerms" @error('poTerms')
                        is invalid @enderror>{{$po_out['terms']}}</textarea>
                        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                        <script>
                            tinymce.init({
                                forced_root_block : '',
                                selector:'textarea.note',
                                height: 300,
                            });
                        </script>
                        @error('poTerms')
                        <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/po-out" class="btn btn-light">Back</a>
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
            <div class="rounded border mt-4 mb-4 p-4" style="background-color: #fff">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>PO Out Items</h3>
                    <a href="/create/po_out_item/{{$po_out['id']}}" class="btn btn-primary">Create Item</a>
                </div>    
                <hr class="mt-0 mb-3">
                <table class="table pt-2 pb-3" id="datatable" style="width: 100%">
                    <thead>
                        <tr class="font-weight-bold">
                        <th scope="col"><strong>#</strong></th>
                        <th scope="col"><strong>Item Description</strong></th>
                        <th scope="col"><strong>Qty</strong></th>
                        <th scope="col"><strong>Unit Price</strong></th>
                        <th scope="col"><strong>Total Price</strong></th>
                        <th scope="col"><strong>Action</strong></th>
                        </tr>
                </thead>
                <tbody>
                    <script type="text/javascript">
                            window.data = {!! json_encode($po_out['id']) !!};
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
        var values = window.data;
        $(document).ready( function () {
            $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: `{{url('/po-out-item/list/${values}')}}`,
            columns : [
                { "data": 'DT_RowIndex'},
                { "data" : "item_description"},
                { "data" : "qty"},
                { "data" : "price"},
                {
                    data: 'Total Price', 
                    name: 'Total Price', 
                    orderable: true, 
                    searchable: true
                },
                {
                    "class": "details-control",
                    "orderable": false,
                    "searchable": false,
                    "data": 'action',
                    "defaultContent": ""
                },   
            ]
        });

    } );
</script>
    
@endsection

