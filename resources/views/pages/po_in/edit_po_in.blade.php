@extends('layouts.app', ['title' => 'Edit Quotation'])

{{-- title web tab --}}
@section('page-title')
    Edit Purchase In Order
@endsection

{{-- navbar title --}}
{{-- @section('head-title')
    Edit Purchase In Order
@endsection --}}
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/r-2.2.9/datatables.min.css"/>
@endsection

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
                        <label for="type">Attention</label>
                        <input class="form-control" type="text" placeholder="Input Customer" @error('attention')
                        is invalid @enderror name="attention" value="{{$purchaseIn->attention}}">
                        @error('attention')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="customer">Customer Number</label>
                        <input class="form-control" type="text" placeholder="Input Customer" @error('customer_number')
                        is invalid @enderror name="customer_number" value="{{$purchaseIn->customer_number}}">
                        @error('customer_number')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="attention">Company Name</label>
                        <input class="form-control" type="text" placeholder="Input Attention" @error('company_name')
                        is invalid @enderror name="company_name" value="{{$purchaseIn->company_name}}">
                        @error('company_name')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="payment-term">Date</label>
                        <input class="form-control" type="datetime-local" placeholder="Input Payment" name="date" value="{{$purchaseIn->date}}">
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

        {{-- <div class="" style="">
            <div class="rounded border mt-4" style="background-color: #fff;padding: 10px;">
                <div style="padding: 2px;">
                    Items
                </div>
                <hr class="mt-0 mb-0">
                <div class="btn-create">
                    <a href="/create/items/{{$quotation->id}}" class="btn btn-primary">create</a>
                </div>
                <table class="table" id="datatable" style="width: 100%">
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
        </div>    --}}
    </div>   
@endsection



