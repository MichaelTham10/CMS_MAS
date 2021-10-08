@extends('layouts.app', ['title' => 'Create Item'])

@section('head-title')
    Create Item
@endsection

@section('page-title')
    Create Item
@endsection

@section('content')
@include('layouts.headers.cards')
    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4" style="background-color: #fff">
        <form action="/item/store/{{$id}}" method="POST">
            @csrf
            <div class="pl-4 pt-4 pr-4 font-weight-bold">
                
                
                <div class="form-group">
                    <label for="customer">Name</label>
                    <input class="form-control" type="text" placeholder="Input Name" name="name" @error('name')
                    is invalid
                    @enderror>
                    @error('name')
                        <span class="text-danger">{{$message}}</span> 
                    @enderror
                </div>

                <div class="form-group">
                    <label for="unit-price">Unit Price</label>
                    <input class="form-control" type="number" placeholder="Input Unit Price" name="price" @error('price')
                    is invalid
                    @enderror>
                    @error('price')
                            <span class="text-danger">{{$message}}</span> 
                    @enderror
                </div>

                <div class="form-group">
                    <label for="payment-term">Quantity</label>
                    <input class="form-control" type="number" placeholder="Input Quantity" name="quantity" @error('quantity')
                    is invalid
                    @enderror>
                    @error('quantity')
                    <span class="text-danger">{{$message}}</span> 
                @enderror
                </div>
                
                <div class="form-group">
                    <label for="note">Description</label>
                    <textarea class="note " name="description" @error('description')
                    is invalid
                    @enderror></textarea>
                    @error('description')
                            <span class="text-danger">{{$message}}</span> 
                    @enderror
                    <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                    <script>
                        tinymce.init({
                            forced_root_block : '',
                            selector:'textarea.note',
                            width: 1140,
                            height: 300,
                        });
                    </script>
                </div>
                
            </div>

            <div class="d-flex justify-content-end pl-4 pr-4 pb-4 ">
                <a href="{{route('edit-controller', $id)}}" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
            
        </div>   
    </div>
@endsection
