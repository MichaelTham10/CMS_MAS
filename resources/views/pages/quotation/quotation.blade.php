@extends('layouts.app', ['title' => 'Quotation'])


@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
@endsection

@section('content')
@include('layouts.headers.cards')
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
                    <a href="{{route('create')}}" class="btn btn-primary ">create</a>
                </div>
            </div>
    
            <table class="table" id="datatable">
                <thead>
                  <tr class="font-weight-bold">
                    <th scope="col"><strong>#</strong></th>
                    <th scope="col"><strong>Quotation No</strong></th>
                    <th scope="col"><strong>Quotation Date</strong></th>
                    <th scope="col"><strong>Customer</strong></th>
                    <th scope="col"><strong>Attention</strong></th>
                    <th scope="col"><strong>Payment Term</strong></th>
                    <th scope="col"><strong>Account Manager</strong></th>
                    <th scope="col"><strong>Action</strong></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($quotations as $quotation)
                    @php
                      $totalprice = 0;
                    @endphp
                    <tr>
                      {{-- <th scope="row">{{$loop->iteration}}</th> --}}
                      {{-- <td style="display: none" id="quotation_id">{{$quotation['id']}}</td>
                      <td>{{$quotation->getFormatId($quotation->type_id,$quotation->type_detail_quantity, $quotation['Quotation Date'])}}</td>
                      <td>{{$quotation['Quotation Date']}}</td>
                      <td>{{$quotation['Customer']}}</td>
                      <td>{{$quotation['Attention']}}</td>
                      <td>{{$quotation['Payment Term']}}</td>
                      <td>{{$quotation['Account Manager']}}</td> --}}


                          
                    </tr>
                  @endforeach
                    
                </tbody>
              </table>
              {{-- {{$quotations->links()}} --}}
        </div>
      

        {{-- @if ($quotations->hasPages())
        <div class="d-flex justify-content-center pt-3">
             
          <nav aria-label="Page navigation example">
              <ul class="pagination">
                @if ($quotations->onFirstPage())
                    <li class="page-item disabled"><span>&laquo;</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $quotations->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                @endif
                
                {{-- Pagination quotations --}}
                {{-- @for ($i = 1; $i <= $quotations->lastPage(); $i++)
                <li class="page-item {{ ($quotations->currentPage() == $i) ? ' active' : '' }}">
                    <a class="page-link" href="{{ $quotations->url($i) }}">{{ $i }}</a>
                </li>
               @endfor
                {{-- Next Page Link --}}
                {{-- @if ($quotations->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $quotations->nextPageUrl() }}" rel="next">&raquo;</a></li>
                @else
                    <li class="page-item disabled"><span>&raquo;</span></li>
                @endif
              </ul>
            </nav>
        </div> --}}
        {{-- @endif --}}
        
      {{-- </div> --}}
@endsection


@section('scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

    <script>
        $(document).ready( function () {
             $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('test')}}",
                columns : [
                    { "data": 'DT_RowIndex'},
                    { "data" : "Quotation_No"},
                    { "data" : "Quotation Date"},
                    { "data" : "Customer"},
                    { "data" : "Attention"},
                    { "data" : "Payment Term"},
                    { "data" : "Account Manager"},
                    {
                      data: 'action', 
                      name: 'action', 
                      orderable: true, 
                      searchable: true
                    },
                    
                ]
             });
        } );
    </script>
    
@endsection


{{-- <script type="text/javascript">
  $("#submit").click(function () {
      var id = $("#quotation_id").val();
      
      
      $("#modal-detail").html(id);
  });
</script> --}}