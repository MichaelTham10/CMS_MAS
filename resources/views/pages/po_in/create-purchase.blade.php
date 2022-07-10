@extends('layouts.app', ['title' => 'Create Purchase In'])

@section('head-title')
    Create Purchase In
@endsection

@section('page-title')
    Create Purchase In
@endsection

@section('styles')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/r-2.2.9/datatables.min.css"/>
    
@endsection

@section('content')

{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/r-2.2.9/datatables.min.css"/> --}}
<style>
    .dataTables_length, .dataTables_filter, .dataTables_info, .dataTables_paginate{
    font-size: 14px;
    padding-left: 5px;
    padding-right: 5px;
  }
  .btn-create{
    padding: 5px;
    position: relative;
    left: 90.2%;
  }
</style>
@include('layouts.headers.cards')
    @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{Session::get('success')}}</strong>
        </div>
    @endif

    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4" style="background-color: #fff">
            <div class="pl-4 pt-4 pr-4 font-weight-bold">
                <div>
                    Create Purchase In:
                </div>
                <hr class="mt-2 mb-2">
                <form action="/po_in/create/" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                      <label for="type">Attention</label>
                      <input class="form-control" type="text" placeholder="Input Customer" name="attention" value="">
                    </div>

                    <div class="form-group">
                        <label for="customer">Customer Number</label>
                        <input class="form-control" type="text" placeholder="Input Customer" name="customer number" value="">
                    </div>

                    <div class="form-group">
                        <label for="attention">Company Name</label>
                        <input class="form-control" type="text" placeholder="Input Attention" name="company name" value="">
                    </div>

                    <div class="form-group">
                        <label for="attention">File Upload</label>
                        <input class="form-control" type="file" placeholder="Upload File" name="file" value="" accept="application/pdf" >
                    </div>

                    
                    <div class="d-flex justify-content-end pl-4 pr-4 pb-4 ">
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



