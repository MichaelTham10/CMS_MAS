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
                    <td><button>btn</button></td>
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