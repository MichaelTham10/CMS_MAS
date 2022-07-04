@extends('layouts.app', ['title' => 'Create Purchase Out Order'])

@section('head-title')
    Create Purchase Out Order
@endsection

@section('page-title')
    Create Purchase Out Order
@endsection

@section('content')
@include('layouts.headers.cards')
    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4" style="background-color: #fff">
            <div class="pl-4 pt-4 pr-4 font-weight-bold">
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
                        <input class="form-control" type="text" placeholder="Input PO Email" @error('poEmail')
                        is invalid @enderror name="poEmail" value="">
                        @error('poEmail')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="poTerms">Terms & Condition</label>
                        <textarea class="note " name="poTerms" @error('poEmail')
                        is invalid @enderror placeholder="Input PO Terms"></textarea>
                        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                        <script>
                            tinymce.init({
                                forced_root_block : '',
                                selector:'textarea.note',
                                width: 1140,
                                height: 300,
                            });
                        </script>
                        @error('poTerms')
                        <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end pl-4 pr-4 pb-4 ">
                        <a href="/po-out" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>   
    </div>
@endsection