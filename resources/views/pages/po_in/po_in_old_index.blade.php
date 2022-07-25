@extends('layouts.app', ['title' => 'Old Purchase In'])

{{-- title web tab --}}
@section('page-title')
    Old Purchase In
@endsection

{{-- navbar title --}}
{{-- @section('head-title')
    Quotation
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
        <div class="rounded border mt-4 mb-4 p-4" style="background-color: #fff;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Old Purchase In</h3>
            <a href="/po_in/old/create/form" class="btn btn-primary">Create Old Purchase In</a>
        </div>   
        <hr class="mt-0 mb-3"> 
        <table class="table pt-2 pb-3" id="datatable" style="width:100%;">
            <thead>
                <tr class="font-weight-bold">
                    <th scope="col"><strong>#</strong></th>
                    <th scope="col"><strong>Purchase Number</strong></th>
                    <th scope="col"><strong>PDF</strong></th>
                    <th scope="col"><strong>Action</strong></th>
                </tr>
            </thead>
            <tbody>
                {{-- <script type="text/javascript">
                window.data = {!! json_encode($items) !!};
                </script> --}}
            </tbody>
            </table>
        <div style="padding-bottom: 4px;"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/r-2.2.9/datatables.min.js"></script>
    <script>
        

        $(document).ready( function () {
            var dt = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('old-purchaseIn-data')}}",
            columns : 
            [
                { "data": 'DT_RowIndex'},
                { "data" : "purchase_number"},
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
        $('#datatable tbody').on( 'click', '#submit', function () {
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
        } );

        // On each draw, loop over the `detailRows` array and show any child rows
        dt.on( 'draw', function () 
        {
            $.each( detailRows, function ( i, id ) 
            {
                $('#'+id+' td.details-control').trigger( 'click' );
            });
        } );
        } );   
    </script>
@endsection