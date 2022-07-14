@extends('layouts.app', ['title' => 'Purchase Out Order'])

@section('head-title')
    Roles Management
@endsection

@section('page-title')
    Roles Management
@endsection

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
</style>

    @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{Session::get('success')}}</strong>
        </div>
    @endif
        
    <div class="container-fluid">
        <div class="rounded border mt-4" style="background-color: #fff">
            <table class="table" id="datatable" style="width:98%; margin-left: 10px;">
            <thead>
                <tr class="font-weight-bold">
                <th scope="col"><strong>#</strong></th>
                <th scope="col"><strong>Email</strong></th>
                <th scope="col"><strong>Name</strong></th>
                </tr>
            </thead>
            <tbody>
              <script type="text/javascript">
                window.data = {!! json_encode($users) !!};
              </script>
            </tbody>
            </table>
            <div style="padding-bottom: 6px;"></div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/r-2.2.9/datatables.min.js"></script>
  <script>
    $(document).ready( function () {
      var dt = $('#datatable').DataTable(
        {
        processing: true,
        serverSide: true,
        ajax: "{{ route('roles.data')}}",
        columns : 
        [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
          { "data" : 'email'},
          { "data" : "name"},
          { "data" : 'password'}

        ]
      });

    var detailRows = [];
    var values = window.data;

    var test;
 
    // $('#datatable tbody').on( 'click', '#submit', function () {
    //     var tr = $(this).closest('tr');
    //     var row = dt.row( tr );
    //     var idx = $.inArray( tr.attr('id'), detailRows );

    //     if ( row.child.isShown() ) {
    //         tr.removeClass( 'details' );
    //         row.child.hide();

    //         detailRows.splice( idx, 1 );
    //     }
    //     else {
    //         tr.addClass( 'details' );
    //         row.child( format( values, row.data() ) ).show();

    //         if ( idx === -1 ) {
    //             detailRows.push( tr.attr('id') );
    //         }
    //     }
    //       dt.on( 'draw', function (){
    //         $.each( detailRows, function ( i, id ) 
    //         {
    //             $('#'+id+' td.details-control').trigger( 'click' );
    //         });
    //     });
    //   });
        
    });

  </script>
@endsection
{{-- <script type="text/javascript">
  window.data = {!! json_encode($items) !!};
</script> --}}
