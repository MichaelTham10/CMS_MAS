@extends('layouts.app', ['title' => 'Edit Item'])

@section('head-title')
    Edit Purchase Out Item
@endsection

@section('page-title')
    Edit Purchase Out Item
@endsection

@section('content')
@include('layouts.headers.cards')
    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4" style="background-color: #fff">
            <div class="pl-4 pt-4 pr-4 font-weight-bold">
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
                    <div class="d-flex justify-content-end pl-4 pr-4 pb-4 ">
                        <a href="{{route('edit-po-out-controller', $po_out_id)}}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>   
    </div>
@endsection