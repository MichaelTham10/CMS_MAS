@extends('layouts.app', ['title' => 'Edit Item'])

@section('content')
@include('layouts.headers.cards')
    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4" style="background-color: #fff">
            <div class="pl-4 pt-4 pr-4 font-weight-bold">
               
                
                <form action="/update/item/{{$quotation_id}}/{{$item->id}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="customer">Name</label>
                        <input class="form-control" type="text" placeholder="Input Name" name="name" @error('name')
                            is invalid
                        @enderror value="{{$item->name}}">
                        @error('name')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="attention">Unit Price</label>
                        <input class="form-control" type="number" placeholder="Input Unit Price" name="price" @error('price')
                            is invalid
                        @enderror value="{{$item['unit price']}}">
                        @error('price')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="payment-term">Quantity</label>
                        <input class="form-control" type="number" placeholder="Input Quantity" name="quantity"  @error('quantity')
                        is invalid
                        @enderror value="{{$item->quantity}}">
                        @error('quantity')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="note">Description</label>
                        <textarea class="note " name="description" @error('description')
                        is invalid
                        @enderror >{{$item->description}}</textarea>
                        @error('description')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                        <script>
                            tinymce.init({
                                selector:'textarea.note',
                                width: 970,
                                height: 300,
                            });
                        </script>
                    </div>
                    <div class="d-flex justify-content-end pl-4 pr-4 pb-4 ">
                        <a href="{{route('edit-controller', $quotation_id)}}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

           
        </div>   
    </div>
@endsection