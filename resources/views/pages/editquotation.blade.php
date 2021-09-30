@extends('layouts.app', ['title' => 'Edit Quotation'])

@section('content')
@include('layouts.headers.cards')
    @if(Session::has('success'))

            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{Session::get('success')}}</strong>

            </div>

    @endif

    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4" style="background-color: #fff">
            <div class="pl-4 pt-4 pr-4 font-weight-bold">
                <div>
                    Edit Quotation No: {{$quotation->Quotation_No}}
                </div>
                <hr class="mt-2 mb-2">
                <form action="/update/quotation/{{$quotation->id}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                      <label for="type">Type</label>
                      <input class="form-control" readonly type="text" placeholder="Input Customer" value="{{$type->name}} ({{$type->alias}})">
                    </div>

                    <div class="form-group">
                        <label for="customer">Customer</label>
                        <input class="form-control" type="text" placeholder="Input Customer" name="customer" value="{{$quotation['Customer']}}">
                    </div>

                    <div class="form-group">
                        <label for="attention">Attention</label>
                        <input class="form-control" type="text" placeholder="Input Attention" name="attention" value="{{$quotation['Attention']}}">
                    </div>

                    <div class="form-group">
                        <label for="payment-term">Payment Term</label>
                        <input class="form-control" type="text" placeholder="Input Payment" name="payment" value="{{$quotation['Payment Term']}}">
                    </div>

                    <div class="form-group">
                        <label for="quotation-no">Quotation No</label>
                        <input class="form-control" type="text" value="{{$quotation->getFormatId($quotation->type_id,$quotation->type_detail_quantity, $quotation['Quotation Date'])}}"  readonly>
                    </div>

                    <div class="form-group">
                        <label for="invoiceDate">Quotation Date</label>
                        <input class="form-control" type="date" placeholder="Input Invoice Date" 
                        onfocus="(this.type='date')" id="invoice-date" name="date" value="{{$quotation['Quotation Date']}}">
                    </div>

                    <div class="form-group">
                        <label for="account-manager">Account Manager</label>
                        <input class="form-control" type="text" placeholder="Input account manager" name="account" value="{{$quotation['Account Manager']}}">
                    </div>

                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input class="form-control" type="text" placeholder="Input Discount" name="discount" value="{{$quotation['Discount']}}">
                    </div>
                    
                    <div class="form-group">
                        <label for="note">Terms & Condition</label>
                        <textarea class="note " name="terms">{{$quotation['Terms']}}</textarea>
                        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                        <script>
                            tinymce.init({
                                selector:'textarea.note',
                                width: 970,
                                height: 300,
                            });
                        </script>
                    </div>
                    <div class="d-flex justify-content-end pl-4 pr-4 pb-4 ">
                        <button type="button" class="btn btn-light">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

            
        </div>   

        <style>
            td{
              white-space: normal !important;
              text-align: justify;
            }
        </style>

        <div class="rounded border mt-4 mb-4" style="background-color: #fff">
            <div class="pl-4 pt-4 pr-4 font-weight-bold">
                <div>
                    Items
                </div>
                <hr class="mt-2 mb-2">
                <div class="d-flex pb-2 align-self-center justify-content-between">
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
                    <div class="d-flex align-self-center float-left">
                        <a href="/create/items/{{$quotation->id}}" class="btn btn-primary">create</a>
                    </div>
                </div>
            
                <table class="table">
                    <thead>
                        <tr class="font-weight-bold">
                        <th scope="col" style="width:5%;"><strong>#</strong></th>
                        <th scope="col"><strong>Name</strong></th>
                        <th scope="col"><strong>Description</strong></th>
                        <th scope="col"><strong>Qty</strong></th>
                        <th scope="col"><strong>Unit Price</strong></th>
                        <th scope="col"><strong>Total Price</strong></th>
                        <th scope="col"><strong>Action</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$item->name}}</td>
                                <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;">{!! $item->description !!}</td>
                                <td>{{$item->quantity}}</td>
                                <td>Rp. {{number_format($item['unit price'])}}</td>
                                <td>Rp {{number_format($item->quantity * $item['unit price'])}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action<span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{route('edit-item', [$quotation->id,$item->id])}}">Edit</a>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete{{$item->id}}" href="#">Delete</a>
                                        <a class="dropdown-item" href="#">Export PDF</a>
                                        </div>
                                    </div>
                                </td>
                                <form action="/delete/item/{{$item->id}}" method="POST">
                                    <div class="modal fade" id="ModalDelete{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="container d-flex pl-0"><img src="">
                                                        <h3 class="modal-title ml-2" id="exampleModalLabel">Delete this item?</h3>
                                                    </div> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-muted">If you remove this item it will be gone forever {{$item->id}}. Are you sure you want to continue?</p>
                                                </div>
                                                <div class="modal-footer"> 
                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button> 
                                                    <button type="submit" class="btn btn-danger">Delete</button> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </form>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>   
    </div>
    
    
@endsection

