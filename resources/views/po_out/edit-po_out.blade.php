@extends('layouts.app', ['title' => 'Edit Purchase Order Out'])

@section('head-title')
    Edit Purchase Order Out
@endsection

@section('page-title')
    Edit Purchase Order Out
@endsection

@section('content')
@include('layouts.headers.cards')
    @if(Session::has('success'))

            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{Session::get('success')}}</strong>
            </div>

    @endif

    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4" style="background-color: #fff">
            <div class="pl-4 pt-4 pr-4 font-weight-bold">
                <div>
                    Edit PO No: {{$po_out['po_out_no']}}
                </div>
                <hr class="mt-2 mb-2">
                <form action="/update/po-out/{{$po_out->id}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="poDate">PO Date</label>
                        <input class="form-control" type="date" placeholder="Input PO Date"  @error('poDate')
                        is invalid @enderror onfocus="" readonly id="poDate" name="poDate" value="{{$po_out['date']}}">
                        @error('poDate')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="poArrivalDate">PO Arrival Date</label>
                        <input class="form-control" type="date" placeholder="Input Arrival Date" @error('poArrivalDate')
                        is invalid @enderror onfocus="" id="poArrivalDate" name="poArrivalDate" value="{{$po_out['arrival']}}">
                        @error('poArrivalDate')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="poTo">PO To</label>
                        <input class="form-control" type="text" placeholder="Input PO Receiver" @error('poTo')
                        is invalid @enderror name="poTo" value="{{$po_out['to']}}">
                        @error('poTo')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="poAttention">PO Attention</label>
                        <input class="form-control" type="text" placeholder="Input PO Attention" @error('poAttention')
                        is invalid @enderror name="poAttention" value="{{$po_out['attn']}}">
                        @error('poAttention')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="poEmail">PO Email</label>
                        <input class="form-control" type="text" placeholder="Input PO Email" @error('poEmail')
                        is invalid @enderror name="poEmail" value="{{$po_out['email']}}">
                        @error('poEmail')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="poPPN">PPN</label>
                        <input class="form-control" type="number" placeholder="Input PPN" @error('poPPN')
                        is invalid @enderror name="poPPN" value="{{$po_out['ppn']}}">
                        @error('poPPN')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deliverTo">Deliver To</label>
                        <input class="form-control" type="text" placeholder="Input Deliver To" name="deliverTo" @error('deliver_to')
                        is invalid @enderror value="{{$po_out['deliver_to']}}">
                        @error('deliverTo')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="attnMakro">Attn. Makro Team</label>
                        <input class="form-control" type="text" placeholder="Input Attn. Makro Team" name="attnMakro" @error('attnMakro')
                        is invalid @enderror value="{{$po_out['attn_makro']}}">
                        @error('attnMakro')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="makroPhoneNumber">Attn. Phone Number</label>
                        <input class="form-control" type="text" placeholder="Input Attn. Phone Number" name="makroPhoneNumber" @error('makro_phone_no')
                        is invalid @enderror value="{{$po_out['makro_phone_no']}}">
                        @error('makroPhoneNumber')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="poTerms">Terms & Condition</label>
                        <textarea class="note" name="poTerms" @error('poTerms')
                        is invalid @enderror>{{$po_out['terms']}}</textarea>
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

