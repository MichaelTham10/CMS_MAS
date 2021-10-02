@extends('layouts.app', ['title' => 'Quotation'])

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
@endsection

@section('content')
@include('layouts.headers.cards')
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
          {{-- <th scope="row">{{$loop->iteration}}</th>
          <td style="display: none" id="quotation_id">{{$quotation['id']}}</td>
          <td>{{$quotation->getFormatId($quotation->type_id,$quotation->type_detail_quantity, $quotation['Quotation Date'])}}</td>
          <td>{{$quotation['Quotation Date']}}</td>
          <td>{{$quotation['Customer']}}</td>
          <td>{{$quotation['Attention']}}</td>
          <td>{{$quotation['Payment Term']}}</td>
          <td>{{$quotation['Account Manager']}}</td> --}}
          <td>
            {{-- <div class="btn-group">
              <a href=""  class="btn btn-primary btn-sm" id="submit" data-toggle="modal" data-target="#modalDetail{{$quotation->id}}">Detail</a>
              <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{route('edit-controller', $quotation['id'])}}">Edit</a>
                <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete{{$quotation->id}}" href="#">Delete</a>
                <a class="dropdown-item" href="/quotation/item/export-pdf/{{$quotation->id}}" target="_blank">Export PDF</a>
              </div>
            </div> --}}

            {{-- <div class="modal fade" id="modalDetail{{$quotation->id}}" aria-labelledby="myLargeModalLabel" tabindex="-1" role="dialog" aria-hidden="true">
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
                        @foreach ($quotation->items as $item)
                         
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
                          <td>Rp. {{number_format(($quotation->Discount*$totalprice)/100)}}</td>
                        </tr>
                        <tr>
                          <th colspan="2" scope="row">Grand Total</th>
                          <td>Rp. {{number_format($totalprice-($quotation->Discount*$totalprice)/100)}}</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}
            {{-- <form action="/delete/quotation/{{$quotation->id}}" method="POST">
              @csrf
              @method('DELETE')
              <div class="modal fade" id="ModalDelete{{$quotation->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            
          </td>

              
        </tr>
      @endforeach
        
    </tbody>
  </table>
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
                    { "data" : "Quotation_No"},
                    { "data" : "Quotation_No"},
                    { "data" : "Quotation_No"},
                    { "data" : "Quotation_No"},
                    { "data" : "Quotation_No"},
                    
                ]
             });
        } );
    </script>
    
@endsection