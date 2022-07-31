@extends('layouts.app', ['title' => 'Purchase Out Order'])

{{-- title web tab --}}
@section('page-title')
    Purchase Out Order
@endsection

{{-- navbar title --}}
{{-- @section('head-title')
    Purchase Out Order
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
  @elseif(Session::has('failed'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{Session::get('failed')}}</strong>
    </div>
  @endif
      
  <div class="container-fluid">
    <div class="rounded border mt-4 mb-4 p-4" style="background-color: #fff">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h3>Purchase Out Order</h3>
          <a href="{{route('create-po-out')}}" class="btn btn-primary">Create PO Out</a>
        </div>   
        <hr class="mt-0 mb-3"> 
        <table class="table pt-2 pb-3" id="datatable" style="width:100%; table-layout: fixed; word-wrap: break-word;">
          <thead>
            <tr class="font-weight-bold">
              <th scope="col" style="width: 1%"><strong>#</strong></th>
              <th scope="col"><strong>PO No</strong></th>
              <th scope="col"><strong>PO Date</strong></th>
              <th scope="col"><strong>Arrival Date</strong></th>
              <th scope="col"><strong>To</strong></th>
              <th scope="col" style="width: 6%"><strong>Action</strong></th>
            </tr>
          </thead>
          <tbody>          
            <script type="text/javascript">
              window.data = {!! json_encode($po_out_items) !!};
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

    function format ( items , po_out) {
      var temp = [];
      var loop = 0;
      var haveItem;
      
      items.forEach(item => {
        if (po_out['id'] == item.po_out_id) {
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
          <td>${element.item_description}</td>
          <td>${formatNumber(element.qty)}</td>
          <td>${element['price'] <= 0 ? 'FREE' : 'Rp.' + formatNumber(element['price'])}</td>
          <td>${element['price'] * element.qty <= 0 ? 'FREE' : 'Rp.' + formatNumber(element['price'] * element.qty)}</td>
        </tr>`;
      }
      temp.forEach(element=>{
        td = td + generateElementString(index,element);
        totalPrice = totalPrice + (element['price'] * element.qty);
        index++;
      })

      if (!haveItem) {
        return (`<table class="table table-bordered table-sm" style="table-layout: fixed; word-wrap: break-word;"> 
            <thead>
              <tr class="font-weight-bold">
                <th scope="col" style="width:1%;"><strong>#</strong></th>
                <th scope="col" style="width:50%;"><strong>Item Description</strong></th>
                <th scope="col"><strong>Quantity</strong></th>
                <th scope="col"><strong>Price</strong></th>
                <th scope="col"><strong>Total Price</strong></th>
              </tr>
            </thead>
          </table>
          <h5 class="text-center">No Item Data</h5>`
        );
      }
      else{
        return (`<table class="table table-bordered table-sm" style="table-layout: fixed; word-wrap: break-word;"> 
            <thead>
              <tr class="font-weight-bold">
                <th scope="col" style="width:1%;"><strong>#</strong></th>
                <th scope="col" style="width:50%;"><strong>Item Description</strong></th>
                <th scope="col"><strong>Quantity</strong></th>
                <th scope="col"><strong>Price</strong></th>
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
              <th colspan="2" style="width:84.5%" scope="row">Total Price</th>
              <td>${(totalPrice <= 0 ? 'FREE' : 'Rp. ' + formatNumber(totalPrice))}</td>
            </tr>
            <tr>
              <th colspan="2" style="width:84.5%" scope="row">PPN (${po_out.ppn}%)</th>
              <td>Rp. ${formatNumber(totalPrice*(po_out.ppn/100))}</td>
            </tr>
            <tr>
              <th colspan="2" scope="row">Grand Total</th>
              <td>${(totalPrice + (totalPrice*(po_out.ppn/100))) <= 0 ? 'FREE' : 'Rp. ' + formatNumber((totalPrice + (totalPrice*(po_out.ppn/100))))}</td>
            </tr>
          </table>`
        );
      }
    }
    $(document).ready( function () {
      var dt = $('#datatable').DataTable(
        {
        processing: true,
        serverSide: true,
        ajax: "{{ route('po-outData')}}",
        columns : 
        [
          { "data": 'DT_RowIndex'},
          { "data" : 'po_out_no'},
          { "data" : "date"},
          { "data" : "arrival"},
          { "data" : "to"},
          {
            "class":          "details-control",
            "orderable":      false,
            "data":           'action',
            "defaultContent": ""
          },
        //   { "data" : "quotation.Discount",visible:false},
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