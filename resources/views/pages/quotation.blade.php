@extends('layouts.app', ['title' => 'Quotation'])

@section('content')
@include('layouts.headers.cards')
    <div class="container-fluid">
        <div class="rounded border mt-4" style="background-color: #fff">
            <div class="d-flex p-2 align-self-center justify-content-between">
                <div class="d-flex">
                    <div class="d-flex align-self-center">
                        show
                    </div>
                    <div class="pl-2 pr-2">
                        <select class="custom-select" aria-label="Default select example">
                            <option selected="five"><a href="">5</a></option>
                            <option value="ten"><a href="">10</a></option>
                            <option value="fifteen">15</option>
                            <option value="twenty">20</option>
                            <option value="twenty-five">25</option>
                        </select>
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
                    <th scope="col"><strong>Acount Manager</strong></th>
                    <th scope="col"><strong>Action</strong></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>MAS/SO/202109001</td>
                    <td>19/09/2021</td>
                    <td>Kopi kenangan</td>
                    <td>Bapak Chris</td>
                    <td>14 Days</td>
                    <td>Mike</td>
                    <td>
                      <div class="btn-group">
                        <a href=""  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-detail">Detail</a>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="#">Edit</a>
                          <a class="dropdown-item" href="#">Delete</a>
                          <a class="dropdown-item" href="#">Export PDF</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">1</th>
                    <td>MAS/SO/202109001</td>
                    <td>19/09/2021</td>
                    <td>Kopi kenangan</td>
                    <td>Bapak Chris</td>
                    <td>14 Days</td>
                    <td>Mike</td>
                    <td>
                      <div class="btn-group">
                        <a href=""  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-detail">Detail</a>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="{{route('edit-controller')}}">Edit</a>
                          <a class="dropdown-item" href="#">Delete</a>
                          <a class="dropdown-item" href="#">Export PDF</a>
                        </div>
                      </div>
                    </td>
                  </tr>
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
  .modal-body{
    height: 400px; 
    overflow: hidden;
  }
  .modal-body:hover{
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
      <div class="modal-body pt-0 warp">
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