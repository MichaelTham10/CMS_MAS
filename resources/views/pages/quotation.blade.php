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
                    <th scope="col"><strong>Acount Manager</strong></th>
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
                      <td><button>btn</button></td>
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