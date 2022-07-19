@extends('layouts.app', ['title' => 'Create Quotation'])

{{-- title web tab --}}
@section('page-title')
    Create Quotation
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
                    <h3>Create Quotation</h3>
                </div>   
                <hr class="mt-0 mb-3"> 
                <form action="/quotation/store" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            @foreach ($types as $type)
                            <option value="{{$type->id}}">{{$type->name}} ({{$type->alias}})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="customer">Customer</label>
                        <input class="form-control" type="text" placeholder= "Input Customer" @error('customer')
                        is invalid
                        @enderror name="customer">
                        @error('customer')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="attetion">Attention</label>
                        <input class="form-control" type="text" placeholder= "Input Attention" @error('attention')
                        is invalid
                        @enderror name="attention">
                        @error('attention')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="attetion">Payment Term</label>
                        <input class="form-control" type="text" placeholder= "Input Payment Term" @error('payment')
                        is invalid
                        @enderror name="payment">
                        @error('payment')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="quotation-number">Quotation No</label>
                        <input class="form-control" type="text" placeholder="AUTO GENERATE" readonly>
                    </div>

                    <div class="form-group">
                        <label for="quotationDate">Quotation Date</label>
                        <input class="form-control" type="date" placeholder="Input Invoice Date" @error('date')
                        is invalid
                        @enderror
                        onfocus="(this.type='date')" id="quotation-date" name="date">
                        @error('date')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="account">Account Manager</label>
                        <input class="form-control" type="text" placeholder="Input Account Manager" @error('discount')
                        is invalid
                        @enderror name="account">
                        @error('account')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input class="form-control" type="number" placeholder="Input Discount" @error('discount')
                        is invalid
                        @enderror name="discount">
                        @error('discount')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="note">Terms & Condition</label>
                        <textarea class="note" @error('terms')
                        is invalid
                        @enderror name="terms"></textarea>
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
                        <a href="/quotation" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary">Store</button>
                    </div>
                </form>
            </div>
        </div>   
    </div>
@endsection