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
                        <input class="form-control" type="date" placeholder="Input PO Date" 
                        onfocus="(this.type='date')" id="poDate" name="poDate" value="{{$po_out['date']}}">
                    </div>

                    <div class="form-group">
                        <label for="poArrivalDate">PO Arrival Date</label>
                        <input class="form-control" type="date" placeholder="Input Arrival Date" 
                        onfocus="(this.type='date')" id="poArrivalDate" name="poArrivalDate" value="{{$po_out['arrival']}}">
                    </div>

                    <div class="form-group">
                        <label for="poTo">PO To</label>
                        <input class="form-control" type="text" placeholder="Input PO Receiver" name="poTo" value="{{$po_out['to']}}">
                    </div>

                    <div class="form-group">
                        <label for="poAttention">PO Attention</label>
                        <input class="form-control" type="text" placeholder="Input PO Attention" name="poAttention" value="{{$po_out['attn']}}">
                    </div>

                    <div class="form-group">
                        <label for="poEmail">PO Email</label>
                        <input class="form-control" type="text" placeholder="Input PO Email" name="poEmail" value="{{$po_out['email']}}">
                    </div>
                    
                    <div class="form-group">
                        <label for="poTerms">Terms & Condition</label>
                        <textarea class="note " name="poTerms">{{$po_out['terms']}}</textarea>
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
                    <div class="d-flex justify-content-end pl-4 pr-4 pb-4 ">
                        <a href="/po-out" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div> 
        </div>    
    </div> 
@endsection

