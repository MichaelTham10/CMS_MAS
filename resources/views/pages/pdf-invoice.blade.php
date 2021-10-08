
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title></title>
  @php
      $total = 0;
      $ppn = 0; 
      $discount = 0;
  @endphp
  
  <style>
  *{
    font-family: Arial, Helvetica, sans-serif;
  }
  .table {
  font-family: Arial, Helvetica, sans-serif;
  padding: 0;
  margin: 0;
  border-collapse: collapse;
  width: 100%;
  }
  
  th {
    background-color: rgb(118, 166, 221);
    color: white;
  }
  
  .table th {
    padding-top: 6px;
    padding-bottom: 6px;
    text-align: left;
    color: black;
  }
  
  th, td {
    border-top: 1px solid black;
    font-size: 12px;
  }

  td{
    padding-top: -50px;
    margin-top: -50px;
  }

  .title{
    display: flex;
    padding: 2px;
    text-align: center;
    font-weight: bold;
  }
  
  .break-word{
    word-wrap: break-word;
  }

  .tab0 {
      display: inline-block;
      margin-left: 53.4px;
  }
  .tab1 {
      display: inline-block;
      margin-left: 42.5px;
  }
  .tab2 {
      display: inline-block;
      margin-left: 27px;
  }
  .tab3 {
      display: inline-block;
      margin-left: 35px;
  }
  .tab4 {
      display: inline-block;
      margin-left: 25px;
  }
  .tab5 {
      display: inline-block;
      margin-left: 55.5px;
  }
  .tab6 {
      display: inline-block;
      margin-left: 48px;
  }
  p {
    padding: 0;
    margin: 0;
    font-size: 12px;
  }

  .pding{
    padding-top: 15px;
  }

  .border-total
  {
    border-top: 2px solid black;
  }
  .footer-pdf
  {
    position: absolute;
    width: 100rem;
    height: 1.8rem;
    background-color: rgb(8, 4, 75);
    bottom: -45px;
    left: -30rem;
  }
  .location-mail
  {
    position: absolute;
    bottom: -15px;
    font-size: 10px;
  }
  </style>
</head>
<body>
  <div style="position: fixed; left:170px">
    <img src="assets/img/brand/logo.png" style="width: 800px; opacity: 0.3; margin-top: 60.5%;">
  </div>
  <div style="position: fixed; bottom: -45px" class="footer-pdf">
    <div class="footer-pdf">
    </div>
  </div>
  <div style="position: fixed; bottom: 10px" class="location-mail">
    <div>
      Head Office : <br>
      88 Kasablanka Office Tower, Lt. 10 Unit E Jakarta | www.makroalphasolusindo.com
    </div>
  </div>
  
</div>
<img src="assets/img/brand/logo.png" alt="image" style="width: 150px; margin-bottom: -40px; margin-top: 20px;" loading="lazy">
<div>
    <div class="title" style="padding-top: -20px;"> 
      Invoice
    </div>
    <div style="display: flex">
      <div style="font-size: 12px;">
        <span>
          Bill To<span class="tab0  break-word"></span>: {{$invoice['Bill To']}} <br> 
        </span>
        <span>
          Address<span class="tab1  break-word"></span>: {{$invoice['Address']}}<br>
        </span>
      </div>
      <div style="padding-left: 470px; font-size: 12 px; width: 100%;">
        <span class="break-word">
          Invoice No<span class="tab3 break-word"></span>: {{$invoice['Invoice No']}}  <br>
        </span>
        <span>
          Invoice Date<span class="tab4 break-word"></span>: {{$invoice['Invoice Date']}} <br>
        </span>
        <span>
          PO No<span class="tab5 break-word"></span>: {{$invoice->quotation['Quotation_No']}} <br>
        </span>
        <span>
          PO Date<span class="tab6 break-word"></span>: {{$invoice->quotation['Quotation Date']}} <br>
        </span>
      </div>
    </div>
    
    <table class="table" style="margin-top: -15px">
      <thead>
        <tr>
          <th scope="col" style="width:8%; text-align: center;
          vertical-align: middle;"><strong>No</strong></th>
          <th scope="col" style="width:20%;"><strong>Name</strong></th>
          <th scope="col" style="width:45%;"><strong>Description</strong></th>
          <th scope="col" style="width:8%; text-align: center;
          vertical-align: middle;"><strong>Qty</strong></th>
          <th scope="col" style="width:15%;"><strong>Unit Price</strong></th>
          <th scope="col" style="width:15%;"><strong>Total Price</strong></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($invoice->items($invoice['Quotation No']) as $item)
        <tr>
          <td class="break-word" style="text-align: center;
          vertical-align: middle;" scope="row">{{$loop->iteration}}</td>
          <td class="break-word">{{$item->name}}</td>
          <td class="break-word">{!!$item->description!!}</td>
          <td class="break-word" style="text-align: center;
          vertical-align: middle;">{{$item->quantity}}</td>
          <td class="break-word">{{$item['unit price']}}</td>
          <td class="break-word">{{$item['unit price'] * $item->quantity}}</td>
        </tr>
        @php
          $total += ($item['unit price'] * $item->quantity);
        @endphp
        @endforeach
      </tbody>
    </table>
    @php
        $ppn = (($total / 100) * 10);
        // $discount = ($total/100);
    @endphp
    <br>
    <div class="table-responsive">
      <div class="table-responsive m-10">
        <table class="table table-bordered no-margin table-sm">
          <tr>
            <th colspan="2" style="width:44rem; background-color: #bbbcbd;" class="border-total" scope="row">Discount</th>
            <td class="border-total" style="background-color: #bbbcbd;">IDR {{number_format($invoice->quotation['Discount'])}}</td>
          </tr>
          <tr>
            <th colspan="2" style="background-color: rgb(235, 216, 131);" class="border-total" scope="row">Total</th>
            <td style="background-color: rgb(235, 216, 131);" class="border-total break-word ">IDR {{number_format($total)}}</td>
          </tr>
          <tr>
            <th colspan="2" style="background-color: rgb(139, 219, 166);" class="border-total" scope="row">Ppn (10%)</th>
            <td style="background-color: rgb(139, 219, 166);" class="border-total break-word">IDR {{number_format($ppn)}}</td>
          </tr>
          <tr>
            <th colspan="2" scope="row" style="background-color: rgb(235, 216, 131); border-bottom: 2px solid black; border-top: 2px solid black;">Grand Total</th>
            <td class="border-total" style="border-bottom: 2px solid black; background-color: rgb(235, 216, 131);">IDR {{number_format(($total + $ppn) - $invoice->quotation['Discount'])}}</td>
          </tr>
        </table>
      </div>
    </div>
    <br>
    <p><u><b>Terms and Condition:</b></u></p>
    <span>
      {!!$invoice['Note']!!}
    </span>
    <br>
    <div style="display: block">
      <p><strong>Jakarta, {{ date('M-d-Y') }}</strong></p>
      <br>
      <br>
      <br>
      <br>
      <p><u><b>Wika Handayani</b></u></p>
      <p><b>PT Makro Alpha Solusindo</b></p>
    </div>
  </div>  