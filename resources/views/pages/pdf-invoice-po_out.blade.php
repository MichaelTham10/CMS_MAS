
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>{{$po_out['po_out_no']}}</title>
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
  <div style="position: fixed; padding-bottom: 10px" class="location-mail">
    <div>
      Head Office : <br>
      88 Kasablanka Office Tower, Lt. 10 Unit E Jakarta | www.makroalphasolusindo.com
    </div>
  </div>
  
</div>
<img src="assets/img/brand/logo.png" alt="image" style="width: 150px; margin-bottom: -20px; margin-top: 20px;" loading="lazy">
<div>
    <div class="title" style="margin-top: 20px;"> 
      PURCHASE ORDER
    </div>
    <div style="">
      <div style="float: left; width: 50%; font-size: 12px; margin-top: 20px;">
        <span>
          Number<span class="tab4  break-word"></span>: {{$po_out['po_out_no']}} <br> 
        </span>
        <span>
          Date<span class="tab1  break-word"></span>: {{$po_out['date']}}<br>
        </span>
        <span>
          Arrival<span class="break-word" style="display: inline-block; margin-left: 34px;"></span>: {{$po_out['arrival']}}<br>
        </span>
      </div>
      <div style="padding-left: 450px; font-size: 12 px; width: 50%; margin-top: 20px;">
        <span>
          To<span class="break-word" style="display: inline-block; margin-left: 37px;"></span>: {{$po_out['to']}} <br>
        </span>
        <span class="break-word">
          Attn<span class="break-word" style="display: inline-block; margin-left: 30px;"></span>: {{$po_out['attn']}}  <br>
        </span>
        <span>
          Email<span class="break-word" style="display: inline-block; margin-left: 20px;"></span>: {{$po_out['email']}} <br>
        </span> 
      </div>
    </div>  
    <table class="table" style="margin-top: 20px; table-layout: fixed;">
      <thead>
        <tr>
          <th scope="col" style="width:6%; text-align: center;
          vertical-align: middle;"><strong>No</strong></th>
          <th scope="col" style="width:42%;"><strong>Item Description</strong></th>
          <th scope="col" style="width:15%; text-align: center;
          vertical-align: middle;"><strong>Qty</strong></th>
          <th scope="col" style="width:20%;"><strong>Unit Price</strong></th>
          <th scope="col" style="width:20%;"><strong>Total Price</strong></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($po_out->items as $item)
        <tr>
          <td class="break-word" style="width: 6%; text-align: center;
          vertical-align: middle;" scope="row">{{$loop->iteration}}</td>
          <td class="break-word" style="width: 42%,">{!!$item->item_description!!}</td>
          <td class="break-word" style="width: 15%; text-align: center;
          vertical-align: middle;">{{number_format($item->qty)}}</td>
          <td class="break-word" style="width:20%;">Rp. {{number_format($item['price'])}}</td>
          <td class="break-word" style="width:20%;">Rp. {{number_format($item['price'] * $item->qty)}}</td>
        </tr>
        @php
          $total += ($item['price'] * $item->qty);
        @endphp
        @endforeach
      </tbody>
    </table>
    @php
        $ppn = (($total / 100) * $po_out->ppn);
        // $discount = ($total/100);
    @endphp
    <br>
    <div class="table-responsive">
      <div class="table-responsive m-10">
        <table class="table table-bordered no-margin table-sm">
          <tr>
            <th colspan="2" style="width: 31.2rem; background-color: rgb(235, 216, 131); padding-left: 2%" class="border-total" scope="row">Total</th>
            <td style="background-color: rgb(235, 216, 131);" class="border-total break-word ">Rp. {{number_format($total)}}</td>
          </tr>
          <tr>
            <th colspan="2" style="background-color: rgb(139, 219, 166); padding-left: 2%" class="border-total" scope="row">Ppn ({{$po_out->ppn}})</th>
            <td style="background-color: rgb(139, 219, 166);" class="border-total break-word">Rp. {{number_format($ppn)}}</td>
          </tr>
          <tr>
            <th colspan="2" scope="row" style="background-color: rgb(235, 216, 131); border-bottom: 2px solid black; border-top: 2px solid black; padding-left: 2%">Grand Total</th>
            <td class="border-total" style="border-bottom: 2px solid black; background-color: rgb(235, 216, 131);">Rp. {{number_format($total + $ppn)}}</td>
          </tr>
        </table>
      </div>
    </div>
    <br>
    <p><u><b>Terms and Condition:</b></u></p>
    <div class="break-word" style="padding: 10px">
      {!!$po_out['terms']!!}
    </div>
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