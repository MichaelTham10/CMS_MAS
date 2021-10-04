@extends('layouts.app', ['title' => 'Invoice'])

@section('content')
@include('layouts.headers.cards')
<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <style>
      .modal-body-detail{
        height: 400px; 
        overflow: hidden;
      }
      .modal-body-detail:hover{
        overflow-y:auto;
      }
      .pding{
        padding:0 1.5rem 0 1.5rem;
      }
      .edit
      {
        overflow-wrap: break-word;
        word-wrap: break-word;
        hyphens: auto;
      }
      td{
        white-space: normal !important;
        text-align: justify;
      }
    </style>

    @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{Session::get('success')}}</strong>
        </div>
    @endif
        
    <div class="container-fluid">
        <div class="rounded border mt-4" style="background-color: #fff">
            <div class="d-flex p-2 align-self-center justify-content-between">
                {{-- <div class="d-flex">
                    <div class="d-flex align-self-center">
                        show
                    </div>
                    <div class="pl-2 pr-2">
                        <select class="custom-select" aria-label="Default select example">
                            <option selected="five"><a href="">5</a></option>
                            <option value="ten"><a href="">10</a></option>
                            <option value="fifteen">15</option>
                            <option value="twenty">20</option>
                            <option value="twenty-five">25</option>
                        </select>
                    </div>
                    <div class="d-flex align-self-center">
                        entries
                    </div>
                </div> --}}
                {{-- <div>
                    <div class="input-group rounded">
                        <input type="search" class="form-control rounded pr-5" placeholder="Search" aria-label="Search"
                          aria-describedby="search-addon" />
                      </div>
                </div> --}}
                <div class="d-flex align-self-center">
                    <a class="btn btn-primary" href="{{route('create-invoice')}}">create</a>
                </div>
            </div>
    
            <table class="table" id="datatable">
                <thead>
                  <tr class="font-weight-bold">
                    <th scope="col"><strong>#</strong></th>
                    <th scope="col"><strong>Invoice No</strong></th>
                    <th scope="col"><strong>Invoice Date</strong></th>
                    <th scope="col"><strong>Bill To</strong></th>
                    <th scope="col"><strong>Quotation No</strong></th>
                    <th scope="col"><strong>Action</strong></th>
                  </tr>
                </thead>
                <tbody>
                  <script type="text/javascript">
                    window.data = {!! json_encode($items) !!};
                  </script>
                    @foreach ($invoices as $invoice)
                      {{-- @php
                        $totalprice = 0;
                      @endphp --}}
                    {{-- <tr> --}}
                      {{-- <th scope="row">{{$loop->iteration}}</th>
                      <td>{{$invoice->getFormatId($invoice->type_id,$invoice->type_detail_quantity, $invoice['Invoice Date'])}}</td>
                      <td>{{$invoice['Invoice Date']}}</td>
                      <td>{{$invoice['Bill To']}}</td>
                      <td>{{$invoice->quotation->Quotation_No}}</td>
                      <td>
                        <div class="btn-group">
                          <a href=""  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalDetail{{$invoice->id}}">Detail</a>
                          <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('edit-invoice-controller', $invoice['id'])}}">Edit</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete{{$invoice->id}}" href="#">Delete</a>
                            <a class="dropdown-item" href="#">Export PDF</a>
                          </div>
                        </div>
                      </td> --}}
                    {{-- </tr>  --}}
                    @endforeach
                </tbody>
              </table>
        </div>

        <div class="d-flex justify-content-center pt-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav>
        </div>
      </div>
@endsection


