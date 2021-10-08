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
                <div class="d-flex align-self-center">
                    <a class="btn btn-primary" href="{{route('create-invoice')}}">create</a>
                </div>
            </div>
    
            <table class="table" id="datatable" style="width:95%">
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
                    @foreach ($invoices as $invoice)
                    
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
      <script type="text/javascript">
        window.data = {!! json_encode($items) !!};
      </script>

@section('scripts')
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
  <script>
    function format ( items , invoice) {
      var temp = [];
      var loop = 0;
      
      items.forEach(item => {
        if (invoice['Quotation No'] == item.quotation_id) {
          temp[loop] = item;
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

      return (`<table class="table table-bordered table-sm" > 
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
              <td>${invoice.quotation.Discount}</td>
            </tr>
            <tr>
              <th colspan="2" scope="row">Grand Total</th>
              <td>${totalPrice - invoice.quotation.Discount <= 0 ? 'FREE' : totalPrice - invoice.quotation.Discount}</td>
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
         { data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
          { "data" : 'Invoice No'},
          { "data" : "Invoice Date"},
          { "data" : "Bill To"},
          { "data" : "Quotation No"},
          {
            "class":          "details-control",
            "orderable":      false,
            "data":           'action',
            "defaultContent": ""
          },
          { "data" : "quotation.Discount",visible:false},
        ]
      });

    var detailRows = [];
    var values = window.data;

    var test;
 
 $('#datatable tbody').on( 'click', 'tr td.details-control', function () {
     var tr = $(this).closest('tr');
     var row = dt.row( tr );
     var idx = $.inArray( tr.attr('id'), detailRows );

     if ( row.child.isShown() ) {
         tr.removeClass( 'details' );
         row.child.hide();

         detailRows.splice( idx, 1 );
     }
     else {
         tr.addClass( 'details' );
         row.child( format( values, row.data() ) ).show();

         if ( idx === -1 ) {
             detailRows.push( tr.attr('id') );
         }
     }
    dt.on( 'draw', function (){
      $.each( detailRows, function ( i, id ) 
      {
          $('#'+id+' td.details-control').trigger( 'click' );
      });
  });
    });
    console.log(dt);
 } );

  </script>
@endsection