@extends('layouts.app', ['title' => 'Edit Item'])

{{-- title web tab --}}
@section('page-title')
    Edit Quotation Item
@endsection

{{-- navbar title --}}
{{-- @section('head-title')
    Edit Item
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
            <div class="mb-3">
                <h3>Edit item - {{$item->name}}</h3>
            </div>   
            <hr class="mt-0 mb-3"> 
            <div class="font-weight-bold">
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
                                forced_root_block : '',
                                selector:'textarea.note',
                                height: 300,
                            });
                        </script>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{route('edit-controller', $quotation_id)}}" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div> 
        </div>   
    </div>
@endsection