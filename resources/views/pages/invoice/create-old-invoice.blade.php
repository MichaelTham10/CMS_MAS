@extends('layouts.app', ['title' => 'Create Old Invoice'])

{{-- title web tab --}}
@section('page-title')
    Create Old Invoice
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
                    <h3>Create Old Invoice</h3>
                </div>   
                <hr class="mt-0 mb-3"> 
                <form action="/old/invoice/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="invoice-number">Invoice No</label>
                        <input class="form-control" type="text" placeholder="Input Invoice Number" @error('invoice_number')
                        is invalid @enderror name="invoice_number">
                        @error('invoice_number')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="attention">File Upload</label>
                        <input class="form-control" type="file" placeholder="Upload File" @error('file')
                        is invalid @enderror name="file" value="" accept="application/pdf" >
                        @error('file')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/old/invoice" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary">Store</button>
                    </div>
                </form>
            </div>
        </div>   
    </div>
@endsection