@extends('layouts.app', ['title' => 'Purchase In Order'])

{{-- title web tab --}}
@section('page-title')
    Purchase In Order
@endsection

{{-- navbar title --}}
{{-- @section('head-title')
    Purchase In Order
@endsection --}}

@section('styles')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/r-2.2.9/datatables.min.css"/>
    
@endsection

@section('content')
  @include('layouts.headers.cards')

  <style>
    .dataTables_length, .dataTables_filter, .dataTables_info, .dataTables_paginate{
    font-size: 14px;
    padding-left: 10px;
    padding-right: 10px;
    }
    .btn-create{
      padding: 5px;
      position: relative;
      left: 90.2%;
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
      {{-- <a href="{{asset('pdf/PT Kong Guan.pdf')}}">TEST</a> --}}
      <div class="rounded border mt-4 mb-4 p-4" style="background-color: #fff">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h3>Purchase In Order</h3>
          <a href="/po_in/create/form" class="btn btn-primary">Create PO In</a>
        </div>   
        <hr class="mt-0 mb-3"> 
        <table class="table pt-2 pb-3" id="datatable" style="width:100%;">
          <thead>
            <tr class="font-weight-bold">
              <th scope="col"><strong>#</strong></th>
              <th scope="col"><strong>Customer Number</strong></th>
              <th scope="col"><strong>Customer Name</strong></th>
              <th scope="col"><strong>PDF</strong></th>
              <th scope="col"><strong>Action</strong></th>
            </tr>
          </thead>
          <tbody>
              
          </tbody>
        </table>
        <div style="padding-bottom: 6px;"></div>
      </div>
    </div>
  </div>
@endsection

<script type="text/javascript">
  window.data = {!! json_encode($po_in_items) !!};
</script>

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

    function format ( items , po_in) {
      var temp = [];
      var loop = 0;
      
      items.forEach(item => {
        if (po_in['id'] == item.po_in_id) {
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
          <td>${element.description}</td>
          <td>${formatNumber(element.quantity)}</td>
          <td>${formatNumber(element['price'])}</td>
          <td>${formatNumber(element['price'] * element.quantity)}</td>
        </tr>`;
      }
      temp.forEach(element=>{
        td = td + generateElementString(index,element);
        totalPrice = totalPrice + (element['price'] * element.quantity);
        index++;
      })

      if (totalPrice == 0) {
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
          </table>
          <h5 class="text-center">No Item Data</h5>`
        );
      }
      else{
        return (`<table class="table table-bordered table-sm" > 
            <thead>
              <tr class="font-weight-bold">
                <th scope="col" style="width:5%;"><strong>#</strong></th>
                <th scope="col" style="width:15%;"><strong>Item Description</strong></th>
                <th scope="col" style="width:5%;"><strong>Quantity</strong></th>
                <th scope="col" style="width:15%;"><strong>Price</strong></th>
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
              <th colspan="2" style="width:78.5%" scope="row">Total Price</th>
              <td>Rp. ${formatNumber(totalPrice)}</td>
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
        ajax: "{{ route('po_in_data')}}",
        columns : 
        [
          { "data": 'DT_RowIndex'},
          { "data" : "customer_number"},
          { "data" : "customer_name"},
          { 
            "data" : "file",
            render: function ( data, type, row, meta ) {
              data = '<a href="/pdf/' + data + '" target="_blank">' + data + '</a>';
              return data;
            }
          },
          {
            "class":          "details-control",
            "orderable":      false,
            "data":           'action',
            "defaultContent": ""
          }
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