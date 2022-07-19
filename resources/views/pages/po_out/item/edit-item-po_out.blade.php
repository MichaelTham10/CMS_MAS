@extends('layouts.app', ['title' => 'Edit Item'])

{{-- title web tab --}}
@section('page-title')
    Edit PO Out Item
@endsection

{{-- navbar title --}}
{{-- @section('head-title')
    Edit PO Out Item
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
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Create PO Out Item</h3>
                </div>    
                <hr class="mt-0 mb-3">
                <form action="/update/po_out_item/{{$po_out_id}}/{{$item->id}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="customer">Item Description</label>
                        <input class="form-control" type="text" placeholder="Input Item Description" name="item_description" @error('item_description')
                        is invalid 
                        @enderror value="{{$item->item_description}}">
                        @error('item_description')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="unit-price">Unit Price</label>
                        <input class="form-control" type="number" placeholder="Input Unit Price" name="price" @error('price')
                        is invalid
                        @enderror value="{{$item->price}}">
                        @error('price')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="payment-term">Quantity</label>
                        <input class="form-control" type="number" placeholder="Input Quantity" name="quantity" @error('quantity')
                        is invalid
                        @enderror value="{{$item->qty}}">
                        @error('quantity')
                        <span class="text-danger">{{$message}}</span> 
                    @enderror
                    </div> 
                    <div class="d-flex justify-content-end">
                        <a href="{{route('edit-po-out-controller', $po_out_id)}}" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>   
    </div>
@endsection