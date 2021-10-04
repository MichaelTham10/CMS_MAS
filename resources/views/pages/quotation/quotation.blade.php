@extends('layouts.app', ['title' => 'Quotation'])


@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    
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
                  <script type="text/javascript">
                    window.data = {!! json_encode($items) !!};
                  </script>
                  @foreach ($quotations as $quotation)
                   
                  @endforeach
                    
                </tbody>
              </table>
              
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
    

    <script>


      function format ( item , quotation) {
        

        var temp = [];
        var loop = 0;
        
        item.forEach(element => {
            if (quotation.id == element.quotation_id) {
               
                temp[loop] = element;

                // Object.assign(temp[loop], element);
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

        return (`<table class="table table-bordered table-sm"> 
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
                <td>Rp. ${quotation.Discount}</td>
              </tr>
              <tr>
                <th colspan="2" scope="row">Grand Total</th>
                <td>Rp. ${totalPrice - quotation.Discount <= 0 ? 'FREE' : totalPrice - quotation.Discount}</td>
              </tr>
            </table>`
          );

     
      }
        $(document).ready( function () {
          var dt = $('#datatable').DataTable({
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
                      "class":          "details-control",
                      "orderable":      false,
                      "data":           'action',
                      "defaultContent": ""
                    },
                    // {
                    //   data: 'action', 
                    //   name: 'action', 
                    //   orderable: true, 
                    //   searchable: true
                    // },
                    
                ]
             });

  var detailRows = [];
  var values = window.data;
 
 $('#datatable tbody').on( 'click', 'tr td.details-control', function () {
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
 dt.on( 'draw', function () {
     $.each( detailRows, function ( i, id ) {
         $('#'+id+' td.details-control').trigger( 'click' );
     } );
 } );

        } );

        
    </script>
    
@endsection


{{-- <script type="text/javascript">
  $("#submit").click(function () {
      var id = $("#quotation_id").val();
      
      
      $("#modal-detail").html(id);
  });
</script> --}}