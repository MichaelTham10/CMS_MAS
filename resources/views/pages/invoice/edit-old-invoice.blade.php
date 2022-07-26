@extends('layouts.app', ['title' => 'Edit Old Invoice'])

@section('page-title')
    Edit Old Invoice
@endsection

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
                    <h3>Edit Old Invoice</h3>
                </div>   
                <hr class="mt-0 mb-3"> 
                <form action="/update/old/invoice/{{$invoice->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="attention">invoice Number</label>
                        <input class="form-control" type="text" placeholder="Input Invoice Number" @error('invoice_number')
                        is invalid @enderror name="invoice_number" value="{{$invoice->Invoice_No}}">
                        @error('invoice_number')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="attention">File Upload</label>
                        <input class="form-control" type="file" placeholder="Upload File" name="file" value="" accept="application/pdf" >
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <a href="/old/invoice" class="btn btn-light">Cancel</a>
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
    </div>
@endsection

