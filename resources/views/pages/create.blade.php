@extends('layouts.app', ['title' => 'Create Quotation'])

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid">
    <div class="rounded border mt-4" style="background-color: #fff">
        <div class="d-flex m-5 align-self-center justify-content-center">
            <form>
                <div class="form-row ">
                  <div class="col-md-4 mb-3">
                    <label for="validationDefault01">Attention</label>
                    <input type="text" class="form-control" id="validationDefault01" placeholder="Andi" required>
                  </div>
                  <br>
                  <div class="col-md-4 mb-3">
                    <label for="validationDefault02">Customer</label>
                    <input type="text" class="form-control" id="validationDefault02" placeholder="Toni"  required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Account Manager</label>
                    <input type="text" class="form-control" id="validationDefault02" placeholder="Michael"  required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault05">Payment Term</label>
                    <input type="text" class="form-control" id="validationDefault03" placeholder="5 Days" name="payment-term" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault06">Quotation Date</label>
                    <input type="date" class="form-control" id="validationDefault04" placeholder="" name="date"   required>
                  </div>
                </div>
                
                <button class="btn btn-primary" type="submit">Create</button>
              </form>
              
    </div>
    </div>
@endsection