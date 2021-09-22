@extends('layouts.app', ['title' => 'Create Invoices'])

@section('content')
@include('layouts.headers.cards')
    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4" style="background-color: #fff">
            <div class="pl-4 pt-4 pr-4 font-weight-bold">
                <form>
                    <div class="form-group">
                      <label for="type">Type</label>
                      <select class="form-control" id="type">
                        <option>Invoice Manage Service (MS)</option>
                        <option>Invoice Device (SO)</option>
                        <option>Invoice Monthly Services (MMS)</option>
                        <option>Invoice Secure Parking Project (SPI)</option>
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" rows="2" placeholder="Input Address"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="invoice-number">Invoice No</label>
                        <input class="form-control" type="text" placeholder="AUTO GENERATE" readonly>
                    </div>

                    <div class="form-group">
                        <label for="invoiceDate">Invoice Date</label>
                        <input class="form-control" type="date" placeholder="Input Invoice Date" 
                        onfocus="(this.type='date')" id="invoice-date" name="">
                    </div>

                    <div class="form-group">
                        <label for="quotation">Quotation</label>
                        <select class="form-control" id="quotation">
                          <option>Quotation Manage Service (MS)</option>
                          <option>Quotation Device (SO)</option>
                          <option>Quotation Monthly Service (MMS)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="bill-to">Bill To</label>
                        <input class="form-control" type="text" placeholder="Input Bill To">
                    </div>
                    
                    <div class="form-group">
                        <label for="note">Note</label>
                        <textarea class="note" name="note"></textarea>
                        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                        <script>
                            tinymce.init({
                                selector:'textarea.note',
                                width: 940,
                                height: 300,
                            });
                        </script>
                    </div>
                </form>
            </div>

            <div class="pl-4 pr-4 pb-4">
                <button type="button" class="btn btn-primary">Store</button>
                <button type="button" class="btn btn-light">Cancel</button>
            </div>
        </div>   
    </div>
@endsection