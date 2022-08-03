@extends('layouts.app', ['title' => 'Create Purchase In Item'])

{{-- title web tab --}}
@section('page-title')
    Create Purchase In Item
@endsection

@section('content')
@include('layouts.headers.cards')
    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4 p-4" style="background-color: #fff">
            <div class="mb-3">
                <h3>Create Purchase In Item</h3>
            </div>   
            <hr class="mt-0 mb-3"> 
            <form action="/po_in/store_item/{{$id}}" method="POST">
                @csrf
                <div class="font-weight-bold">
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
                                plugins: 'lists',
                                toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist',
                                height: 300,
                            });
                        </script>
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
                        <label for="unit-price">Unit Price</label>
                        <input class="form-control" type="number" placeholder="Input Unit Price" name="price" @error('price')
                        is invalid
                        @enderror>
                        @error('price')
                                <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{route('edit_po_in', $id)}}" class="btn btn-light">Back</a>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>   
    </div>
@endsection
