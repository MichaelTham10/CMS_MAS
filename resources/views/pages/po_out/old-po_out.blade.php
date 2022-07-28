@extends('layouts.app', ['title' => 'Old Purchase Out'])

{{-- title web tab --}}
@section('page-title')
    Old Purchase Out
@endsection

{{-- navbar title --}}
{{-- @section('head-title')
    Purchase Out
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
            <h3>Old Purchase Out</h3>
            <a href="{{route('create-old-po-out')}}" class="btn btn-primary">Create Old PO Out</a>
        </div>   
        <hr class="mt-0 mb-3"> 
        <table class="table pt-2 pb-3" id="datatable" style="width:100%; table-layout: fixed; word-wrap: break-word;">
            <thead>
                <tr class="font-weight-bold">
                    <th scope="col" style="width: 1%"><strong>#</strong></th>
                    <th scope="col"><strong>PO Out Number</strong></th>
                    <th scope="col"><strong>PDF</strong></th>
                    <th scope="col" style="width: 8%"><strong>Action</strong></th>
                </tr>
            </thead>
            <tbody>

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

        $(document).ready( function () {
            var dt = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('old-po-out-data')}}",
            columns : 
            [
                { "data": 'DT_RowIndex'},
                { "data" : "po_out_no"},
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
        } );   
    </script>
@endsection