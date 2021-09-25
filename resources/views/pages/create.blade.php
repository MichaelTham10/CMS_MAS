@extends('layouts.app', ['title' => 'Create Quotation'])

@section('content')
@include('layouts.headers.cards')
    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4" style="background-color: #fff">
            <div class="pl-4 pt-4 pr-4 font-weight-bold">
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
                        @enderror name="terms">Terms and condition\n aaaaa</textarea>
                        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                        <script>
                            tinymce.init({
                                selector:'textarea.note',
                                width: 940,
                                height: 300,
                            });
                        </script>
                    </div>
                    <div class="pr-4 pb-4">
                        <button type="submit" class="btn btn-primary">Store</button>
                        <button type="button" class="btn btn-light">Cancel</button>
                    </div>
                </form>

            </div>

            
        </div>   
    </div>
@endsection