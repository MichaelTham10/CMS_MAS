@extends('layouts.app', ['title' => 'Create Item'])

@section('content')
@include('layouts.headers.cards')
    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4" style="background-color: #fff">
            <div class="pl-4 pt-4 pr-4 font-weight-bold">
                <div>
                    Create 
                </div>
                <hr class="mt-2 mb-2">
                <form>
                    <div class="form-group">
                        <label for="customer">Name</label>
                        <input class="form-control" type="text" placeholder="Input Name">
                    </div>

                    <div class="form-group">
                        <label for="unit-price">Unit Price</label>
                        <input class="form-control" type="number" placeholder="Input Unit Price">
                    </div>

                    <div class="form-group">
                        <label for="payment-term">Quantity</label>
                        <input class="form-control" type="number" placeholder="Input Quantity">
                    </div>
                    
                    <div class="form-group">
                        <label for="note">Description</label>
                        <textarea class="note " name="note"></textarea>
                        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                        <script>
                            tinymce.init({
                                selector:'textarea.note',
                                width: 970,
                                height: 300,
                            });
                        </script>
                    </div>
                </form>
            </div>

            <div class="d-flex justify-content-end pl-4 pr-4 pb-4 ">
                <a href="{{route('edit-controller')}}" class="btn btn-light">Cancel</a>
                <button type="button" class="btn btn-primary">Create</button>
            </div>
        </div>   
    </div>
@endsection
