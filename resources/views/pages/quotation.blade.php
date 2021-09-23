@extends('layouts.app', ['title' => 'Quotation'])

@section('content')
@include('layouts.headers.cards')
    @if(Session::has('success'))

        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{Session::get('success')}}</strong>

        </div>

    @endif
    <div class="container-fluid">
        <div class="rounded border mt-4" style="background-color: #fff">
            <div class="d-flex p-2 align-self-center justify-content-between">
                <div class="d-flex">
                    <div class="d-flex align-self-center">
                        show
                    </div>
                    <div class="pl-2 pr-2">
                      <form action="/quotation">
                          <select class="custom-select" aria-label="Default select example" name="show">
                            <a href="/quotation"><option selected="5" value="5">5</option></a>
                            <a href="/quotation"><option  value="10">10</option></a>
                            <a href="/quotation"><option  value="15">15</option></a>
                            <a href="/quotation"><option  value="20">20</option></a>
                            <a href="/quotation"><option  value="25">25</option></a>
                          </select>
                      </form>
                        
                    </div>
                    <div class="d-flex align-self-center">
                        entries
                    </div>
                </div>
                <div>
                    <div class="input-group rounded">
                        <input type="search" class="form-control rounded pr-5" placeholder="Search" aria-label="Search"
                          aria-describedby="search-addon" />
                      </div>
                </div>
                <div class="d-flex align-self-center">
                    <a href="{{route('create')}}" class="btn btn-primary ">create</a>
                </div>
            </div>
    
            <table class="table">
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
                    <tr>
                      <th scope="row">{{$quotation['id']}}</th>
                      <td>{{$quotation->getFormatId($quotation->type_id,$quotation->type_detail_id, $quotation['Quotation Date'])}}</td>
                      <td>{{$quotation['Quotation Date']}}</td>
                      <td>{{$quotation['Customer']}}</td>
                      <td>{{$quotation['Attention']}}</td>
                      <td>{{$quotation['Payment Term']}}</td>
                      <td>{{$quotation['Account Manager']}}</td>
                      <td>
                        <div class="btn-group">
                          <a href=""  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-detail">Detail</a>
                          <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('edit-controller')}}">Edit</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete" href="#">Delete</a>
                            <a class="dropdown-item" href="#">Export PDF</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                          
                </tbody>
              </table>
        </div>
        <div class="d-flex justify-content-center pt-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav>
        </div>
        </div>
@endsection

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

<div class="modal fade bd-example-modal-lg" id="modal-detail" aria-labelledby="myLargeModalLabel">
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
            <tr>
              <th scope="row">1</th>
              <td>TPlinkasd</td>
              <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla provident modi aut debitis minus temporibus tempore saepe quas hic ratione itaque quo quisquam earum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla provident modi aut debitis minus temporibus tempore saepe quas hic ration</td>
              <td>5</td>
              <td>20000</td>
              <td>100000</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>TPlinkasd</td>
              <td>asdasdasd</td>
              <td>5</td>
              <td>20000</td>
              <td>100000</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>TPlinkasd</td>
              <td>asdasdasds</td>
              <td>5</td>
              <td>20000</td>
              <td>100000</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>TPlinkasd</td>
              <td>asdasdasds</td>
              <td>5</td>
              <td>20000</td>
              <td>100000</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>TPlinkasd</td>
              <td>asdasdasds</td>
              <td>5</td>
              <td>20000</td>
              <td>100000</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>TPlinkasd</td>
              <td>asdasdasdss</td>
              <td>5</td>
              <td>20000</td>
              <td>100000</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>TPlinkasd</td>
              <td>asdasdasd</td>
              <td>5</td>
              <td>20000</td>
              <td>100000</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>TPlinkasd</td>
              <td>asdasdasd</td>
              <td>5</td>
              <td>20000</td>
              <td>100000</td>
            </tr>
          </tbody>
        </table>
      </div>
      <br>
      <div class="pding table-responsive">
        <div class="table-responsive m-10">
          <table class="table table-bordered no-margin table-sm">
            <tr>
              <th colspan="2" style="width:78.5%" scope="row">Discount</th>
              <td>$114,000.00</td>
            </tr>
            <tr>
              <th colspan="2" scope="row">Grand Total</th>
              <td>$114,000.00</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <div class="modal-footer"> <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button> <button type="button" class="btn btn-danger">Delete</button> </div>
      </div>
  </div>
</div>