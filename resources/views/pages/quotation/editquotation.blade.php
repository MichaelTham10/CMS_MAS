@extends('layouts.app', ['title' => 'Edit Quotation'])

@section('head-title')
    Edit Quotation
@endsection

@section('page-title')
    Edit Quotation
@endsection

@section('styles')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/r-2.2.9/datatables.min.css"/>
    
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
                    Edit Quotation No: {{$quotation->Quotation_No}}
                </div>
                <hr class="mt-2 mb-2">
                <form action="/update/quotation/{{$quotation->id}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                      <label for="type">Type</label>
                      <input class="form-control" readonly type="text" placeholder="Input Customer" value="{{$type->name}} ({{$type->alias}})">
                    </div>

                    <div class="form-group">
                        <label for="customer">Customer</label>
                        <input class="form-control" type="text" placeholder="Input Customer" name="customer" value="{{$quotation['Customer']}}">
                    </div>

                    <div class="form-group">
                        <label for="attention">Attention</label>
                        <input class="form-control" type="text" placeholder="Input Attention" name="attention" value="{{$quotation['Attention']}}">
                    </div>

                    <div class="form-group">
                        <label for="payment-term">Payment Term</label>
                        <input class="form-control" type="text" placeholder="Input Payment" name="payment" value="{{$quotation['Payment Term']}}">
                    </div>

                    <div class="form-group">
                        <label for="quotation-no">Quotation No</label>
                        <input class="form-control" type="text" value="{{$quotation->getFormatId($quotation->type_id,$quotation->type_detail_quantity, $quotation['Quotation Date'])}}"  readonly>
                    </div>

                    <div class="form-group">
                        <label for="invoiceDate">Quotation Date</label>
                        <input class="form-control" type="date" placeholder="Input Invoice Date" 
                        onfocus="(this.type='date')" id="invoice-date" name="date" value="{{$quotation['Quotation Date']}}">
                    </div>

                    <div class="form-group">
                        <label for="account-manager">Account Manager</label>
                        <input class="form-control" type="text" placeholder="Input account manager" name="account" value="{{$quotation['Account Manager']}}">
                    </div>

                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input class="form-control" type="text" placeholder="Input Discount" name="discount" value="{{$quotation['Discount']}}">
                    </div>
                    
                    <div class="form-group">
                        <label for="note">Terms & Condition</label>
                        <textarea class="note " name="terms">{{$quotation['Terms']}}</textarea>
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
                        <button type="button" class="btn btn-light">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

            
        </div>   

        <style>
            td{
              white-space: normal !important;
              text-align: justify;
            }
        </style>

        <div style="background-color: #fff; width: 100%; height: 100%;">
            <div>
                <div>
                    Items
                </div>
                <hr class="mt-2 mb-2">
                <div class="d-flex pb-2 align-self-center justify-content-between">
                    <div class="d-flex align-self-center float-left">
                        <a href="/create/items/{{$quotation->id}}" class="btn btn-primary">create</a>
                    </div>
                </div>
            
                <table class="table" id="datatable">
                    <thead>
                        <tr class="font-weight-bold">
                        <th scope="col"><strong>#</strong></th>
                        <th scope="col"><strong>Name</strong></th>
                        <th scope="col"><strong>Description</strong></th>
                        <th scope="col"><strong>Qty</strong></th>
                        <th scope="col"><strong>Unit Price</strong></th>
                        <th scope="col"><strong>Total Price</strong></th>
                        <th scope="col"><strong>Action</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <script type="text/javascript">
                            window.data = {!! json_encode($quotation->id) !!};
                        </script>
                    </tbody>
                </table>
            </div>
        </div>   
    </div>
    
    
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/r-2.2.9/datatables.min.js"></script>
    
    <script>
        var values = window.data;
        $(document).ready( function () {
          $('#datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: `{{url('item/list/${values}')}}`,
          columns : [
              { "data": 'DT_RowIndex'},
              { "data" : "name"},
              { "data" : "description"},
              { "data" : "quantity"},
              { "data" : "unit price"},
              {
                data: 'Total Price', 
                name: 'Total Price', 
                orderable: true, 
                searchable: true
              },
              {
                "class":          "details-control",
                "orderable":      false,
                "searchable" : false,
                "data":           'action',
                "defaultContent": ""
              },   
          ]
        });

    } );
</script>
    
@endsection

