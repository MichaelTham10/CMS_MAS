@extends('layouts.app', ['title' => 'Invoice'])

{{-- title web tab --}}
@section('page-title')
    Invoice
@endsection

{{-- navbar title --}}
{{-- @section('head-title')
    Invoice
@endsection --}}

@section('styles')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/r-2.2.9/datatables.min.css"/>
    
@endsection

@section('content')
@include('layouts.headers.cards')
  <style>
    td{
      white-space: normal !important;
      text-align: justify;
    }
    .dataTables_length, .dataTables_filter, .dataTables_info, .dataTables_paginate{
      font-size: 15px;
    }
    .paginate_button.page-item.active a.page-link {
      background-color: #2a3880; 
    }
  </style>

    @if(Session::has('success'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{Session::get('success')}}</strong>
      </div>
    @endif
        
    <div class="container-fluid">
      <div class="rounded border mt-4 mb-4 p-4" style="background-color: #fff">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h3>PO Invoice</h3>
          <a href="{{route('create-invoice-po')}}" class="btn btn-primary">Create Invoice</a>
        </div>   
        <hr class="mt-0 mb-3"> 
        <table class="table pt-2 pb-3" id="datatable" style="width:100%; table-layout: fixed; word-wrap: break-word;">
          <thead>
            <tr class="font-weight-bold">
              <th scope="col" style="width: 1%"><strong>#</strong></th>
              <th scope="col"><strong>Invoice No</strong></th>
              <th scope="col"><strong>Invoice Date</strong></th>
              <th scope="col"><strong>Bill To</strong></th>
              <th scope="col"><strong>Customer Number</strong></th>
              <th scope="col"><strong>Service Cost</strong></th>
              <th scope="col" style="width: 6%"><strong>Action</strong></th>
            </tr>
          </thead>
          <tbody>
            <script type="text/javascript">
              window.data = {!! json_encode($items) !!};
            </script>
          </tbody>
        </table>
        <div style="padding-bottom: 4px;"></div>
      </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/r-2.2.9/datatables.min.js"></script>
<script>
  function formatNumber(number){
    number = number.toFixed(0) + '';
    x = number.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
      return x1 + x2;
  }

  function format ( items , invoice) {
    var temp = [];
    var loop = 0;
    var haveItem;
    
    items.forEach(item => {
      if (invoice['PO_In_Id'] == item.po_in_id) {
        temp[loop] = item;
        loop++;
        haveItem = true;
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
        <td>${element.price <= 0 ? 'FREE' : 'Rp. ' + formatNumber(element.price)}</td>
        <td>${element.price * element.quantity <=0 ? 'FREE' : 'Rp. ' + formatNumber(element.price * element.quantity)}</td>
      </tr>`;
    }

    temp.forEach(element=>{
      td = td + generateElementString(index,element);
      totalPrice = totalPrice + (element.price * element.quantity);
      index++;
    })

    if (haveItem) {
      return (`<table class="table table-bordered table-sm" style="table-layout: fixed; word-wrap: break-word;"> 
          <thead>
            <tr class="font-weight-bold">
              <th scope="col" style="width: 1%"><strong>#</strong></th>
              <th scope="col" style="width: 15%"><strong>Name</strong></th>
              <th scope="col" style="width: 40%"><strong>Item Description</strong></th>
              <th scope="col" style="width: 8.5%"><strong>Quantity</strong></th>
              <th scope="col"><strong>Unit Price</strong></th>
              <th scope="col"><strong>Total Price</strong></th>
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
              <th colspan="2" style="width:85%" scope="row">Total Price</th>
              <td>${totalPrice <= 0 ? 'FREE' : 'Rp. ' + formatNumber(totalPrice)}</td>
          </tr>
          <tr>
            <th colspan="2" style="width:85%" scope="row">PPN 11%</th>
            <td>Rp. ${formatNumber((totalPrice * (11/100)))}</td>
          </tr>
          <tr>
            <th colspan="2" style="width:85%" scope="row">Service Cost</th>
            <td>Rp. ${formatNumber(invoice['service_cost'])}</td>
          </tr>
          <tr>
            <th colspan="2" scope="row">Grand Total</th>
            <td>${(totalPrice + (totalPrice * (11/100)) + invoice['service_cost']) <= 0 ? 'FREE' : 'Rp. ' + formatNumber((totalPrice + (totalPrice * (11/100)) + invoice['service_cost']))}</td>
          </tr>
        </table>`
      );
    }
    else{
      return (
          `
          <table class="table table-bordered table-sm" style="table-layout: fixed; word-wrap: break-word;"> 
            <thead>
              <tr class="font-weight-bold">
                <th scope="col" style="width: 1%"><strong>#</strong></th>
                <th scope="col" style="width: 15%"><strong>Name</strong></th>
                <th scope="col" style="width: 40%"><strong>Item Description</strong></th>
                <th scope="col" style="width: 8.5%"><strong>Quantity</strong></th>
                <th scope="col"><strong>Unit Price</strong></th>
                <th scope="col"><strong>Total Price</strong></th>
              </tr>
            </thead>
          </table>
          <h5 class="text-center">No Item Data</h5>`
      );
    }
  }

  $(document).ready( function () {
    var dt = $('#datatable').DataTable(
      {
      processing: true,
      serverSide: true,
      ajax: "{{ route('invoicePOData')}}",
      columns : 
      [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
        { "data" : 'Invoice No'},
        { "data" : "Invoice Date"},
        { "data" : "Bill To"},
        { "data" : "poin.customer_number"},
        { "data" : "service_cost"},
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

  var test;

  $('#datatable tbody').on( 'click', '#submit', function () {
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