{{-- <div class="modal fade" id="modalDetail{{$invoice->id}}" aria-labelledby="myLargeModalLabel" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Stock in detail</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body pt-0 warp modal-body-detail">
        <table class="table table-bordered table-sm">
          <thead>
            <tr class="font-weight-bold">
              <th scope="col" style="width:5%;"><strong>#</strong></th>
              <th scope="col" style="width:15%;"><strong>Name</strong></th>
              <th scope="col" style="width:45%;"><strong>Description</strong></th>
              <th scope="col" style="width:5%;"><strong>Qty</strong></th>
              <th scope="col" style="width:15%;"><strong>Unit Price</strong></th>
              <th scope="col" style="width:15%;"><strong>Total Price</strong></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($invoice->items($invoice['Quotation No']) as $item)
              <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$item->name}}</td>
                <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;">{!!$item->description!!}</td>
                <td>{{$item->quantity}}</td>
                <td>Rp. {{number_format($item['unit price'])}}</td>
                <td>Rp. {{number_format($item['unit price'] * $item->quantity)}}</td>
              </tr>
              @php
                  $totalprice += $item['unit price'] * $item->quantity
              @endphp
            @endforeach
          </tbody>
        </table>
      </div>
      <br>
      <div class="pding table-responsive">
        <div class="table-responsive m-10">
          <table class="table table-bordered no-margin table-sm">
            <tr>
              <th colspan="2" style="width:78.5%" scope="row">Discount</th>
              <td>Rp. {{number_format(($invoice->quotation->Discount*$totalprice)/100)}}</td>
            </tr>
            <tr>
              <th colspan="2" scope="row">Grand Total</th>
              <td>Rp. {{number_format($totalprice-($invoice->quotation->Discount*$totalprice)/100)}}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div> --}}
{{-- 
<form action="/delete/invoice/{{$invoice->id}}" method="POST">
  @csrf
  @method('DELETE')
  <div class="modal fade" id="ModalDelete{{$invoice->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container d-flex pl-0"><img src="">
                    <h3 class="modal-title ml-2" id="exampleModalLabel">Delete this item?</h3>
                </div> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <p class="text-muted">If you remove this item it will be gone forever. Are you sure you want to continue?</p>
            </div>
            <div class="modal-footer"> 
               <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
               <button type="submit" class="btn btn-danger">Delete</button> 
            </div>
        </div>
    </div>
  </div>
</form> --}}


@section('scripts')
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
  <script>
    function format ( items , invoice) {
      var temp = [];
      var loop = 0;
      
      items.forEach(item => {
        if (invoice['Quotation No'] == item.quotation_id) {
          temp[loop] = item;
          // Object.assign(temp[loop], element);
          loop++;
        }
      });

      console.log(temp);
      var td = "";
      var index = 1;
      var totalPrice = 0;
      const generateElementString = (index,element) =>{
        
        return `
        <tr>
          <td>${index}</td>
          <td>${element.name}</td>
          <td>${element.description}</td>
          <td>${element.quantity}</td>
          <td>${element['unit price']}</td>
          <td>${element['unit price'] * element.quantity}</td>
        </tr>`;
      }

      temp.forEach(element=>{
        td = td + generateElementString(index,element);
        totalPrice = totalPrice + (element['unit price'] * element.quantity);
        index++;
      })

      return (`<table class="table table-bordered table-sm"> 
            <thead>
              <tr class="font-weight-bold">
                <th scope="col" style="width:5%;"><strong>#</strong></th>
                <th scope="col" style="width:15%;"><strong>Name</strong></th>
                <th scope="col" style="width:45%;"><strong>Description</strong></th>
                <th scope="col" style="width:5%;"><strong>Qty</strong></th>
                <th scope="col" style="width:15%;"><strong>Unit Price</strong></th>
                <th scope="col" style="width:15%;"><strong>Total Price</strong></th>
              </tr>
            </thead>
            <tbody>
            <tr>
              ${td}
            </tr>  
            </tbody>
          </table>
          <table class="table table-bordered no-margin table-sm">
            <tr>
              <th colspan="2" style="width:78.5%" scope="row">Discount</th>
              <td>Rp. </td>
            </tr>
            <tr>
              <th colspan="2" scope="row">Grand Total</th>
              <td>Rp. </td>
            </tr>
          </table>`
        );

     
      }
    $(document).ready( function () {
      var dt = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('invoiceData')}}",
        columns : 
        [
          { "data" : 'DT_RowIndex'},
          { "data" : "Invoice No"},
          { "data" : "Invoice Date"},
          { "data" : "Bill To"},
          { "data" : "Quotation No"},
          {
            "class":          "details-control",
            "orderable":      false,
            "data":           'action',
            "defaultContent": ""
          },
        ]
      });

    var detailRows = [];
  var values = window.data;
 
 $('#datatable tbody').on( 'click', 'tr td.details-control', function () {
     var tr = $(this).closest('tr');
     var row = dt.row( tr );
     var idx = $.inArray( tr.attr('id'), detailRows );

     if ( row.child.isShown() ) {
         tr.removeClass( 'details' );
         row.child.hide();

         // Remove from the 'open' array
         detailRows.splice( idx, 1 );
     }
     else {
         tr.addClass( 'details' );
         row.child( format( values, row.data() ) ).show();

         // Add to the 'open' array
         if ( idx === -1 ) {
             detailRows.push( tr.attr('id') );
         }
     }
  dt.on( 'draw', function () 
        {
            $.each( detailRows, function ( i, id ) 
            {
                $('#'+id+' td.details-control').trigger( 'click' );
            });
  } );
    });
 } );

  </script>
@endsection