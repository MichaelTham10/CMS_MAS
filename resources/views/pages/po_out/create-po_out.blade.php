@extends('layouts.app', ['title' => 'Create Purchase Out Order'])

{{-- title web tab --}}
@section('page-title')
    Create Purchase Out Order
@endsection

{{-- navbar title --}}
{{-- @section('head-title')
    Create Purchase Out Order
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
                    <h3>Create Purchase Out Order</h3>
                </div>    
                <hr class="mt-0 mb-3">
                <form action="/po-out/store" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="poDate">PO Date</label>
                        <input class="form-control" type="date" placeholder="Input PO Date" @error('poDate')
                        is invalid @enderror onfocus="(this.type='date')" id="poDate" name="poDate" value="">
                        @error('poDate')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="poArrivalDate">PO Arrival Date</label>
                        <input class="form-control" type="date" placeholder="Input Arrival Date" @error('poArrivalDate')
                        is invalid @enderror onfocus="(this.type='date')" id="poArrivalDate" name="poArrivalDate" value="">
                        @error('poArrivalDate')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="poTo">PO To</label>
                        <input class="form-control" type="text" placeholder="Input PO Receiver" @error('poTo')
                        is invalid @enderror name="poTo" value="">
                        @error('poTo')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="poAttention">PO Attention</label>
                        <input class="form-control" type="text" placeholder="Input PO Attention" @error('poAttention')
                        is invalid @enderror name="poAttention" value="">
                        @error('poAttention')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="poEmail">PO Email</label>
                        <input class="form-control" type="email" placeholder="Input PO Email" @error('poEmail')
                        is invalid @enderror name="poEmail" value="">
                        @error('poEmail')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="poPPN">PPN</label>
                        <input class="form-control" type="number" placeholder="Input PPN" @error('poPPN')
                        is invalid
                        @enderror name="poPPN">
                        @error('poPPN')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deliverTo">Deliver To</label>
                        <input class="form-control" type="text" placeholder="Input Deliver To" @error('deliverTo')
                        is invalid @enderror name="deliverTo" value="">
                        @error('deliverTo')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="attnMakro">Attn. Makro Team</label>
                        <input class="form-control" type="text" placeholder="Input Attn. Makro Team" @error('attnMakro')
                        is invalid @enderror name="attnMakro" value="">
                        @error('attnMakro')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="makroPhoneNumber">Attn. Phone Number</label>
                        <input class="form-control" type="text" placeholder="Input Attn. Phone Number" @error('makroPhoneNumber')
                        is invalid @enderror name="makroPhoneNumber" value="">
                        @error('makroPhoneNumber')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="poTerms">Terms & Condition</label>
                        <textarea class="note " name="poTerms" @error('poTerms')
                        is invalid @enderror placeholder="Input PO Terms"></textarea>
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
                        @error('poTerms')
                        <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/po-out" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>   
    </div>
@endsection