@extends('layouts.app', ['title' => 'Create Old Purchase In'])

{{-- title web tab --}}
@section('page-title')
    Create Old Purchase In
@endsection

{{-- navbar title --}}
{{-- @section('head-title')
    Create Quotation
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
                    <h3>Create Old Purchase In</h3>
                </div>   
                <hr class="mt-0 mb-3"> 
                <form action="/po_in/old/create" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="purchase_number">Purchase Number</label>
                        <input class="form-control" type="text" placeholder="Input Purchase Number" @error('purchase_number')
                        is invalid @enderror name="purchase_number">
                        @error('purchase_number')
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
                        <a href="/po_in/old" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary">Store</button>
                    </div>
                </form>
            </div>
        </div>   
    </div>
@endsection