@extends('layouts.app', ['title' => 'Edit Quotation'])

@section('content')
@include('layouts.headers.cards')
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
    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4" style="background-color: #fff">
            <div class="pl-4 pt-4 pr-4 font-weight-bold">
                <div>
                    Edit Quotation No: 
                </div>
                <hr class="mt-2 mb-2">
                <form>
                    <div class="form-group">
                      <label for="type">Type</label>
                      <select class="form-control" id="type">
                        <option>Quotation Manage Service (MS)</option>
                        <option>Quotation Device (SO)</option>
                        <option>Quotation Monthly Services (MMS)</option>
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="customer">Customer</label>
                        <input class="form-control" type="text" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="attention">Attention</label>
                        <input class="form-control" type="text" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="payment-term">Payment Term</label>
                        <input class="form-control" type="text" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="quotation-no">Quotation No</label>
                        <input class="form-control" type="text" placeholder="AUTO GENERATE" readonly>
                    </div>

                    <div class="form-group">
                        <label for="invoiceDate">Quotation Date</label>
                        <input class="form-control" type="date" placeholder="Input Invoice Date" 
                        onfocus="(this.type='date')" id="invoice-date" name="">
                    </div>

                    <div class="form-group">
                        <label for="account-manager">Account Manager</label>
                        <input class="form-control" type="text" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input class="form-control" type="text" placeholder="">
                    </div>
                    
                    <div class="form-group">
                        <label for="note">Note</label>
                        <textarea class="note " name="note"></textarea>
                        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                        <script>
                            tinymce.init({
                                selector:'textarea.note',
                                width: 970,
                                height: 300,
                            });
                        </script>
                    </div>
                </form>
            </div>

            <div class="d-flex justify-content-end pl-4 pr-4 pb-4 ">
                <button type="button" class="btn btn-light">Cancel</button>
                <button type="button" class="btn btn-primary">Save</button>
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
                        <a href="{{route('create-items')}}" class="btn btn-primary bi bi-plus"><i class="fas fa-plus pr-1"></i>create</a>
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
                        <tr>
                            <th scope="row">1</th>
                            <td>Route</td>
                            <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Delectus nobis vitae expedita perspiciatis. Aliquid, ea obcaecati! Temporibus in nam aspernatur, voluptatum unde sed maiores eos eligendi cumque, aliquid impedit. Veritatis debitis quidem temporibus qui voluptates repellendus. Iusto quis reprehenderit facere eos sapiente? Assumenda eligendi impedit dolore reprehenderit recusandae consectetur ab architecto fugit. Iusto quod sequi ut repudiandae officia nobis quis voluptatem aspernatur assumenda vel voluptatum consequuntur quia, eaque autem provident possimus. Quos nesciunt aspernatur ipsam repellendus amet eum sunt deleniti ad aut harum dolores molestiae, exercitationem alias reiciendis nihil necessitatibus aliquid totam praesentium enim voluptatibus minima inventore placeat? Rem, eum.</td>
                            <td>10</td>
                            <td>10.000</td>
                            <td>100.000</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action<span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{route('edit-item')}}">Edit</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete" href="#">Delete</a>
                                    <a class="dropdown-item" href="#">Export PDF</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Route</td>
                            <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Delectus nobis vitae expedita perspiciatis. Aliquid, ea obcaecati! Temporibus in nam aspernatur, voluptatum unde sed maiores eos eligendi cumque, aliquid impedit. Veritatis debitis quidem temporibus qui voluptates repellendus. Iusto quis reprehenderit facere eos sapiente? Assumenda eligendi impedit dolore reprehenderit recusandae consectetur ab architecto fugit. Iusto quod sequi ut repudiandae officia nobis quis voluptatem aspernatur assumenda vel voluptatum consequuntur quia, eaque autem provident possimus. Quos nesciunt aspernatur ipsam repellendus amet eum sunt deleniti ad aut harum dolores molestiae, exercitationem alias reiciendis nihil necessitatibus aliquid totam praesentium enim voluptatibus minima inventore placeat? Rem, eum.</td>
                            <td>10</td>
                            <td>10.000</td>
                            <td>100.000</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action<span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{route('edit-item')}}">Edit</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete" href="#">Delete</a>
                                    <a class="dropdown-item" href="#">Export PDF</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>   
    </div>
@endsection

