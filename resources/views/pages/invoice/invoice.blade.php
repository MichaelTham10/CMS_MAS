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
    .edit{
      overflow-wrap: break-word;
      word-wrap: break-word;
      hyphens: auto;
    }
    td{
      white-space: normal !important;
      text-align: justify;
    }
    .btn-create{
      position: relative;
      top: 0.8rem;
      left: 90.1%;
    }
    .btn-create .btn{
      padding: 6px 15px;
      font-size: 14px;
    }
    .dataTables_length, .dataTables_filter{
      padding-left:1.6rem; 
      padding-right: 1.6rem;
      font-size: 14px;
    }
    .dataTables_info, .dataTables_paginate{
      font-size: 14px;
      padding-left: 1.6rem;
      padding-right: 0.8rem;
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
            <div class="btn-create">
              <a class="btn btn-primary" href="{{route('create-invoice')}}">create</a>
            </div>
            <br>
            <table class="table" id="datatable" style="width:100%">
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

        <div style="padding-bottom: 4px;"></div>
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
        
    });

  </script>
@endsection