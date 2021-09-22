@extends('layouts.app', ['title' => 'Edit Quotation'])

@section('content')
@include('layouts.headers.cards')
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
    </div>
@endsection